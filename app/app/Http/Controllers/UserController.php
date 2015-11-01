<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Postgres\UserRepository;
use App\Models\User\User;
use App\Models\User\UserId;
use App\Models\User\Email;
use App\Models\User\FullName;
use App\Models\WorstThing\WorstThingId;
use App\Models\User\FacebookUserId;
use App\Models\Downvote\Downvote;
use App\DPO\WorstThingDPO;
use App\Events\WorstThingWasDownvoted;
use Event;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk as FacebookSDK;
use App\Exceptions\ResourceNotFoundException;

use Log;

class UserController extends Controller
{

    protected $userRepo;


    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(
        UserRepository $userRepo
    ) {
        $this->userRepo = $userRepo;
    }

    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function upsertUser(Request $request, FacebookSDK $fb)
    {
        //Throws Facebook\Exceptions\FacebookResponseException
        //Throws Facebook\Exceptions\FacebookSDKException
        $facebookAccessToken = $fb->getJavaScriptHelper()->getAccessToken();

        if (!$facebookAccessToken->isLongLived()) {

            // OAuth 2.0 client handler
            $oauthClient = $fb->getOAuth2Client();

            // Extend the access token.
            $facebookAccessToken = $oauthClient->getLongLivedAccessToken($facebookAccessToken);
        }

        $fb->setDefaultAccessToken($facebookAccessToken);

        $request->session()->put('fb_user_access_token', (string) $facebookAccessToken);

        // Returns a `Facebook\FacebookResponse` object
        //Throws Facebook\Exceptions\FacebookResponseException
        //Throws Facebook\Exceptions\FacebookSDKException
        $response = $fb->get('/me?fields=id,name,first_name,last_name,email,age_range,gender,interested_in,website,religion,political,languages,birthday,hometown', $facebookAccessToken);

        $fbUser = $response->getGraphUser();

        //Check for FacebookId or Email
        try {            
            $user = $this->userRepo->getByFacebookId(new FacebookUserId($fbUser["id"]));
        } catch (ResourceNotFoundException $e) {
            try {
                $user = $this->userRepo->getByEmail(new Email($fbUser["email"]));
            } catch(ResourceNotFoundException $e) {
                //If we can't find the user, create them
                $user = new User(
                    $this->userRepo->nextIdentity(),
                    new FullName($fbUser["first_name"], $fbUser["last_name"]),
                    new Email($fbUser["email"])
                );

                $this->userRepo->save($user);
            }
        }

        $request->session()->put('userId', (string) $user->id());

        return response($user->toArrayRecursive(), 200);
    }
}

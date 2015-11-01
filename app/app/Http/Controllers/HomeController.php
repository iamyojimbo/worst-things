<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Repositories\Postgres\WorstThingRepository;
use App\Repositories\Postgres\UserRepository;
use App\Repositories\Postgres\DownvoteRepository;
use App\Models\User\UserId;
use App\Models\WorstThing\WorstThingId;
use App\Models\Downvote\Downvote;
use App\DPO\WorstThingDPO;
use App\Events\WorstThingWasDownvoted;
use App\Exceptions\ResourceNotFoundException;
use Event;

use Log;

class HomeController extends Controller
{

    protected $worstThingRepo;
    protected $userRepo;
    protected $downvoteRepo;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(
        WorstThingRepository $worstThingRepo, 
        UserRepository $userRepo, 
        DownvoteRepository $downvoteRepo
    ) {
        $this->worstThingRepo = $worstThingRepo;
        $this->userRepo = $userRepo;
        $this->downvoteRepo = $downvoteRepo;
    }

    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function showWorstThings() {
        $allWorstThings = $this->worstThingRepo->getAll();

        $allWorstThingsDPO = array_map(function($worstThing){
            return new WorstThingDPO($worstThing, $this->userRepo);
        }, $allWorstThings );

        return view('home', ['worstThings' => $allWorstThingsDPO]);
    }

    public function downvoteWorstThing(Request $request) {
        $userId = new UserId($request->session()->get("userId"));
        $worstThingId = new WorstThingId($request->input("worstThingId"));
        
        $worstThing = $this->worstThingRepo->getById($worstThingId);

        try {
            $userHasAlreadyDownvotedWorstThing = (bool)$this->downvoteRepo->getByUserIdAndWorstThingId($userId, $worstThingId);
        } catch(ResourceNotFoundException $e) {
            $userHasAlreadyDownvotedWorstThing = false;
        }

        if(!$userHasAlreadyDownvotedWorstThing) {
            $downvote = new Downvote(
                $this->downvoteRepo->nextIdentity(),
                $worstThingId,
                $userId
            );
        } else {
            return response($worstThing->toArray(), \Illuminate\Http\Response::HTTP_CONFLICT);
        }

        $this->downvoteRepo->save($downvote);

        Event::fire(new WorstThingWasDownvoted($worstThingId, $downvote->id()));

        return response($worstThing->toArray(), \Illuminate\Http\Response::HTTP_OK);
    }

    public function getUserDownvotes(Request $request) {
        $userId = new UserId($request->session()->get("userId"));

        if(!$userId) {
            return response("User unknown", \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }

        try {
            $downvotesByUser = $this->downvoteRepo->getByUserId($userId);
        } catch(ResourceNotFoundException $e) {
            $downvotesByUser = [];
        }

        $downvotesByUserData = array_map(function($downvote){
            return $downvote->toArrayRecursive();
        }, $downvotesByUser);

        return response($downvotesByUserData, \Illuminate\Http\Response::HTTP_OK);
    }
}

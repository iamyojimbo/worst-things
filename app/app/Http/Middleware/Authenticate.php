<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk as FacebookSDK;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    protected $fb;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth, FacebookSDK $fb)
    {
        $this->auth = $auth;
        $this->fb = $fb;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* This used to be here and is helpful to see what we can do:
         *  if ($this->auth->guest()) {
         *      if ($request->ajax()) {
         *          return response('Unauthorized.', 401);
         *      } else {
         *          return redirect()->guest('auth/login');
         *      }
         *  }
         */

        $facebookAccessToken = $request->session()->get('fb_user_access_token');

        \Log::info("facebookAccessToken: {$facebookAccessToken}");

        //Check their token is valid (i.e. can we trust them from now on?)
        try {
          $response = $this->fb->get('/me?fields=id,name', $facebookAccessToken);
        } catch(Facebook\Exceptions\FacebookAuthenticationException $e) {
          return response('Unauthorized.', 401);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Graph returned an error: ' . $e->getMessage();
          return response("Facebook Unavailable", 503);
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          return response("Facebook Unavailable", 503);
        }

        return $next($request);
    }
}

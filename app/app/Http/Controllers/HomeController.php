<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\Postgres\WorstThingRepository;
use App\Repositories\Postgres\UserRepository;
use App\DPO\WorstThingDPO;
use Log;

class HomeController extends Controller
{

    protected $worstThingRepo;
    protected $userRepo;


    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(WorstThingRepository $worstThingRepo, UserRepository $userRepo)
    {
        $this->worstThingRepo = $worstThingRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    public function showWorstThings()
    {
        $allWorstThings = $this->worstThingRepo->getAll();

        $allWorstThingsDPO = array_map(function($worstThing){
            return new WorstThingDPO($worstThing, $this->userRepo);
        }, $allWorstThings );

        return view('home', ['worstThings' => $allWorstThingsDPO]);
    }

    public function redirectToProvider()
    {
        return \Socialize::with('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = \Socialize::with('facebook')->user();
        dd($user);

        //return redirect()->action('App\Http\Controllers\HomeController@showWorstThings');
    }
}

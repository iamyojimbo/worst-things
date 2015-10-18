<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\Postgres\WorstThingRepository;
use Log;

class HomeController extends Controller
{

    protected $worstThingRepo;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(WorstThingRepository $worstThingRepo)
    {
        $this->worstThingRepo = $worstThingRepo;
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showWorstThings()
    {
        $allWorstThings = $this->worstThingRepo->getAll();
        return view('home', ['worstThings' => $allWorstThings]);
    }
}

<?php

namespace App\Http\Controllers\Admin\Noc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noc;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function newApplications()
    {
        $nocs = Noc::when(Auth::user()->hasRole('CLerk'), function($q){
            $q->where('clerk_status', 0);
        })->when(Auth::user()->hasRole('Junior Engineer'), function($q){
            $q->where('clerk_status', 1)->where('jr_eng_status', 0);
        })->when(Auth::user()->hasRole('Senior Engineer'), function($q){
            $q->where('jr_eng_status',1)->where('sr_eng_status',0);
        })->when(Auth::user()->hasRole('HOD'), function($q){
            $q->where('sr_eng_status',1)->where('hod_status',0);
        })->when(Auth::user()->hasRole('Citizen Engineer'), function($q){
            $q->where('hod_status',1)->where('city_eng_status',0);
        })->latest()->get();

        return view('Lisiting.new-applications')->with(['nocs' => $nocs]);
    }
}

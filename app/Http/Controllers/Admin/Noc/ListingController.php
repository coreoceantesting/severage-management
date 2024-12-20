<?php

namespace App\Http\Controllers\Admin\Noc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noc;

class ListingController extends Controller
{
    public function newApplications()
    {
        $nocs = Noc::latest()->get();
        return view('Lisiting.newApplications')->with(['nocs' => $nocs]);
    }
}

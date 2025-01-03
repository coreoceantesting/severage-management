<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\Documents;
use App\Models\User;
use App\Models\Ward;
use App\Models\PropertyType;

class DashboardController extends Controller
{

    public function index()
    {

        $totalUsers = User::count();
        $wards =Ward::count();
     $property=PropertyType::count();
     $docs = Documents::latest();
        return view('admin.dashboard')->with(['docs' => $docs,'totalUsers'=>$totalUsers,'wards'=>$wards,'property'=>$property]);
    }

    public function changeThemeMode()
    {
        $mode = request()->cookie('theme-mode');

        if($mode == 'dark')
            Cookie::queue('theme-mode', 'light', 43800);
        else
            Cookie::queue('theme-mode', 'dark', 43800);

        return true;
    }
}

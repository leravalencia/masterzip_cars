<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile.index');
    }

    public function settings()
    {
        return view('profile.settings');
    }

    public function overview()
    {
        return view('profile.overview');
    }

    public function pricing()
    {
        return view('profile.pricing');
    }

    public function occupancy()
    {
        return view('profile.occupancy');
    }

    public function revenue()
    {
        return view('profile.revenue');
    }

    public function rental()
    {
        return view('profile.rental');
    }

    public function top()
    {
        return view('profile.top-cars');
    }

    public function reports()
    {
        $reports = \auth()->user()->reports;

        return view('profile.reports', compact('reports'));
    }

    public function worldMap()
    {
        return view('profile.world-map');
    }

    public function testpage()
    {
        return view('profile.testpage');
    }
}

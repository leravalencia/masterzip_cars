<?php

namespace App\Http\Controllers;

use App\Report;

class PartnerController extends Controller
{
    public function index()
    {
        /** @var \App\User $user */
        $user = \auth()->user();
        $affiliates = $user->affiliateUsers;
        $reports = $affiliates->isNotEmpty() ? Report::where('user_id', $affiliates->pluck('affiliate_id'))->get() : collect([]);

        return view('partner.index', compact('user', 'affiliates', 'reports'));
    }
}

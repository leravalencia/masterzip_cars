<?php

namespace App\Http\Controllers;

use App\AffiliateLink;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function setCookieAndRedirect(Request $request, $link)
    {
        $affiliateId = null;
        if (!($affiliateLink = AffiliateLink::where('link', $link)->first())) {
            \Log::notice("User come to site with unknown link {$link}");
        } else {
            $affiliateLink->views++;
            $affiliateLink->save();
            $affiliateId = $affiliateLink->user_id;
        }

        $twoMonthesInSeconds = 86400;
        return redirect('/')->cookie(
            'link', $link, $twoMonthesInSeconds
        )->cookie(
            'aff', $affiliateId, $twoMonthesInSeconds
        );
    }
}

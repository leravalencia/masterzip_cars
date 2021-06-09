<?php

namespace App\Http\Controllers;

use App\System\Sample;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function landing()
    {
        try {
            $sample = \Storage::get(Sample::getPath());
            $reportLink = url('sample/' . \json_decode($sample)->name);
        } catch (FileNotFoundException $exception) {
            $reportLink = url('uploads/reports/01/TUR0123__DalyCity (San FranciscoArea)_94015+15miles.pdf');
        }

        return view('landing', compact('reportLink'));
    }
}

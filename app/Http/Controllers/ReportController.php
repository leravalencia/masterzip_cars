<?php

namespace App\Http\Controllers;

use App\Report;
use App\System\Sample;
use App\System\Transliteration;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ReportController extends Controller
{
    public function getReport(Report $report)
    {
        if (\auth()->user()->id !== $report->user_id
            || !\auth()->user()->admin) {
            abort(403);
        }

        return response()->download(storage_path() . '/app/' . $report->url, $report->file_name);
    }

    public function sample($name)
    {
        try {
            $sampleConfig = json_decode(\Storage::get(Sample::getPath()));
            $path = storage_path() . '/app/'. $sampleConfig->path;
            $fileName = $sampleConfig->name;
            if ($name !== $fileName) {
                abort(404);
            }
        } catch (FileNotFoundException $e) {
            $path = public_path() . 'uploads/reports/01/TUR0123__DalyCity (San FranciscoArea)_94015+15miles.pdf';
            $fileName = '01/TUR0123__DalyCity (San FranciscoArea)_94015+15miles.pdf';
        }

        return response()->download($path, Transliteration::transliterate($fileName));
    }
}

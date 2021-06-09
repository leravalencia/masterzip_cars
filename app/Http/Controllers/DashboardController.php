<?php

namespace App\Http\Controllers;

use App\Car;
use App\User;
use App\Report;
use App\Feedback;
use App\Affiliate;
use App\ReportOrder;
use App\Subscriber;
use App\AffiliateLink;
use App\System\Sample;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\AddReportRequest;
use App\Http\Requests\ImportSpreadSheetRequest;
use Maatwebsite\Excel\Readers\LaravelExcelReader;
use Maatwebsite\Excel\Collections\CellCollection;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function importPage()
    {
        return view('admin.import');
    }

    public function importSpreadSheetToDb(ImportSpreadSheetRequest $request)
    {
        try {
            /** @var LaravelExcelReader $reader */
            $reader = Excel::load($request->database);
        } catch (\Exception $exception) {
            \Log::error("Can't parse file. Err: " . var_export($exception, true));
            return redirect()->back()->with(['errors' => ['database' => 'Cant parse file. Try again']]);
        }
        $count = 0;
        /** @var CellCollection $row */
        foreach ($reader->get() as $row) {
            $count++;
            $rowCar = $row->toArray();
            $rowCar['convertible'] = (int)$rowCar['convertible'];
            $rowCar['gps'] = (int)$rowCar['gps'];
            Car::updateOrInsert(['car_id' => $rowCar['car_id']], $rowCar);
        }

        return redirect()->back()->with(['flash' => 'Info about ' . $count . ' cars was imported in database']);
    }

    public function addReportsPage()
    {
        $reportOrders = ReportOrder::where('processed', 0);

        return view('admin.add-reports');
    }

    public function usersPage()
    {
        $users = User::all();

        return view('admin.users', compact('users'));
    }

    public function userAddReportPage(User $user)
    {
        return view('admin.user-add-report', compact('user'));
    }

    public function userAddReport(AddReportRequest $request, User $user)
    {
        $filePath = \Storage::put(Report::$userReportsPath . "/{$user->id}", $request->report);
        Report::create([
            'user_id' => $user->id,
            'file_name' => $request->report->getClientOriginalName(),
            'url' => $filePath,
        ]);

        return redirect("/admin/users/{$user->id}/reports")->with(['flash' => "Report for user {$user->fullName} added"]);
    }

    public function feedback()
    {
        $feedback = Feedback::all();

        return view('admin.feedback', compact('feedback'));
    }

    public function subscribers()
    {
        $subscribers = Subscriber::all();

        return view('admin.subscribers', compact('subscribers'));
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function userReportsPage(User $user)
    {
        $reports = $user->reports;

        return view('admin.user-reports', compact('user', 'reports'));
    }

    public function deleteReport(User $user, Report $report)
    {
        Report::destroy($report->id);

        return redirect()->back()->with(['flash' => ['Report successfully deleted']]);
    }

    public function reportPage(User $user, Report $report)
    {

        return view('admin.user-edit-report', compact('user', 'report'));
    }

    public function updateReport(AddReportRequest $request, User $user, Report $report)
    {
        $filePath = \Storage::put(Report::$userReportsPath . "/{$user->id}", $request->report);
        $report->update([
            'user_id' => $user->id,
            'file_name' => $request->report->getClientOriginalName(),
            'url' => $filePath,
        ]);

        return redirect("/admin/users/{$user->id}/reports")->with(['flash' => "Report for user {$user->fullName} updated"]);
    }

    public function uploadSampleReportPage()
    {
        return view('admin.sample-report');
    }

    public function uploadSampleReport(Request $request)
    {
        $request->validate([
            'sample' => 'file|required'
        ]);

        $path = Sample::getFolder();
        $filePath = \Storage::put($path, $request->sample);

        $samplePath = Sample::getPath();
        try {
            $config = \Storage::get($samplePath);
        } catch (FileNotFoundException $e) {
            $config = '{}';
        }
        $config = \json_decode($config, true);
        $config['name'] = $request->sample->getClientOriginalName();
        $config['path'] = $filePath;

        \Storage::put($samplePath, json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return redirect()->back()->with(['flash' => 'Sample report changed']);
    }

    public function userEditForm(User $user)
    {
        return view('admin.user', compact('user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'string|nullable|max:200',
            'admin' => 'nullable',
            'partner' => 'nullable',
        ]);

        $user->admin = isset($request->admin) ?? 0;
        $user->partner = isset($request->partner) ?? 0;
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with(['flash' => 'User data saved']);
    }

    public function userAffiliateLinks(User $user)
    {
        return view('admin.user-affiliate-links', compact('user'));
    }

    public function createUserAffiliateLinks(User $user, Request $request)
    {
        $request->validate([
            'link' => 'required|unique:affiliate_links,link'
        ]);
        AffiliateLink::create([
            'user_id' => $user->id,
            'link' => $request->link,
            'views' => 0,
            'registers' => 0,
        ]);

        return redirect()->back()->with(['flash' => 'Link created']);
    }

    public function partners()
    {
        $affiliates = Affiliate::all();
        $reports = $affiliates->isNotEmpty() ? Report::where('user_id',  $affiliates->pluck('affiliate_id'))->get() : collect([]);

        return view('admin.partners', compact('affiliates', 'reports'));
    }
}

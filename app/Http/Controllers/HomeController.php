<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\ReportingPeriod;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('welcome');
    }

    public function welcome()
    {
        if (auth()->check()) {
            $reminders = self::getReminders();

            return view('home', compact('reminders'));
        }
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reminders = self::getReminders();

        return view('home', compact('reminders'));
    }

    private function getReminders(): object
    {
        $unfinished_reminders = Reminder::where('finished_at', NULL)->where('closed', 0)->get();
        $reminders = collect();

        foreach ($unfinished_reminders as $reminder) {
            if ($reminder->by_odometer)
                if ($reminder->truckData->odometer >= $reminder->by_odometer - $reminder->km_before) {
                    $reminders->add($reminder);
                }
            if ($reminder->by_date) {
                if (strtotime('- ' . $reminder->days_before . ' days', strtotime($reminder->by_date)) <= strtotime(today())) {
                    $reminders->add($reminder);
                }
            }
        }

        return $reminders;
    }
}

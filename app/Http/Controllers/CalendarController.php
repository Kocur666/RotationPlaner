<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Areas;
use App\Models\Absences;
use App\Models\CalendarUsers;
use App\Models\Events;

class CalendarController extends Controller
{
    public function showCalendar()
    {
        return view('calendar');
    }
    public function run()
    {

        // $calendarUsers = new CalendarUsers;
        // $calendarUsers->person ="Bartosz Banak";
        // // $absences->date =Carbon::today()->add(3, 'day');
        // // $absences->date =Carbon::tomorrow();
        // $calendarUsers->save();

        // $events = new Events;
        // $events->title ="Baseline";
        // $events->person ="Jacek Marczak";
        // $events->date =Carbon::tomorrow();
        // // $absences->date =Carbon::today()->add(3, 'day');
        // // $absences->date =Carbon::tomorrow();
        // $events->save();

        // $events->title ="4G";
        // $events->person ="Jacek Marczak";
        // $events->date =Carbon::today();
        // // $absences->date =Carbon::today()->add(3, 'day');
        // // $absences->date =Carbon::tomorrow();
        // $events->save();

        // $events->title ="5G";
        // $events->person ="Marcin Gazdowski";
        // $events->date =Carbon::today();
        // // $absences->date =Carbon::today()->add(3, 'day');
        // // $absences->date =Carbon::tomorrow();
        // $events->save();

        // $events->title ="4G STP";
        // $events->person ="Katarzyna Lemańczyk";
        // $events->date =Carbon::today();
        // // $absences->date =Carbon::today()->add(3, 'day');
        // // $absences->date =Carbon::tomorrow();
        // $events->save();



        // $absences = new Absences;
        // $absences->person ="Grzegorz Kozłowski";
        // $absences->date =Carbon::today();
        // // $absences->date =Carbon::today()->add(3, 'day');
        // // $absences->date =Carbon::tomorrow();
        // $absences->save();

        // DB::insert('insert into areas (id, title) values (?, ?)', [2, '4G']);
        // DB::insert('insert into areas (id, title) values (?, ?)', [3, '5G']);
        // DB::insert('insert into areas (id, title) values (?, ?)', [4, '4G STP']);
        // DB::insert('insert into areas (id, title) values (?, ?)', [5, '5G STP']);
        // DB::insert('insert into areas (id, title) values (?, ?)', [6, 'AD/EP']);
        // DB::insert('insert into areas (id, title) values (?, ?)', [7, 'Baseline']);
        // DB::insert('insert into areas (id, title) values (?, ?)', [8, 'Tracks']);

        return view('calendar');
    }

    public function showAbsencesCalendar()
    {
        return view('absences-calendar');
    }
}

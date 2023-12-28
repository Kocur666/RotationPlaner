<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Areas;
use App\Models\Absences;
use App\Models\Events;
use App\Models\CalendarUsers;

class AbsenceController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $absences = Absences::all();
    $calendarusers = CalendarUsers::all()->pluck('person','id')->toArray();
    // dd($calendarusers);
    return view('absence.index', compact('absences', 'calendarusers' ));
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function storeholiday(Request $request)
  {

    $request->validate([
      'date' => 'date',
    ]);
    $calendarusers = CalendarUsers::all()->pluck('person','id')->toArray();
    foreach($calendarusers as $key => $singleUser){
        $date = $request->only('date')['date'];
        // dd($date);
        Absences::create    ([
            'person' => $singleUser,
            'date' => $date,
        ]);
    }
    return redirect()->route('absence.index')
      ->with('success', 'Absence created successfully.');
  }
  public function store(Request $request)
  {
    $request->validate([
      'person' => 'required|max:50',
      'date' => 'date',
    ]);
    // dd($request);
    Absences::create($request->only('person','date'));
    return redirect()->route('absence.index')
      ->with('success', 'Absence created successfully.');
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'person' => 'required|max:50',
      'date' => 'date',
    ]);
    $absence = Absences::find($id);
    $absence->update($request->all());
    return redirect()->route('absence.index')
      ->with('success', 'Absence updated successfully.');
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $absence = Absences::find($id);
    $absence->delete();
    return redirect()->route('absence.index')
      ->with('success', 'Absence deleted successfully');
  }
  // routes functions
  /**
   * Show the form for creating a new post.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $calendarusers = CalendarUsers::all()->pluck('person','id')->toArray();
    return view('absence.create', compact('calendarusers' ));

  }
  public function createHoliday()
  {
    $calendarusers = CalendarUsers::all()->pluck('person','id')->toArray();
    return view('absence.create-holiday', compact('calendarusers' ));

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $absence = Absences::find($id);
    return view('absence.show', compact('absence'));
  }
  /**
   * Show the form for editing the specified post.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $absence = Absences::find($id);
    return view('absence.edit', compact('absence'));
  }
}

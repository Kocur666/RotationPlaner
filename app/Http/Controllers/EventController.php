<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Areas;
use App\Models\Events;
use App\Models\Absences;
use App\Models\CalendarUsers;

class eventController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $events = events::all();
    return view('event.index', compact('events' ));
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|max:50',
      'person' => 'required|max:50',
      'date' => 'date',
    ]);
    if($request->week == "on"){
        $date = $request->date." 00:00:00";
        $date = Carbon::parse($date);
        // dd($date);
        // $startDate = $date->startOfWeek()->format('Y-m-d')->addDay($i);
        // dd($startDate);
        For($i = 0 ; $i<=4; $i++){
            $startDate = $date->startOfWeek()->addDay($i)->format('Y-m-d');
            // dd($startDate);
            events::create([
                'person' => $request->person,
                'title' => $request->title,
                'date' => $startDate,
            ]);
        }
        // dd($startDate);
    } else {
    events::create($request->only('person','date','title'));
    }
    return redirect()->route('event.index')
      ->with('success', 'event created successfully.');
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
      'title' => 'required|max:50',
      'person' => 'required|max:50',
      'date' => 'date',
    ]);
    $event = events::find($id);
    $event->update($request->all());
    return redirect()->route('event.index')
      ->with('success', 'event updated successfully.');
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $event = events::find($id);
    $event->delete();
    return redirect()->route('event.index')
      ->with('success', 'event deleted successfully');
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
    $areas = Areas::all()->pluck('title','id')->toArray();
    return view('event.create', compact('calendarusers','areas'));

  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $event = events::find($id);
    return view('event.show', compact('event'));
  }
  /**
   * Show the form for editing the specified post.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $event = events::find($id);
    return view('event.edit', compact('event'));
  }
}

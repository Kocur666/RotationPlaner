<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Areas;
use App\Models\Absences;
use App\Models\CalendarUsers;
use App\Models\Events;

class CalendarUsersController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $calendarusers = CalendarUsers::all();
    return view('calendaruser.index', compact('calendarusers'));
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
      'person' => 'required|max:50',
    ]);
    CalendarUsers::create($request->only('person'));
    return redirect()->route('calendaruser.index')
      ->with('success', 'User created successfully.');
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
    ]);
    $calendaruser = CalendarUsers::find($id);
    $calendaruser->update($request->all());
    return redirect()->route('calendaruser.index')
      ->with('success', 'User updated successfully.');
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $calendaruser = CalendarUsers::find($id);
    $calendaruser->delete();
    return redirect()->route('calendaruser.index')
      ->with('success', 'User deleted successfully');
  }
  // routes functions
  /**
   * Show the form for creating a new post.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('calendaruser.create');
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $calendaruser = CalendarUsers::find($id);
    return view('calendaruser.show', compact('calendaruser'));
  }
  /**
   * Show the form for editing the specified post.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $calendaruser = CalendarUsers::find($id);
    return view('calendaruser.edit', compact('calendaruser'));
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Areas;
use App\Models\Absences;
use App\Models\Events;

class AreaController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $areas = areas::all();
    return view('area.index', compact('areas'));
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
      'title' => 'required|max:10',
    ]);
    areas::create($request->only('title'));
    return redirect()->route('area.index')
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
      'title' => 'required|max:10',
    ]);
    $area = areas::find($id);
    $area->update($request->all());
    return redirect()->route('area.index')
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
    $area = areas::find($id);
    $area->delete();
    return redirect()->route('area.index')
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
    return view('area.create');
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $area = areas::find($id);
    return view('area.show', compact('area'));
  }
  /**
   * Show the form for editing the specified post.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $area = areas::find($id);
    return view('area.edit', compact('area'));
  }
}

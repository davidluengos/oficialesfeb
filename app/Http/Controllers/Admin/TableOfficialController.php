<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\TableOfficial;
use Illuminate\Http\Request;

class TableOfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tableOfficials = TableOfficial::all();
        return view('admin.table-official.index', compact('tableOfficials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all()->sortBy('name');
        return view('admin.table-official.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TableOfficial::create($request->all());
        return redirect()->route('admin.table-official.index')->with('success', 'Table Official created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tableOfficial = TableOfficial::find($id);
        $cities = City::all()->sortBy('name');
        return view('admin.table-official.edit', compact('tableOfficial', 'cities'));
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
        TableOfficial::find($id)->update($request->all());
        return redirect()->route('admin.table-official.index')->with('success', 'Table Official updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TableOfficial::destroy($id);
        return redirect()->route('admin.table-official.index')->with('success', 'Table Official deleted successfully');
    }

    
}

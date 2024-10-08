<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Designation;
use App\Models\Game;
use App\Models\TableOfficial;
use App\Models\Team;
use App\Models\Trip;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all()->sortBy('date');
        return view('admin.game.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->sortBy('name');
        $teams = Team::all()->sortBy('name');
        $tableOfficials = TableOfficial::all()->sortBy('name');
        return view('admin.game.create', compact('categories', 'teams', 'tableOfficials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Recuperamos los IDs de los roles
        $scorer_id = $request['scorer_id'];
        $timer_id = $request['timer_id'];
        $shot_clock_operator_id = $request['shot_clock_operator_id'];
        $assistant_scorer_id = $request['assistant_scorer_id'];

        // Validar que los IDs no se repitan entre ellos
        $unique_ids = collect([$scorer_id, $timer_id, $shot_clock_operator_id, $assistant_scorer_id])->unique();

        if ($unique_ids->count() < 4) {
            return back()->with('danger', 'No se ha realizado la operación. Una persona no puede repetir posición en un partido.');
        }

        Game::create($request->all());
        // Redirigimos con un mensaje de éxito
        return redirect()->route('admin.game.index')->with('success', 'Game created successfully');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Game::destroy($id);
        return redirect()->route('admin.game.index')->with('success', 'Game deleted successfully');
    }
}

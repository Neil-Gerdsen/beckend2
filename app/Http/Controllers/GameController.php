<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    $user = auth()->user();
    $symbool =($user->id == $game ->player_x_id) ? 'X' : 'O';
    $column = $request->input('column');
    $row = $request->input('row');


    if($game->turn != $symbool){
        return response()->json(['error' => 'Het is niet jouw beurt'], 403);
    }

    $exists = Zet::where('game_id', $game->id)
        ->where('row', $row)
        ->where('column', $column)
        ->exists();

    if($exists){
        return response()->json(['error' => 'Deze zet is al gedaan'], 400);

    Zet::create([
        'game_id' => $game->id,
        'player_id' => $user->id,
        'row' => $row,
        'column' => $column
    ]);
    $game->turn = ($symbool->turn == 'X') ? 'O' : 'X';
    $game->save();
}

<?php

namespace App\Http\Controllers;

use App\Models\Zetten;
use App\Http\Requests\StoreZettenRequest;
use App\Http\Requests\UpdateZettenRequest;
use App\Models\Zetten as Zet;
use App\Models\Spel;
use App\Models\User;
use Illuminate\Http\Request;

class ZettenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('id', 'name')->get();
        return view('Zetten.create', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'player_x_id' => 'required|exists:users,id',
            'player_o_id' => 'required|exists:users,id|different:player_x_id',
        ]);

        $spel = Zetten::create([
            'player_x_id' => $request->player_x_id,
            'player_o_id' => $request->player_o_id,
            'current_turn' => 'X', // X begint altijd
        ]);

        return redirect()->route('game', $spel->id);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreZettenRequest $request)
    {
        $user = auth()->user();
        $zetten = Zetten::findOrFail($request->input('game_id'));
        $symbool = ($user->id == $zetten->player_x_id) ? 'X' : 'O';
        $column = $request->input('column');
        $row = $request->input('row');

        if ($zetten->current_turn != $symbool) {
            return response()->json(['error' => 'Het is niet jouw beurt'], 403);
        }

        $exists = Zet::where('game_id', $zetten->id)
            ->where('row', $row)
            ->where('column', $column)
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Deze zet is al gedaan'], 400);
        }

        Zet::create([
            'game_id' => $zetten->id,
            'player_id' => $user->id,
            'row' => $row,
            'column' => $column
        ]);
        $zetten->current_turn = ($zetten->current_turn == 'X') ? 'O' : 'X';
        $zetten->save();

        return response()->json(['success' => true, 'current_turn' => $zetten->current_turn]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $game = Zetten::findOrFail($id);
        $game->load([
            'playerX',
            'playerO',
            'rounds.player',
        ]);

        return view('game', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zetten $zetten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateZettenRequest $request, Zetten $zetten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zetten $zetten)
    {
        //
    }
    public function getUsers()
    {
        $users = User::select('id', 'name')->get();
        return response()->json($users);
    }

}

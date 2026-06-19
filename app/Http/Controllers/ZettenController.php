<?php

namespace App\Http\Controllers;

use App\Models\Zetten;
use App\Http\Requests\StoreZettenRequest;
use App\Http\Requests\UpdateZettenRequest;
use App\Models\Zetten as Zet;
use App\Models\Spel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

        $players = User::query()->where('id', '!=', Auth::id())->orderBy('name')->get();

        //meesturen van alle players behalve waarmee in ben ingelogd
        return view('game/create', compact('players'));
        // $request->validate([
        //     'player_x_id' => 'required|exists:users,id',
        //     'player_o_id' => 'required|exists:users,id|different:player_x_id',
        // ]);

        // $ronde = Ronde::create([...]);
        // $spel = Zetten::create([
        //     'player_x_id' => $request->player_x_id,
        //     'player_o_id' => $request->player_o_id,
        //     'current_turn' => 'X',
        //     'ronde_id' => $ronde->id,
        // ]);

        // return redirect()->route('game', $spel->id);
    }
    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $spel = Zetten::create([
            'player_x_id' => auth()->id(),
            'player_o_id' => $request->player_o_id,
            'current_turn' => 'X',
            'ronde_id' => 1,
        ]);

        return redirect()->route('game.show', $spel);
    }

    //was eerst $game_id
    public function storeZet(Request $request, $game)
    {

        $user = auth()->user();
        $zetten = Zetten::findOrFail($game);
        $symbool = ($user->id == 1) ? 'X' : 'O';
        $column = $request->input('column');
        $row = $request->input('row');

        // if ($zetten->current_turn != $symbool) {
        //     return back()->withErrors(['beurt' => 'Het is niet jouw beurt']);
        // }

        $exists = zetten::where('ronde_id', $zetten->id)
            ->where('row', $row)
            ->where('column', $column)
            ->exists();

        if ($exists) {
            return back()->withErrors(['zet' => 'Dit vakje is al bezet']);
        }

        Zetten::create([
            'ronde_id' => $zetten->id,
            'player_x_id' => $user->id,
            'player_o_id' => $user->id,
            'rij' => $row,
            'kolom' => $column,
            'current_turn' => $symbool,
        ]);
        $zetten->current_turn = ($zetten->current_turn == 'X') ? 'O' : 'X';
        $zetten->save();

        return redirect()->route('game.show', $game);

    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $game = Zetten::findOrFail($id);
        $bord = $this->createGameField(3, 3);

        foreach ($game->zetten as $zet) {
            $symbool = ($game->current_turn == 'X') ? 'X' : 'O';
            $bord[$zet->rij][$zet->kolom] = $symbool;
        }

        return view('game.show', compact('game', 'bord'));
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

    public function getGameField()
    {
        $rij = zetten::select('rij')->get();
        $kolom = zetten::select('kolom')->get();
        return response()->json(['rij' => $rij, 'kolom' => $kolom]);
    }
    public function createGameField($rows, $columns)
    {
        $gameField = [];
        for ($rij = 0; $rij < $rows; $rij++) {
            for ($kolom = 0; $kolom < $columns; $kolom++) {
                $gameField[$rij][$kolom] = null;
            }
        }
        return $gameField;
    }


}

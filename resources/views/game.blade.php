<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold">
            Game #{{ $game->id }}
        </h1>

        <p>
            X: {{ $game->playerX->name }}
        </p>

        <p>
            O: {{ $game->playerO->name }}
        </p>

        <p>
            Status: {{ $game->status }}
        </p>

        <p>
            Aan de beurt: {{ $game->current_turn }}
        </p>

        <h2 class="mt-6 font-bold">
            Gespeelde zetten
        </h2>

        <ul>
            @foreach($game->rounds as $round)
                <li>
                    Zet {{ $round->turn_number }}
                    - {{ $round->symbol }}
                    ({{ $round->row }}, {{ $round->column }})
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
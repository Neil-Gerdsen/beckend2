<x-app-layout>
    <div class="p-6 bg-gray-100 min-h-screen">
        <h1 class="text-2xl font-bold mb-4">
            {{ $game->playerX->name }} vs {{ $game->playerO->name }}
        </h1>

        <p class="mb-4">Beurt: <strong>{{ $game->current_turn }}</strong></p>

        <!-- Bord -->
        <div style="display:inline-block; border: 3px solid black;">
            @foreach($bord as $rij => $kolommen)
                <div style="display:flex;">
                    @foreach($kolommen as $kolom => $waarde)
                        <form method="POST" action="{{ route('game.zetten', $game) }}">
                            @csrf
                            <input type="hidden" name="row" value="{{ $rij }}">
                            <input type="hidden" name="column" value="{{ $kolom }}">

                            <button type="submit"
                                style="width:100px; height:100px; border:2px solid black; background:white; font-size:2rem; font-weight:bold; cursor:pointer;"
                                {{ $waarde ? 'disabled' : '' }}>
                                {{ $waarde ?? '' }}
                            </button>
                        </form>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
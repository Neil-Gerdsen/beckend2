<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">
            {{ $spel->playerX->name }} vs {{ $spel->playerO->name }}
        </h1>

        <p class="mb-4">Beurt: <strong>{{ $spel->current_turn }}</strong></p>

        @foreach($errors->all() as $error)
            <p class="text-red-500 mb-2">{{ $error }}</p>
        @endforeach

        <!-- Bord -->
        <div class="inline-block border border-gray-400">
            @foreach($bord as $rij => $kolommen)
                <div class="flex">
                    @foreach($kolommen as $kolom => $waarde)
                        <form method="POST" action="{{ route('game.store') }}">
                            @csrf
                            <input type="hidden" name="game_id" value="{{ $spel->id }}">
                            <input type="hidden" name="row" value="{{ $rij }}">
                            <input type="hidden" name="column" value="{{ $kolom }}">

                            <button
                                type="submit"
                                class="w-20 h-20 border border-gray-400 text-3xl font-bold
                                       hover:bg-gray-100 disabled:cursor-not-allowed"
                                {{ $waarde ? 'disabled' : '' }}
                            >
                                {{ $waarde ?? '' }}
                            </button>
                        </form>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
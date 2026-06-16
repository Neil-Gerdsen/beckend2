<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">
            Nieuwe game
        </h1>

        <form method="POST" action="{{ route('game.show') }}">
            @csrf

            <div class="bg-white">
                <div class="flex flex-col mb-4">
                    <label for="player_o_id">
                        Tegenstander
                    </label>
                    <select id="player_o_id" name="player_o_id">
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">
                                {{ $player->name }}
                            </option>
                        @endforeach
                    </select>

                </div>
                <div class="flex flex-col">
                    <label for="user_id">
                        main user id: {{ auth()->user()->name }}
                    </label>
                    <select id="user_id" name="user_id">
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">
                                {{ $player->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


            </div>

            <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">
                Start game
            </button>
        </form>
    </div>
</x-app-layout>
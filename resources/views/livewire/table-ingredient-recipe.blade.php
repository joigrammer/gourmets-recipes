<div class="bg-gray-200 px-7 pt-3 pb-4 rounded-b-lg" style="font-family: 'Truculenta', sans-serif;">
    <h2 class="text-4xl">Ingredientes</h2>
    <ul class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 py-4 text-lg">
        @foreach($ingredients as $ingredient)
        <li class="flex justify-between px-2 py-0.5 border-t border-white">
            <div>
                {{ $ingredient->pivot->amount }}
                <strong>{{ $ingredient->pivot->measurement->abbrev }}</strong>
                {{ $ingredient->pivot->ingredient->name }}
            </div>
            <ul class="flex">
                @foreach($ingredient->pivot->ingredient->allergens as $allergen)
                <li class="p-1 rounded-full border border-gray-400 bg-white">
                    <img class="w-5" src="{{ \Illuminate\Support\Facades\Storage::url($allergen->icon) }}" alt="{{ $allergen->name }}">
                </li>
                @endforeach
            </ul>
        </li>
        @endforeach

    </ul>
</div>
<div class="bg-gray-200 px-7 pt-3 pb-4 rounded-b-lg" style="font-family: 'Truculenta', sans-serif;">
    <h2 class="text-4xl">Ingredientes</h2>
    <ul class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 py-4 text-lg">
        @foreach($ingredients as $ingredient)
            <li class="px-2 border-t border-white">{{ $ingredient->name }}</li>
        @endforeach
        
    </ul>
</div>

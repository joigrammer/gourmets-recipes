<div class="uppercase text-lg cursor-pointer" style="font-family: 'Truculenta', sans-serif;">
    <h1 class="ml-4 mb-2 text-2xl">Recetas</h1>
    <ul class="">
        @foreach($meals as $meal)
            <li class="flex items-center rounded gap-2 px-4 py-2 border-b border-gray-200 hover:bg-gray-200">
                <img class="w-9" src="{{ \Illuminate\Support\Facades\Storage::url($meal->image) }}" alt="icon">
                {{ $meal->name }}
            </li>
        @endforeach
    </ul>
</div>

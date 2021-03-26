<x-app-layout>
    <div class="py-16" style="background-image: url({{ asset('/img/background.jpg') }}); background-repeat: repeat-x;"></div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-24 grid grid-cols-12">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg col-span-9 lg:px-8 sm:px-4">
                <div class="mb-2" style="font-family: 'Truculenta', sans-serif;">
                    <h1 class="text-4xl">{{ $recipe->name }}</h1>
                    @foreach($recipe->tags as $tag)
                    <a href="#" class="bg-gray-200 text-lg rounded-lg px-0.5 hover:bg-gray-200">#{{ $tag->name }}</a>
                    @endforeach
                    <li class="flex items-center rounded gap-0.5 py-2 uppercase">
                        <img class="w-7" src="{{ \Illuminate\Support\Facades\Storage::url($recipe->meal->image) }}" alt="{{ $recipe->meal->name }}">
                        <span class="text-xl">{{ $recipe->meal->name }}</span>
                    </li>
                </div>
                <div class="h-72">
                    <img class="w-full h-full opacity-75 rounded-t-lg" src="{{ asset('/storage/images/recipes/ensalada-cesar.jpg') }}" alt="Sunset in the mountains" style="object-fit: cover;">
                </div>
                @livewire('table-ingredient-recipe', ['ingredients' => $recipe->ingredients])
                <div class="p-5" id="body">{!! $recipe->body !!}</div>
            </div>
            <div class="col-span-3">
                @livewire('meals-section')
            </div>
        </div>
    </div>
</x-app-layout>
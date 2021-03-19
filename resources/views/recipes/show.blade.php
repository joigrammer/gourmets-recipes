<x-app-layout>
    <div class="py-16" style="background-image: url({{ asset('/img/background.jpg') }}); background-repeat: repeat-x;"></div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-12">
            <div class="bg-gray-100 hover:opacity-80 overflow-hidden shadow-xs sm:rounded-lg col-span-9 lg:px-8 sm:px-4">
                <div class="mb-2" style="font-family: 'Truculenta', sans-serif;">
                    <h1 class="text-4xl">{{ $recipe->name }}</h1>
                    @foreach($recipe->tags as $tag)
                    <a href="#" class="bg-gray-200 text-lg rounded-lg px-0.5 hover:bg-gray-200">#{{ $tag->name }}</a>
                    @endforeach
                </div>
                <img class="w-full opacity-75 rounded-t-lg" src="{{ asset('/storage/images/recipes/ensalada-cesar.jpg') }}" alt="Sunset in the mountains">
                <div class="flex items-end gap-2">
                </div>
            </div>
            <div class="col-span-3">
                @livewire('meals-section')
            </div>
        </div>
    </div>
</x-app-layout>
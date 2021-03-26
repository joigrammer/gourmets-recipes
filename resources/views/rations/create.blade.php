<x-app-layout>
<div class="py-16" style="background-image: url({{ asset('/img/background.jpg') }}); background-repeat: repeat-x;"></div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-24 grid grid-cols-12">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg col-span-12 lg:px-8 sm:px-4">
                <div class="mb-2" style="font-family: 'Truculenta', sans-serif;">
                    <h1 class="text-4xl">{{ $ration->recipe->name }}</h1>      
                    @foreach($ration->recipe->tags as $tag)
                        <a href="#" class="bg-gray-200 text-lg rounded-lg px-0.5 hover:bg-gray-200">#{{ $tag->name }}</a>
                    @endforeach
                    <li class="flex items-center rounded gap-0.5 py-2 uppercase">
                        <img class="w-7" src="{{ \Illuminate\Support\Facades\Storage::url($ration->recipe->meal->image) }}" alt="{{ $ration->recipe->meal->name }}">
                        <span class="text-xl">{{ $ration->recipe->meal->name }}</span>
                    </li>
                </div>
                <img class="w-full opacity-75 rounded-t-lg" src="{{ asset('/storage/images/recipes/ensalada-cesar.jpg') }}" alt="Sunset in the mountains">
                @livewire('table-ingredient-recipe', ['ingredients' => $ration->recipe->ingredients])    
                            
                <!-- TODO: Analizar y decidir donde situar el body en la página.
                    <div class="p-5" id="body">{!! $ration->recipe->body !!}</div>
                    -->
            </div>
            <form action="{{ route('rations.store', ['ration' => $ration->id]) }}" method="post">
                @csrf
                <input type="number" name="rations" id="rations" min="1" value="1" max="{{ $ration->available() }}">
                @error('rations')
                    <p>{{ $message }}</p>
                @enderror
                <button type="submit">Reservar</button>
            </form>
        </div>
    </div>
</x-app-layout>
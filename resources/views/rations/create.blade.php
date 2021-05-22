<x-app-layout>
    <div class="py-16" style="background-image: url({{ asset('/img/background.jpg') }}); background-repeat: repeat-x;"></div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-24 grid grid-cols-12">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg col-span-9 lg:px-8 sm:px-4">
                <div class="mb-2" style="font-family: 'Truculenta', sans-serif;">
                    <h1 class="text-4xl">{{ $ration->recipe->name }}</h1>
                    @foreach($ration->recipe->tags as $tag)
                    <a href="#" class="bg-gray-200 text-lg rounded-lg px-0.5 hover:bg-gray-200">#{{ $tag->name }}</a>
                    @endforeach
                    <div class="flex justify-between items-end">
                        <div class="flex items-center rounded gap-0.5 py-2 uppercase">
                            <img class="w-7" src="{{ \Illuminate\Support\Facades\Storage::url($ration->recipe->meal->image) }}" alt="{{ $ration->recipe->meal->name }}">
                            <span class="text-xl">{{ $ration->recipe->meal->name }}</span>
                        </div>
                        <div class="flex items-center gap-1 py-2">
                            <span class="text-3xl">{{ $ration->recipe->user->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="h-2/6">
                    <img class="w-full h-full opacity-75 rounded-t-lg" src="{{ \Illuminate\Support\Facades\Storage::url($ration->recipe->image) }}" alt="{{ $ration->recipe->name }}" style="object-fit: cover;">
                </div>
                <div class="flex justify-between items-center px-4 py-2 bg-yellow-400">
                    <div class="flex py-2" style="font-family: 'Truculenta', sans-serif;">
                        <div class="py-1">
                        <img class="w-7 mr-2" src="{{ asset('storage/icons/calendar.svg') }}" alt="Calendar">
                        </div>
                        <div>
                            <p class="font-bold text-2xl leading-4">Fecha pautada para el {{ $ration->available_at->isoFormat('D MMMM Y') }}</p>
                            <p class="text-xl">Tenemos disponible {{ $ration->available() }} raciones para esta fecha.</p>
                        </div>
                    </div>
                    <form class="flex gap-1.5" action="{{ route('rations.store', ['ration' => $ration->id]) }}" method="post">
                        @csrf
                        <input type="number" name="rations" class="w-full py-0.5 border-2 border-gray-200 rounded-xl hover:border-gray-300 focus:outline-none focus:border-blue-500 transition-colors" id="rations" min="1" value="1" max="{{ $ration->available() }}">
                        @error('rations')
                        <p>{{ $message }}</p>
                        @enderror
                        <button class="p-1.5 bg-red-500 text-xl font-bold hover:bg-red-700 text-white rounded-lg uppercase" style="font-family: 'Truculenta', sans-serif;">
                            Reservar
                        </button>
                    </form>
                </div>
                @livewire('table-ingredient-recipe', [
                'ingredients' => $ration->recipe->ingredients,
                'allergens' => $ration->recipe->allergens
                ])
                <div class="p-5" id="body">{!! $ration->recipe->body !!}</div>
            </div>
            <div class="col-span-3">
                @livewire('meals-section')
            </div>
        </div>
    </div>
</x-app-layout>
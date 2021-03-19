<x-app-layout>
     <div class="py-16" style="background-image: url({{ asset('/img/background.jpg') }}); background-repeat: repeat-x;"></div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-12">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg col-span-9 lg:px-8 sm:px-4">
                <div class="ml-4 mb-2 uppercase" style="font-family: 'Truculenta', sans-serif;">
                    <h1 class="text-2xl">Todas las recetas</h1>
                    <p>({{ $recipes->count() }} recetas)</p>
                </div>
                <!--
                @foreach($recipes as $recipe)
                    @livewire('card-recipe', ['recipe' => $recipe])
                @endforeach  
                -->
                <div class="grid grid-cols-6">
                    @foreach($recipes as $recipe)
                        @livewire('mini-card-recipe', ['recipe' => $recipe])
                    @endforeach 
                </div>
            </div>
            <div class="col-span-3">
                @livewire('meals-section')
            </div>
        </div>
    </div>
</x-app-layout>
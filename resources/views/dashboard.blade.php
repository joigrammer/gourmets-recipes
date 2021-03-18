<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Truculenta:wght@100;200;300;400;500;600&display=swap');
    </style>
    <x-slot name="header">
        @livewire('navigation')
    </x-slot>

    <div class="py-16" style="background-image: url({{ asset('/img/background.jpg') }}); background-repeat: repeat-x;">

    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-6">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg col-span-4">
                @livewire('card-recipe')
                @livewire('card-recipe')
                @livewire('card-recipe')
                @livewire('card-recipe')
            </div>
            <div class="col-span-2">
                @livewire('meals-section')
            </div>
        </div>
    </div>
</x-app-layout>
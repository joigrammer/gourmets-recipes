<x-app-layout>
    <div class="py-16" style="background-image: url({{ asset('/img/background.jpg') }}); background-repeat: repeat-x;"></div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-24" style="font-family: 'Truculenta', sans-serif;">
        <h1 class="font-bold text-gray-800 text-4xl mt-8 uppercase">Calendario de raciones</h1>
        <p class="text-xl">En este clendario podrás ver las raciones de nuestras recetas disponibles en determinadas fechas.</p>
        <livewire:ration-schedule-test />
    </div>
</x-app-layout>
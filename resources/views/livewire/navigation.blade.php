<div class="space-x-2 sm:-my-px sm:ml-10 sm:flex">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Truculenta:wght@100;200;300;400;500;600&display=swap');
    </style>
    <ul class="flex text-xl gap-4" style="font-family: 'Truculenta', sans-serif;">
        <li class="flex gap-1">
            <img src="{{ asset('/icons/recipe-book.svg') }}" alt="recipe-book" class="w-5">
            <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="text-xl">
                {{ __('RECETAS') }}
            </x-jet-nav-link>
            <!--<a href="#">{{ __('RECETAS') }}</a>-->
        </li>
        <li class="flex gap-1">
            <img src="{{ asset('/icons/star.svg') }}" alt="recipe-book" class="w-5">
            <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('admin')" class="text-xl">
                {{ __('MÁS POPULARES') }}
            </x-jet-nav-link>
        </li>
        <li class="flex gap-1">
            <img src="{{ asset('/icons/serving-dish.svg') }}" alt="recipe-book" class="w-6">
            <x-jet-nav-link href="{{ route('rations.schedule') }}" :active="request()->routeIs('rations.schedule')" class="text-xl">
                {{ __('PLATOS DEL DIA') }}
            </x-jet-nav-link>
        </li>
    </ul>
</div>
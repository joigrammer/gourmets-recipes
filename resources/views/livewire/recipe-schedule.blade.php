<div class="flex px-4 py-1 bg-white bg-opacity-25 border-b text-lg border-gray-300 hover:bg-gray-100" style="font-family: 'Truculenta', sans-serif;">
    <div class="flex items-center">
        <img class="w-8" src="{{ \Illuminate\Support\Facades\Storage::url($recipe->meal->image) }}" alt="{{ $recipe->meal->name }}">
        <div class="flex flex-col items-start ml-4 text-gray-600 font-semibold">
            <div class="flex flex-col">
                <a href="#" class="text-2xl leading-5">{{ $recipe->name }}</a>
                <p class="text-lg uppercase">{{ $recipe->meal->name }}</p>
            </div>
            <div class="flex justify-between gap-2 text-base">
                <div class="rounded-lg px-2 text-lg bg-blue-300">
                    Tienes reservado (3) raciones.
                </div>
                <div class="uppercase rounded-lg px-2 bg-green-400">
                    Disponibles: 25
                </div>
            </div>
        </div>
    </div>
</div>
<div class="p-6 bg-white bg-opacity-25 border-b text-lg border-gray-300 hover:bg-gray-100" style="font-family: 'Truculenta', sans-serif;">
    <div class="flex items-center">
        <img class="w-9" src="{{ \Illuminate\Support\Facades\Storage::url($recipe->meal->image) }}" class="w-8 h-8 text-gray-400" alt="{{ $recipe->meal->name }}">
        <div class="ml-4 text-2xl text-gray-600 leading-7 font-semibold">
            <a href="#" class="text-2xl">{{ $recipe->name }}</a>
            <p class="text-lg">{{ $recipe->user->name }}</p>
        </div>
    </div>
    <div class="ml-12">
        <div class="mt-2 text-xl text-gray-500">
            {{ $recipe->extract }}
        </div>
        <div class="flex justify-between">
            <div class="flex items-end gap-2">
                @foreach($recipe->tags as $tag)
                    <a href="#" class="bg-gray-200 rounded-lg px-0.5 hover:bg-gray-200">#{{ $tag->name }}</a>
                @endforeach                             
            </div>
            <a class="ml-5" href="#">
                <div class="mt-3 flex items-center text-xl font-semibold text-indigo-700">
                    <div>Ver receta</div>
                    <div class="ml-1 text-indigo-500">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
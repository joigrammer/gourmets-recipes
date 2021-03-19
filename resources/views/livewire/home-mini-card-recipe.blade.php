<div class="m-1 bg-gray-100 hover:opacity-80 rounded-b-lg border-b text-lg border-gray-300 hover:bg-gray-100 xl:col-span-3 md:col-span-4 sm:col-span-6 col-span-12" style="font-family: 'Truculenta', sans-serif;">
    <img class="w-full opacity-75 rounded-t-lg" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
    <div class="flex items-center gap-2 text-xl xl:text-2xl pl-4 py-1 border-b border-gray-200">
        <img class="w-5 xl:w-7" src="{{ \Illuminate\Support\Facades\Storage::url($recipe->meal->image) }}" alt="{{ $recipe->meal->name }}">
        {{ $recipe->meal->name }}
    </div>
    <div class="px-4 py-2">
        <h1 class="font-bold leading-4 text-xl mb-2 hover:underline">
            <a href="#">{{ $recipe->name }}</a>
        </h1>
        <p class="text-grey-darker text-xl truncate">
            {{ $recipe->extract }}
        </p>        
        <div class="flex flex-wrap gap-0.5 text-base mt-2">
            @foreach($recipe->tags as $tag)
            <a href="#" class="bg-gray-200 rounded-lg px-0.5 hover:bg-gray-200">#{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
</div>
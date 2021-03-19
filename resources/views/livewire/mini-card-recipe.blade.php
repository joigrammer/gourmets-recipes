<div class="m-1 bg-gray-100 rounded-b-lg border-b text-lg border-gray-300 hover:bg-gray-100 col-span-4" style="font-family: 'Truculenta', sans-serif;">
    <img class="w-full opacity-75 rounded-t-lg" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
    <div class="px-4 py-2">
        <div class="font-bold text-lg">
            {{ $recipe->name }}
        </div>
        <p class="text-grey-darker text-base truncate">
            {{ $recipe->extract }}
        </p>
        <div class="flex flex-wrap gap-0.5 text-base mt-2">
            @foreach($recipe->tags as $tag)
            <a href="#" class="bg-gray-200 rounded-lg px-0.5 hover:bg-gray-200">#{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
</div>
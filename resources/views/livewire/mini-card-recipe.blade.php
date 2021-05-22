<div class="m-1 bg-gray-100 hover:opacity-80 rounded-b-lg border-b text-lg border-gray-300 hover:bg-gray-100 col-span-2" style="font-family: 'Truculenta', sans-serif;">
    <div class="h-36">
        <img class="w-full h-full opacity-75 rounded-t-lg" src="{{ \Illuminate\Support\Facades\Storage::url($recipe->image) }}" alt="{{ $recipe->name }}" style="object-fit: cover;">
    </div>
    <div class="flex items-center gap-0.5 pl-4 text-lg py-0.5 border-b border-gray-200 hover:underline">
        <img class="w-5" src="{{ \Illuminate\Support\Facades\Storage::url($recipe->meal->image) }}" alt="{{ $recipe->meal->name }}">
        <a href="#">{{ $recipe->meal->name }}</a>
    </div>
    <div class="px-4 py-2">
        <div class="font-bold leading-4 text-base hover:underline">
            <a href="{{ route('recipes.show', $recipe->slug) }}">{{ $recipe->name }}</a>
        </div>
        <!--
        <p class="text-grey-darker text-base truncate">
            {{ $recipe->extract }}
        </p>        
        <div class="flex flex-wrap gap-0.5 text-base mt-2">
            @foreach($recipe->tags as $tag)
            <a href="#" class="bg-gray-200 rounded-lg px-0.5 hover:bg-gray-200">#{{ $tag->name }}</a>
            @endforeach
        </div>
        -->
    </div>
</div>
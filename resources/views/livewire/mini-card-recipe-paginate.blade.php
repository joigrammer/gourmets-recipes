<div>
    <pre>{{ $recipes }}</pre>
    <div class="grid grid-cols-6">
        @foreach($recipes as $recipe)
            @livewire('mini-card-recipe', ['recipe' => $recipe])
        @endforeach
    </div>
    <div class="mt-5">
        {{ $recipes->links('vendor.pagination.simple-tailwind') }}
    </div>    
</div>
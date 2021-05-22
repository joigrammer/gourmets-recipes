<div>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewire('table-ingredient-recipe', [
    'ingredients' => $recipe->ingredients,
    'allergens' => $recipe->allergens
    ])
</div>
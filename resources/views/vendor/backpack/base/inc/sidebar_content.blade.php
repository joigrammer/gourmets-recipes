<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('category') }}'>
        <i class="fas fa-folder-open"></i>
        Categories
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('ingredient') }}'>
        <i class="fas fa-carrot"></i>
        Ingredients
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('recipe') }}'>
        <i class="fas fa-utensils"></i>
        Recipes
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('tag') }}'>
        <i class="fas fa-tag"></i>
        Tags
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('meal') }}'>
        <i class="fas fa-fish"></i>
        Meals
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('ration') }}'>
        <i class="fas fa-concierge-bell"></i>
        Rations
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('measurement') }}'>
        <i class="fas fa-weight"></i>
        Measurements
    </a>
</li>

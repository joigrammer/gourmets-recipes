<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('category') }}'>
        <i class="fas fa-folder-open" style="margin-right: 15px"></i>
        {{  trans('backpack::panel.categories') }}
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('ingredient') }}'>
        <i class="fas fa-carrot" style="margin-right: 15px"></i>
        {{  trans('backpack::panel.ingredients') }}
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('recipe') }}'>
        <i class="fas fa-utensils" style="margin-right: 15px"></i>
        {{  trans('backpack::panel.recipes') }}
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('tag') }}'>
        <i class="fas fa-tag" style="margin-right: 15px"></i>
        {{  trans('backpack::panel.tags') }}
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('meal') }}'>
        <i class="fas fa-fish" style="margin-right: 15px"></i>
        {{  trans('backpack::panel.meals') }}
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('ration') }}'>
        <i class="fas fa-concierge-bell" style="margin-right: 15px"></i>
        {{  trans('backpack::panel.rations') }}
    </a>
</li>
<li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('measurement') }}'>
        <i class="fas fa-weight" style="margin-right: 15px"></i>
        {{  trans('backpack::panel.measurements') }}
    </a>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-globe"></i> Translations</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('language') }}"><i class="nav-icon la la-flag-checkered"></i> Languages</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('language/texts') }}"><i class="nav-icon la la-language"></i> Site texts</a></li>
    </ul>
</li>

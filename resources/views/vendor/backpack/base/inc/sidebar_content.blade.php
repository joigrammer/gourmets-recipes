<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
    </a>
</li>

@if(backpack_user()->hasRole('admin'))
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
        </ul>
    </li>
@endif

@if(backpack_user()->can('view-categories'))
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('category') }}'>
            <i class="fas fa-folder-open" style="margin-right: 15px"></i>
            {{  trans('backpack::panel.categories') }}
        </a>
    </li>
@endcan

@if(backpack_user()->can('view-ingredients'))
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('ingredient') }}'>
            <i class="fas fa-carrot" style="margin-right: 15px"></i>
            {{  trans('backpack::panel.ingredients') }}
        </a>
    </li>
@endcan

@if(backpack_user()->can('view-meals'))
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('meal') }}'>
            <i class="fas fa-fish" style="margin-right: 15px"></i>
            {{  trans('backpack::panel.meals') }}
        </a>
    </li>
@endcan

@if(backpack_user()->can('view-measurements'))
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('measurement') }}'>
            <i class="fas fa-weight" style="margin-right: 15px"></i>
            {{  trans('backpack::panel.measurements') }}
        </a>
    </li>
@endcan

@if(backpack_user()->can('view-rations'))
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('ration') }}'>
            <i class="fas fa-concierge-bell" style="margin-right: 15px"></i>
            {{  trans('backpack::panel.rations') }}
        </a>
    </li>
@endcan

@if(backpack_user()->can('view-recipes'))
    <li class='nav-item'>
        <a class='nav-link' href='{{ backpack_url('recipe') }}'>
            <i class="fas fa-utensils" style="margin-right: 15px"></i>
            {{  trans('backpack::panel.recipes') }}
        </a>
    </li>
@endcan

@if(backpack_user()->can('view-tags'))
    <li class='nav-item'>
    <a class='nav-link' href='{{ backpack_url('tag') }}'>
    <i class="fas fa-tag" style="margin-right: 15px"></i>
        {{  trans('backpack::panel.tags') }}
        </a>
        </li>
@endcan

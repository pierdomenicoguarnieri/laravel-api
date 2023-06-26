<aside class="h-100 text-white">

  <ul class="p-0 w-100">
    <li class="w-100 py-2 {{Route::currentRouteName() === 'admin.home' ?  'active' : ''}}">
      <a href="{{route('admin.home')}}"><i class="fa-solid fa-chart-line me-2"></i>Dashboard</a>
    </li>

    <li class="w-100 py-2 {{Route::currentRouteName() === 'admin.types.index' || Route::currentRouteName() === 'admin.types.show' || Route::currentRouteName() === 'admin.types.edit' ?  'active' : '' }}">
      <a href="{{route('admin.types.index')}}"><i class="fa-solid fa-folder-tree me-2"></i>Types</a>
    </li>

    <li class="w-100 py-2 {{Route::currentRouteName() === 'admin.technologies.index' || Route::currentRouteName() === 'admin.technologies.show' || Route::currentRouteName() === 'admin.technologies.edit' ?  'active' : '' }}">
      <a href="{{route('admin.technologies.index')}}"><i class="fa-solid fa-microchip me-2"></i>Technologies</a>
    </li>

    <li class="w-100 py-2 {{Route::currentRouteName() === 'admin.projects.index' || Route::currentRouteName() === 'admin.projects.show' || Route::currentRouteName() === 'admin.projects.edit' || str_contains(Route::currentRouteName(), 'admin.orderBy') ?  'active' : '' }}">
      <a href="{{route('admin.projects.index')}}"><i class="fa-solid fa-diagram-project me-2"></i>Projects</a>
    </li>

    <li class="w-100 py-2 {{Route::currentRouteName() === 'admin.projects.create' ?  'active' : ''}}">
      <a href="{{route('admin.projects.create')}}"><i class="fa-solid fa-square-plus me-2"></i>New Project</a>
    </li>
  </ul>
</aside>

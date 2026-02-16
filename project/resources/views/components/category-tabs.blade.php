<ul class="flex flex-wrap text-sm font-medium text-center text-body justify-center">
    <li class="me-2">
        <a href="{{ route('dashboard') }}" 
        class="{{ Route::currentRouteNamed('dashboard') 
        ? 'inline-block px-4 py-2 text-white bg-gray-800 rounded-lg active ' 
        : 'inline-block px-4 py-2 rounded-lg hover:bg-gray-100 hover:text-heading hover:bg-neutral-secondary-soft' }}" aria-current="page">
            All
        </a>
    </li>
    @foreach($categories as $category)
        <li class="me-2">
            <a href="{{ route('post.byCategory', $category->name) }}" 
                class="{{ Route::currentRouteNamed('post.byCategory') && request('category')->name === $category->name 
                ? 'inline-block px-4 py-2 text-white bg-gray-800 rounded-lg active' 
                : 'inline-block px-4 py-2 rounded-lg hover:bg-gray-100 hover:text-heading hover:bg-neutral-secondary-soft' }}" >
                {{ $category['name'] }}
            </a>
        </li>
    @endforeach
    @auth
        <li class="me-2">
            <a href="{{ route('post.byFollowed') }}" 
                class="{{ Route::currentRouteNamed('post.byFollowed') 
                ? 'inline-block px-4 py-2 text-white bg-gray-800 rounded-lg active' 
                : 'inline-block px-4 py-2 rounded-lg hover:bg-gray-100 hover:text-heading hover:bg-neutral-secondary-soft' }}" >
                Followed
            </a>
        </li>         
    @endauth
</ul>
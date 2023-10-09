<ul>
    <h1 style="padding:10px 20px;text-align: center;font-weight: bold;border-bottom: 1px solid #4b5563">
        {{__('admin/general.admin_panel')}}
    </h1>
    <!-- Dashboard -->
    <li>
        <a href="{{ route('admin.dashboard') }}">
            @include('icons.home')
            <span>{{__('admin/general.dashboard')}}</span>
        </a>
    </li>
    <!-- Items -->
    <li class="nav-item {{Route::is('admin.items.*') ? 'active' : ''}}
        {{Route::is('admin.item-categories.*') ? 'active' : ''}}
        {{Route::is('admin.item-attributes.*') ? 'active' : ''}}">
        <a href="{{route('admin.items.index')}}"
           class="">
            @include('icons.circle-stack')
            <p>
                {{__('admin/item.items')}}
            </p>
        </a>
        <ul class="nav-treeview">
            <li class="nav-item">
                <a href="{{route('admin.items.index')}}"
                   class="nav-link {{Route::is('admin.items.index') ? 'active' : ''}}">
                    @include('icons.chevron-double-right',['class' => 'w-4 h-4'])
                    <p>{{__('admin/item.all_items')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.items.create')}}"
                   class="nav-link {{Route::is('admin.items.create') ? 'active' : ''}}">
                    @include('icons.chevron-double-right',['class' => 'w-4 h-4'])
                    <p>{{__('admin/item.add_item')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.item-categories.index')}}"
                   class="nav-link {{Route::is('admin.item-categories.*') ? 'active' : ''}}">
                    @include('icons.chevron-double-right',['class' => 'w-4 h-4'])
                    <p>{{__('admin/category.categories')}}</p>
                </a>
            </li>
            <!-- Özellikler -->
            <li class="nav-item">
                <a href="{{route('admin.item-attributes.index')}}"
                   class="nav-link {{Route::is('admin.item-attributes.*') ? 'active' : ''}}">
                    @include('icons.chevron-double-right',['class' => 'w-4 h-4'])
                    <p>{{__('admin/attributes.attributes')}}</p>
                </a>
            </li>
        </ul>
    </li>

    <!-- Media -->
    <li>
        <a href="{{ route('admin.media-library.index') }}">
            @include('icons.photo')
            <span>{{__('admin/media_library.media_library')}}</span>
        </a>
    </li>
    <!-- Contacts -->
    <li>
        <a href="{{ route('admin.contacts.index') }}">
            @include('icons.inbox')
            <span>{{__('admin/contact.contact')}}</span>
        </a>
    </li>
    <!-- Blog: Tümü, Yeni Ekle-->

    <li class="nav-item {{Route::is('admin.blogs.*') ? 'active' : ''}}">
        <a href="{{route('admin.blogs.index')}}" class="nav-link ">
            @include('icons.rss')
            <p>
                {{__('admin/blog.blog')}}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('admin.blogs.index')}}"
                   class="nav-link {{Route::is('admin.blogs.index') ? 'active' : ''}}">
                    @include('icons.chevron-double-right',['class' => 'w-4 h-4'])
                    <p>{{__('admin/blog.all_blog_posts')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.blogs.create')}}"
                   class="nav-link {{Route::is('admin.blogs.create') ? 'active' : ''}}">
                    @include('icons.chevron-double-right',['class' => 'w-4 h-4'])
                    <p>{{__('admin/blog.add_blog')}}</p>
                </a>
            </li>
        </ul>
    </li>
    <!-- Users -->
    <li class="nav-item {{Route::is('admin.users.*') ? 'active' : ''}}">
        <a href="{{ route('admin.users.index') }}">
            @include('icons.users')
            <span>{{__('admin/user.users')}}</span>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('admin.users.index')}}"
                   class="nav-link {{Route::is('admin.users.index') ? 'active' : ''}}">
                    @include('icons.chevron-double-right',['class' => 'w-4 h-4'])
                    <p>{{__('admin/user.all_users')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.users.create')}}"
                   class="nav-link {{Route::is('admin.users.create') ? 'active' : ''}}">
                    @include('icons.chevron-double-right',['class' => 'w-4 h-4'])
                    <p>{{__('admin/user.add_user')}}</p>
                </a>
            </li>
        </ul>
    </li>
    <!-- log out -->
    <li>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            @include('icons.arrow-right-on-rectangle')
            <span>{{__('admin/general.logout')}}</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </li>
</ul>

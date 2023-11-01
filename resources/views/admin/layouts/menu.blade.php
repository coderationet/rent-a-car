<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
    data-accordion="false">
    <li class="nav-item {{Route::is('admin.items.*') ? 'menu-open' : ''}} {{Route::is('admin.item-categories.*') ? 'menu-open' : ''}} {{Route::is('admin.item-attributes.*') ? 'menu-open' : ''}}">
        <a href="{{route('admin.items.index')}}" class="nav-link
        {{Route::is('admin.items.*') ? 'active' : ''}}
        {{Route::is('admin.item-categories.*') ? 'active' : ''}}
        {{Route::is('admin.item-attributes.*') ? 'active' : ''}}
        ">
            <i class="nav-icon fas fa-edit"></i>
            <p>
                {{__('admin/item.items')}}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview ">
            <li class="nav-item">
                <a href="{{route('admin.items.index')}}"
                   class="nav-link {{Route::is('admin.items.index') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('admin/item.all_items')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.items.create')}}"
                   class="nav-link {{Route::is('admin.items.create') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('admin/item.add_item')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.item-categories.index')}}"
                   class="nav-link {{Route::is('admin.item-categories.*') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('admin/category.categories')}}</p>
                </a>
            </li>
            <!-- Özellikler -->
            <li class="nav-item">
                <a href="{{route('admin.item-attributes.index')}}"
                   class="nav-link {{Route::is('admin.item-attributes.*') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('admin/attributes.attributes')}}</p>
                </a>
            </li>
        </ul>
    </li>


    <!-- Pages -->
    <li class="nav-item {{Route::is('admin.pages.*') ? 'menu-open' : ''}}">
        <a href="{{route('admin.pages.index')}}" class="nav-link
        {{Route::is('admin.pages.*') ? 'active' : ''}}
        ">
            <i class="nav-icon fas fa-edit"></i>
            <p>
                {{__('admin/pages.pages')}}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview ">
            <li class="nav-item">
                <a href="{{route('admin.pages.index')}}"
                   class="nav-link {{Route::is('admin.pages.index') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('admin/pages.all_pages')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.pages.create')}}"
                   class="nav-link {{Route::is('admin.pages.create') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('admin/pages.add_page')}}</p>
                </a>
            </li>
        </ul>
    </li>

    <!-- Media Library -->
    <li class="nav-item">
        <a href="{{route('admin.media-library.index')}}"
           class="nav-link {{Route::is('admin.media-library.*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-photo-video"></i>
            <p>
                {{__('admin/media_library.media_library')}}
            </p>
        </a>
    </li>

    <!-- Slider -->
    <li class="nav-item">
        <a href="{{route('admin.sliders.index')}}" class="nav-link {{Route::is('admin.sliders.*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-images"></i>
            <p>
                {{__('admin/slider.slider')}}
            </p>
        </a>
    </li>

    <!-- Menü Linkleri -->
    <li class="nav-item">
        <a href="{{route('admin.menu-links.index')}}"
           class="nav-link {{Route::is('admin.menu-links.*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-link"></i>
            <p>
                {{__('admin/menu_links.menu_links')}}
            </p>
        </a>
    </li>


    <!-- İletişim -->
    <li class="nav-item {{Route::is('admin.contacts.*') ? 'menu-open' : ''}}">
        <a href="{{route('admin.contacts.index')}}" class="nav-link {{Route::is('admin.contacts.*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-address-book"></i>
            <p>
                {{__('admin/contact.contact')}}
            </p>
        </a>
    </li>

    <!-- Blog: Tümü, Yeni Ekle-->

    <li class="nav-item {{Route::is('admin.blogs.*') ? 'menu-open' : ''}} {{Route::is('admin.blogs.*') ? 'menu-open' : ''}}">
        <a href="{{route('admin.blogs.index')}}" class="nav-link {{Route::is('admin.blogs.*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-blog"></i>
            <p>
                {{__('admin/blog.blog')}}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview ">
            <li class="nav-item">
                <a href="{{route('admin.blogs.index')}}"
                   class="nav-link {{Route::is('admin.blogs.index') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('admin/blog.all_blog_posts')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.blogs.create')}}"
                   class="nav-link {{Route::is('admin.blogs.create') ? 'active' : ''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{__('admin/blog.add_blog')}}</p>
                </a>
            </li>

        </ul>
    </li>


    <!-- Users -->

    <li class="nav-item {{Route::is('admin.users.*') ? 'menu-open' : ''}}">
        <a href="{{route('admin.users.index')}}" class="nav-link {{Route::is('admin.users.*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-users"></i>
            <p>
                {{__('admin/user.users')}}
            </p>
        </a>
    </li>

    <!-- settings page -->
    <li class="nav-item {{Route::is('admin.settings.*') ? 'menu-open' : ''}}">
        <a href="{{route('admin.settings.index')}}" class="nav-link {{Route::is('admin.settings.*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
                {{__('admin/settings.settings')}}
            </p>
        </a>
    </li>
</ul>

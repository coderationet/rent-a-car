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
    <!-- Users -->
    <li>
        <a href="{{ route('admin.users.index') }}">
            @include('icons.users')
            <span>{{__('admin/user.users')}}</span>
        </a>
    </li>
    <!-- log out -->
    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            @include('icons.arrow-right-on-rectangle')
            <span>{{__('admin/general.logout')}}</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </li>
</ul>

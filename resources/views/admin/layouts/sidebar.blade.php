<ul>
    <h1 style="padding:10px 20px;text-align: center;font-weight: bold;border-bottom: 1px solid #4b5563">
        Yönetim Paneli
    </h1>
    <li>
        <a href="{{ route('admin.dashboard') }}">
            @include('icons.home')
            <span>Gösterge Paneli</span>
        </a>
    </li>
    <!-- Media -->
    <li>
        <a href="{{ route('admin.media-library.index') }}">
            @include('icons.photo')
            <span>Ortam Kütüphanesi</span>
        </a>
    </li>
    <!-- Users -->
    <li>
        <a href="{{ route('admin.users.index') }}">
            @include('icons.users')
            <span>Kullanıcılar</span>
        </a>
    </li>
</ul>

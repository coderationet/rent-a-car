<ul class="flex flex-col">
    <!-- Edit Profile -->
    <li class="border-b-1 px-2 py-4  hover:bg-gray-200 border-b">
        <a href="{{ route('profile.edit') }}" class="block py-2 px-4">
            {{ __('Edit Profile') }}
        </a>
    </li>
    <!-- Reservations -->
    <li class="border-b-1 px-2 py-4  hover:bg-gray-200">
        <a href="{{ route('front.home') }}" class="block py-2 px-4">
            {{ __('Reservations') }}
        </a>
    </li>
</ul>

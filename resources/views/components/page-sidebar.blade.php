<div class="mb-3">
    <ul class="list-group">
        @foreach($pages as $page_)
            <li
                @if($page_->id == $page->id)
                    class="list-group-item active text-decoration-none" aria-current="true"
                @else
                    class="list-group-item text-decoration-none"
                @endif
            >
                <a href="{{route('front.page.show', $page_->slug)}}"
                   @if($page_->id == $page->id)
                       class="text-white text-decoration-none"
                   @else
                       class="text-decoration-none"
                    @endif
                >{{$page_->name}}</a>
            </li>
        @endforeach
        <!-- Contact page -->
        <li
            @if(request()->routeIs('front.page.contact'))
                class="list-group-item active text-decoration-none" aria-current="true"
            @else
                class="list-group-item text-decoration-none"
            @endif
        >
            <a href="{{route('front.page.contact')}}"
               @if(request()->routeIs('front.page.contact'))
                   class="text-white text-decoration-none"
               @else
                   class="text-decoration-none"
                @endif
            >{{__('front/menu.contact')}}</a>
        </li>
    </ul>
</div>

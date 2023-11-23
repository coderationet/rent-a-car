<div class="mb-3 h-max">
    <ul class="flex flex-col ">
        @foreach($pages as $page_)
            <li
                class="
                 p-3
                @if($page_->id == $page->id)
                    text-white bg-gray-400
            @else
            hover:bg-gray-400
            hover:text-white
            @endif">
                <a href="{{route('front.page.show', $page_->slug)}}">{{$page_->name}}</a>
            </li>

        @endforeach
        <!-- Contact page -->
        <li
            class="
                 p-3
                @if(request()->routeIs('front.page.contact'))
            text-white bg-gray-400
            @else
            hover:bg-gray-400
            hover:text-white
            @endif"
        >
            <a href="{{route('front.page.contact')}}"
            >{{__('front/menu.contact')}}</a>
        </li>
    </ul>
</div>

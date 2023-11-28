<div>
    <ul>
        <li class="font-bold mb-3">Pages</li>
        <li><a href="{{route('front.page.show',['about'])}}">About</a></li>
        <li><a href="{{url('contact')}}">Contact</a></li>
        <li><a href="">Blog</a></li>
    </ul>
</div>
<div>
    <ul>
        <li class="font-bold mb-3">Categories</li>
        @foreach($categories as $category)
            <li><a href="{{route('front.search.index').'/'.$category->slug}}">{{$category->name}}</a></li>
        @endforeach
    </ul>
</div>


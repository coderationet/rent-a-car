<div class="container mt-3">
    <nav>
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
                @if($loop->index > 0 && $loop->index < count($breadcrumbs))
                    {{view('icons.chevron-right',['class' => 'w-3 h-3'])}}
                @endif
                <li class="breadcrumb-item active"><a href="{{$breadcrumb['url']}}">{{$breadcrumb['name']}}</a></li>
            @endforeach
        </ol>
    </nav>
</div>

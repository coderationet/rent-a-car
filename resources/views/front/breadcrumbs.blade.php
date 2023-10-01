<div class="container mt-3">
    <nav>
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item active"><a href="{{$breadcrumb['url']}}">{{$breadcrumb['name']}}</a></li>
            @endforeach
        </ol>
    </nav>
</div>

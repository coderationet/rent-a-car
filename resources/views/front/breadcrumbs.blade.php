<div class="container">
    <nav aria-label="breadcrumb" class="my-3 rounded bg-custom-light p-3 py-2">
        <ol class="breadcrumb p-0 m-0 fs-14">
            @foreach($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item active"><a href="{{$breadcrumb['url']}}">{{$breadcrumb['name']}}</a></li>
            @endforeach
        </ol>
    </nav>
</div>

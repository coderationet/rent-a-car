<div class="container mt-5">
    <div class="row text-center">
        <h1>
            {{$category->name}}
        </h1>
        @foreach($items as $item)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            {{$item->title}}
                        </h5>
                    </div>
                    <div class="card-body d-flex gap-1 justify-content-between flex-column gap-2">
                        <img src="{{asset('storage/media/'.$item->thumbnail->name)}}" alt="{{$item->title}}"
                             class="img-fluid">
                        <p class="card-text text-justify p-0 m-0 text-center">
                            {{number_format($item->price, 2, ',', '.')}} {{__('front/general.currency_symbol')}}
                        </p>
                        <a href="{{route('front.item.show', $item->slug)}}" class="btn btn-primary w-100 ">
                            {{__('front/general.details')}}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

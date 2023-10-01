<div class="row mt-4">
    <div class="col-md-12">
        <div class="card bg-light">
            <div class="card-header">
                <h5 class="card-title mt-1">
                    {{ __('front/appointment-form.title') }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{route('front.page.contact.post')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{session()->get('error')}}
                        </div>
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="name" class="fs-14">{{__('front/general.name')}}</label>
                        <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="fs-14">{{__('front/general.email')}}</label>
                        <input type="text" class="form-control" value="{{old('email')}}" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="message">{{__('front/general.message')}}</label>
                        <textarea class="form-control" id="message" name="message" rows="3">[{{route('front.item.show',$item->slug)}}] </textarea>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary float-left ms-auto">
                            {{__('front/general.send')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

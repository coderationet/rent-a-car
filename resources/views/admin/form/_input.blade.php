<div class="form-group {{isset($classes) ? $classes : ''}}">
    <label for="{{$input_name}}">{{$title}}</label>
    <input type="text" class="form-control {{$input_name}}" id="{{$input_name}}"
           name="{{$input_name}}"
           @isset($item)
               value="{{$item->$input_name}}"
           @endisset

           @isset($required)
               required
           @endisset

           @isset($placeholder)
               placeholder="{{$placeholder}}"
           @endisset
           @isset($value)
               value="{{$value}}"
        @endisset
    >

    @if(isset($with_alerts) && $with_alerts == true)
        <div class="alert alert-success d-none mt-3"></div>
        <div class="alert alert-danger d-none mt-3"></div>
    @endif
</div>

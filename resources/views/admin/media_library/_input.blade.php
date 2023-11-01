@php
    $multiple_file = isset($multiple_file) && $multiple_file ;
@endphp
@if($multiple_file)
    @php
        $input_value = isset($item) && $item->$relation->count() ? implode(',',$item->$relation->pluck('id')->toArray()) : '';
    @endphp
    <input type="hidden" name="{{$input_name}}"
           id="{{$input_name}}"
           class="gc-image-library-field"
           {{isset($multiple_file) && $multiple_file ? 'multiple' : ''}}
           value="{{$input_value}}">
    @if(isset($item) && $item->$relation->count())
        <div class="gc-library-preview-container multiple-image has-image"
             data-element-id="file_desktop">
            @foreach($item->$relation as $media_item)
                <div class="image-item">
                    @if($media_item->type == 'image')
                        <img src="{{asset('storage/media/'.$media_item->name)}}"
                             alt="{{$media_item->name}}">
                    @endif
                    @if($media_item->type == 'video')
                        <video style="width: 100%" controls>
                            <source
                                src="{{asset('storage/media/'.$media_item->name)}}"
                                type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                    @if($media_item->type == 'application')
                        <div>
                            <img src="{{asset('storage/media/default/file.jpg')}}">
                            <a href="{{asset('storage/media/'.$media_item->name)}}"
                               target="_blank" class="btn btn-primary btn-sm">İndir</a>
                        </div>
                    @endif
                    <div class="remove-item" data-element-id="{{$input_name}}" data-file-id="{{$media_item->id}}">Sil
                    </div>
                </div>
            @endforeach
        </div>
        <div class="gc-image-preview-container-buttons">
            <button type="button" class="btn btn-primary btn-sm multiple-image add-new"
                    data-element-id="{{$input_name}}"> Yeni Ekle
            </button>
        </div>
    @endif
@else
    <input type="hidden" name="{{$input_name}}"
           class="gc-image-library-field"
           id="{{$input_name}}"
           value="{{isset($item) ? $item->$input_name : ''}}">

    @if(isset($item) && !empty($item->$relation ))
        <div class="gc-library-preview-container single-image"
             data-element-id="file_desktop">
            @if($item->$relation->type == 'image')
                <img src="{{asset('storage/media/'.$item->$relation->name)}}"
                     alt="{{$item->$relation->name}}" CLASS="cursor-pointer">
            @endif
            @if($item->$relation->type == 'video')
                <video style="width: 100%" controls>
                    <source
                        src="{{asset('storage/media/'.$item->$relation->name)}}"
                        type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif
        </div>
        <div class="gc-image-preview-container-buttons">
            <button type="button" class="btn btn-primary btn-sm add-new single-image" data-element-id="{{$input_name}}">
                Yeni Ekle
            </button>
            <button type="button" class="btn btn-primary btn-sm remove single-image" data-element-id="{{$input_name}}">
                Kaldır
            </button>
        </div>
    @endif
@endif
@pushonce('extra-footer')
    @include('admin.media_library.form-dialog-includes')
@endpushonce

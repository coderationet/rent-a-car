<a href="{{route('admin.'.$route_name.'.edit', $item->id)}}"
   class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>
    {{__('admin/general.edit')}}</a>
@if(!isset($strict_mode) || $strict_mode === false)
    <form
        action="{{route('admin.'.$route_name.'.destroy', $item->id)}}"
        method="POST" style="display: inline-block">
        @csrf
        @method('DELETE')
        <button
            onclick="return confirm('Are you sure?')"
            type="submit" class="btn btn-danger btn-xs"><i
                class="fa fa-trash"></i> {{__('admin/general.delete')}}
        </button>
    </form>
@endif

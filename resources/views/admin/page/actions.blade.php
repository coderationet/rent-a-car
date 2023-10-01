<a href="{{ route('admin.pages.edit', $page->id) }}"
    title="{{__('admin/general.edit')}}"
   class="btn btn-primary btn-xs">
    <i class="fa fa-pen"></i> {{__('admin/general.edit')}}
</a>
@if(!$page->is_protected)
    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit"
                onclick="return confirm('{{__('admin/general.are_you_sure_to_delete')}}')"
                title='{{__('admin/general.delete')}}' class="btn btn-danger btn-xs">
            <i class="fa fa-trash"></i> {{__('admin/general.delete')}}
        </button>
    </form>
@endif

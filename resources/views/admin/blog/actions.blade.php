<a href="{{ route('admin.blogs.edit', $blog->id) }}"
    title="{{__('admin/general.edit')}}"
   class="btn btn-primary btn-sm">
    <i class="fa fa-pen"></i>
</a>
<form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block">
    @csrf
    @method('DELETE')
    <button type="submit"
            onclick="return confirm('{{__('admin/general.are_you_sure_to_delete')}}')"
            title='{{__('admin/general.delete')}}' class="btn btn-danger btn-sm">
        <i class="fa fa-trash"></i>
    </button>
</form>

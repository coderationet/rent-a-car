<!-- edit update delete action buttons for $item -->
<a href="{{ route('admin.items.edit', $item->id) }}" class="btn btn-primary btn-xs">
    <i class="fa fa-edit"></i>
    {{__('admin/general.edit')}}</a>
<form action="{{ route('admin.items.destroy', $item->id) }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button
        onclick="return confirm('{{__('admin/general.are_you_sure_to_delete')}}');"
        type="submit" class="btn btn-danger btn-xs">
        <i class="fa fa-trash"></i>
        {{__('admin/general.delete')}}</button>
</form>

<a href="{{route('admin.contacts.edit', $message->id)}}"
   title="{{__('admin/general.read')}}"
   class="btn btn-secondary btn-sm">
    <i class="fa fa-book"></i>
</a>
<!-- delete -->
<form action="{{route('admin.contacts.destroy', $message->id)}}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" title="{{__('admin/general.delete')}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
</form>

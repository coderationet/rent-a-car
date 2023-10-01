<a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-primary btn-xs">
    <i class="fa fa-edit"></i>
    {{__('admin/general.edit')}}
</a>
<!-- delete -->
<form action="{{route('admin.users.destroy', $user->id)}}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button
        onclick="return confirm('{{__('admin/general.are_you_sure_to_delete')}}')"
        type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
        {{__('admin/general.delete')}}
    </button>
</form>

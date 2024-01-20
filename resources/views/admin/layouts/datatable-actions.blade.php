<td>
    @if(isset($editUrl))
        <a href="{{ $editUrl }}" class="btn btn-xs btn-primary">Edit</a>
    @endif
    @if(isset($deleteUrl))
        <form action="{{ $deleteUrl }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
        </form>
    @endif

</td>

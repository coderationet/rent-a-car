<td>
    <a href="{{ $editUrl }}" class="btn btn-xs btn-primary">Edit</a>
    <form action="{{ $deleteUrl }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
    </form>
</td>

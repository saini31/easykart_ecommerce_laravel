@extends('Admin.layout.layout')
@section('content')
<!-- <h1>categories list</h1> -->
<table class="table">
    <thead>
        <tr>
            <td>S.No.</td>
            <td>Category Name</td>
            <td> Parent Category </td>
            <td>Create date</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $key=>$category)
        <tr>
            <td>{{ $key+1}}</td>
            <td>{{$category->name}}</td>
            <td> @if($category->category_id)
                {{$category->parent->name}}
                @else
                No Parent category
                @endif
            </td>
            <td>{{$category->created_at}}</td>
            <td>
                <a href="{{route('category.edit',$category->id)}}" style="font-size: 17px;padding:5px;"><i class="fa fa-edit"></i></a>
                <a href="#" class="category_delete" data-id="{{$category->id}}" style="font-size: 17px;padding:5px;"><i class="fa fa-trash"></i></a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
@endsection
@push('footer-script')
<script>
    $('.category_delete').on('click', function() {
        // 
        // event.preventDefault(); // Prevent the default action of clicking on a link

        if (confirm('Are you sure you want to delete this category?')) {
            var id = $(this).data('id');
            alert(id);
            $.ajax({
                url: "{{ route('category.delete', 'id')}}".replace('id', id),
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    location.reload(); // Reload the page after successful deletion
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle errors if any
                }
            });
        }
    });
</script>
@endpush
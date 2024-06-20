@extends('Admin.layout.layout')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>SNo.</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Create Date</th>
            
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $key=>$user)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
           <td>
            <form id="delete-form" action="{{ route('user_delete', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="fa fa-trash"></button>
                </form>   
           </td>
            
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
 <script>
    // Submit the form asynchronously
    $('#delete-form').submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');

        $.ajax({
            url: url,
            method: method,
            data: form.serialize(),
            success: function(response) {
                // Handle success response
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });
</script> 
<x-admin-master>

@section('content')

<h1> Create a nickname and status</h1>

<form method="post" action="{{route('users.index')}}" enctype="multipart/form-data">
@csrf


<div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" >
        <option>Izaberi</option>
    <option>active</option>
    <option>not active</option>
    <option>off</option>
   </select>
</div>


<button type="submit" class="btn btn-primary">Submit</button>


</form>


@endsection
</x-admin-master>
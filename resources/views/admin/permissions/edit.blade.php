<x-admin-master>
@section('content')

<h1>Edit permission: {{$permission->name}}</h1>
<div class="row">
@if(session()->has('permission-updated'))
    <div class="alert alert-success form-control">
    {{session('permission-updated')}}</div>
@endif
</div>

<div class="row">

<div class="col-sm-6">

<form method="post" action="{{route('permissions.update', $permission->id)}}">
@csrf @method('PUT')
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control" id="name" value="{{$permission->name}}">
</div>
<button class="btn btn-primary">Update</button>

</form>
</div>
</div>


@endsection

</x-admin-master>
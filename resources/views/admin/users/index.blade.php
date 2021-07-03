<x-admin-master>
@section('content')
<h1>Users </h1>
@if(Session::has('message'))
<div class="alert alert-danger">{{Session::get('message')}}</div>
@endif

    <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Registered date</th>
                      <th>Updated profile date</th>
                      <th>Delete</th>

                     
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Id</th>
                      <th>Username</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Registered date</th>
                      <th>Updated profile date</th>
                      <th>Delete</th>
                      
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        
                        <td>
                        {{$user->username}}</td>
                        <td>
                        <img height="50px" src="{{$user->avatar}}" alt=""></td>
                        <td>{{$user->name}}</td>
                        <td><a href="{{route('user.create', $user->id)}}"> Novi status</td>

                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                        <td>
                           
                              <form method="post" action="{{route('user.destroy', $user->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                              
                                 <button type="submit" class="btn btn-danger">Delete</button>
                              
                              
                              </form>
                            
                           </td>
                    </tr>

                    @endforeach
                  </tbody>
                  


                </table>
            



@endsection

@section('scripts')

<script src="{{asset('datatables/jquery.dataTables.min.js')}}" defer ></script>
  <script src="{{asset('/datatables/dataTables.bootstrap4.min.js')}}" defer></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/datatables-demo.js')}}" defer></script>

@endsection
</x-admin-master>
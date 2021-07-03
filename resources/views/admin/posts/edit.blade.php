<x-admin-master>

@section('content')

<h1> Edit a post</h1>

<form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
@csrf
@method('PATCH')
<div class="form-group">
        <label for="title">Title</label>
        <input type="text" 
        name="title"
         class="form-control" 
        id="title"
        aria-describedby=""
        placeholder="Enter title"
        value="{{$post->title}}">
</div>
<div class="form-group">
    <div><img height="100px" src="{{$post->post_image}}" alt=""></div>
        <label for="file">File</label>
        <input type="file" 
        name="post_image"
         class="form-control-file" 
        id="post_image">
</div>

<div class="form-group">
      <textarea name="body"
      id="body"
      class="form-control"
      cols="30"
      rows="10">value="{{$post->body}}"</textarea>
</div>
<button type="submit" class="btn btn-success">Update</button>

</form>





@endsection
</x-admin-master>
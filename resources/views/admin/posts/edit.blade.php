@extends('layouts.admin')

@section('content')
<div class="container">
  <h1 class="mb-4">Edit posts</h1>

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
    </div>

    <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" name="body" id="body">{{ old('body', $post->body)}}</textarea>
    </div>

    <div class="form-group">
        <label for="path_img">
            <span class="d-block"  >Post img</span>
            @isset($post->path_img)
                <img width="200" src="{{asset('storage/' . $post->path_img)}}" alt="{{ $post->title }}">

                <h6 class="mt-4" >Change</h6>
            @endisset
        </label>
        <input class="form-control p-1" type="file" name="path_img" id="path_img" accept="image/*">
    </div>


    <input class="btn btn-primary" type="submit" value="Edit"> 
  </form>

    
</div>
@endsection

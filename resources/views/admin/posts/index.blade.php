@extends('layouts.admin')

@section('content')
<div class="container">

    @if (session('post-deleted'))
        <div class="alert alert-success">
            <div>
                Post deleted success
                {{session('post-deleted')}}
            </div>
        </div>
    @endif

  <h1 class="mb-4">Blog Archive</h1>

  <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Created</th>
            <th>Updated</th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td><span>{{ $post->id }}</span></td>
                <td><p>{{ $post->title }}</p></td>
                <td><p>{{ $post->created_at}}</p></td>
                <td><p>{{ $post->updated_at}}</p></td>
                <td>
                    <a class="btn btn-sm btn-success "href="{{ route('admin.posts.show', $post->id)}}">Show</a>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary"href="{{route('admin.posts.edit', $post->id)}}">Edit</a>
                </td>
                <td>
                    <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                    </form>
                </td>
                
            </tr>
        @endforeach
    </tbody>
  </table>
 

  <div class="wrap-pagination mt-5 d-flex justify-content-center">
      {{ $posts->links() }}
  </div>
</div>
@endsection

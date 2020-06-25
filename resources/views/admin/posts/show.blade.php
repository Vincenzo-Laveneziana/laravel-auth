@extends('layouts.admin')

@section('content')
<div class="container">
  <h1 class="mb-4">{{ $post->title }}</h1>

  <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created</th>
            <th>Updated</th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span>{{ $post->id }}</span></td>
            <td><p>{{ $post->title }}</p></td>
            <td><p>{{ $post->body }}</p></td>
            <td><p>{{ $post->created_at->format('d/m/y')}}</p></td>
            <td><p>{{ $post->updated_at->diffForHumans()}}</p></td>
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
    </tbody>
  </table>
</div>
@endsection

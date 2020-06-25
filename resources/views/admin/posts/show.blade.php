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
            <td><p>{{ $post->created_at}}</p></td>
            <td><p>{{ $post->updated_at}}</p></td>
            <td>
                <a class="btn btn-sm btn-success "href="">Show</a>
            </td>
            <td>
                <a class="btn btn-sm btn-primary"href="">Edit</a>
            </td>
            <td>
                <a class="btn btn-sm btn-danger"href="">Delete</a>
            </td>
        </tr>
    </tbody>
  </table>
</div>
@endsection

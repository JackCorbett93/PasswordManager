@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2> Viewing Passwords </h2>
        <button type="button" class="btn btn-warning btn-s"><a href="/posts/create">Create Post</a></button>
        <div class="table-responsive">
            <table class="table">
                <tr class="info">
                    <th>Website</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Options</th>
                </tr>
               @foreach ($posts as $post)
                <tr>
                <td>{{ $post -> website}}</td>
                <td>{{ $post -> email }}</td>
                <td>{{ $post -> password}}</td>
                <td><button type="button" class="btn btn-success btn-s"><a href="/posts/{{$post->id}}/edit">Update</a></button>
                   {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
                   {{Form::hidden('_method', 'DELETE')}}
                   {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                   {!!Form::close()!!}
                </tr>
                </tr>   
                @endforeach
            </div>

           
        </table>
    </div>
</div>
<div class="row">
@endsection
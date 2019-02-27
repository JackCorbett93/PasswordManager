@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2> Viewing Passwords </h2>
        <button type="button" class="btn btn-success btn-s"><a href="/save">save table</a></button>
        <button type="button" class="btn btn-warning btn-s"><a href="/posts/create">Create Post</a></button>
        <div class="container">
            <form action="/search" method="get" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="search" class="form-control" name="search"
                        placeholder="Search logins"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                        </button>
                    </span>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr class="info">
                    <th>Website</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Options</th>
                </tr>
                <?php 
                
               
                function my_decrypt($data, $key) {
                //$key = $passes;
                // Remove the base64 encoding from our key
                $encryption_key = base64_decode($key);
                // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
                list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
                return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
            } 
        
                ?>
                @foreach ($posts as $post)
               
              <?php
              //echo cookie::get('curtpass');
               $de = $post -> password;  
               $key = $passes;
               $depass = my_decrypt($de, $key);
            ?>
                <tr>
                <td><a href="{{ $post -> website}}">{{$post -> website}}</a></td>
                <td>{{ $post -> email }}</td>
                <td>{{ $depass }} {{-- {{$post -> password}} --}}</td>
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
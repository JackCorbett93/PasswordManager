@extends('layouts.app')

@section('content')
<?php 
                $key = $passes;
                function my_decrypt($data, $key) {
                //$key = $passes;
                // Remove the base64 encoding from our key
                $encryption_key = base64_decode($key);
                // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
                list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
                return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
            } 
            $de = $post -> password;
            $depass = my_decrypt($de, $key);
                ?>
<h1> Edit Login</h1>
{!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST']) !!}
<div class="form-group">
            {{Form::label('website', 'Website')}}
            {{Form::text('website', $post->website, ['class' => 'form-control', 'placeholder' => 'http://'])}}
    </div>
    <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::text('email', $post->email, ['class' => 'form-control', 'placeholder' => ''])}}
    </div>
    <div class="form-group">
            {{Form::label('password', 'Password')}}
            {{Form::text('password', $depass, ['class' => 'form-control', 'placeholder' => ''])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@endsection
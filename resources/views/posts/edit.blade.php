@extends('layouts.app')

@section('content')
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
            {{Form::text('password', $post->password, ['class' => 'form-control', 'placeholder' => ''])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@endsection
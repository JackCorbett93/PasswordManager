@extends('layouts.app')

@section('content')
<h1> Create New Login</h1>
{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}
<div class="form-group">
            {{Form::label('website', 'Website')}}
            {{Form::text('website', '', ['class' => 'form-control', 'placeholder' => 'http://'])}}
    </div>
    <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => ''])}}
    </div>
    <div class="form-group">
            {{Form::label('password', 'Password')}}
            {{Form::text('password', '', ['class' => 'form-control', 'placeholder' => ''])}}
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@endsection
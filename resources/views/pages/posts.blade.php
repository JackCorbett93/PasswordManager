@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2> Viewing Passwords </h2>
        <div class="table-responsive">
            <table class="table">
                <tr class="info">
                    <th>Website</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Options</th>
                </tr>
               {{--  @foreach ($posts as $post)
                <tr>
                <td>{{ $post -> website}}</td>
                <td>{{ $post -> email }}</td>
                <td>{{ $post -> password}}</td>
                <td>EDIT | DELETE</td>
                </tr>   
                @endforeach --}}
            </div>
            @php
                echo $id;
            @endphp
        

           
        </table>
    </div>
</div>
<div class="row">
@endsection
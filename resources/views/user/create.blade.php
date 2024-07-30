<!-- resources/views/users/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Add User</h1>
    
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <button type="submit">Submit</button>
    </form>
@endsection
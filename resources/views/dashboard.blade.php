@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User Dashboard</h2>
    <p>Welcome, {{ auth()->user()->name }}!</p>

    <a href="{{ route('user.edit') }}" class="btn btn-primary">Edit Your Details</a>
</div>
@endsection

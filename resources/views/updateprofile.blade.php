@extends('layouts.navbar')

@section('content') 

    <div class="container w-50 m-auto">
        <h1>Update Profile</h1>
    <form action="{{url('updateprofile')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="name" class="mt-2">Name:</label>
    <input type="text" id="name" class="mt-1" value="{{$user->name}}" name="name">
    <br>
    <label for="email" class="mt-2">Eamil:</label>
    <input type="text" id="email" class="mt-1" value="{{$user->email}}" name="email">
    <br>
    <label for="city" class="mt-2">City:</label>
    <input type="text" id="city" class="mt-1" value="{{$user->city}}" name="city">
    <br>
    <label for="profilepic" class="mt-2">Profile pic:</label>
    <img src="{{$user->profilepic}}" alt="profile pic" width="50%" class="mt-1">
    <br>
    <input type="file" name="file" id="profilepic" class="mt-2">
    <br>
    <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
    </div>
    @endsection 

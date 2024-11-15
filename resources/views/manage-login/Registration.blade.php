@extends('Layout')
@section('title', 'Registration')
@section('content')
    <div class="container">
        <div class="mt-5">
            @if($errors->any())
                <div id="flash-message" class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
            @endif

            @if(session()->has('error'))
            <div id="flash-message" class="alert alert-danger">{{ session('error') }}</div> 
            @endif

            @if(session()->has('success'))
            <div id="flash-message" class="alert alert-success">{{ session('success') }}</div> 
            @endif
        </div>

        <form class="ms-auto me-auto mt-5" style="width: 500px" action="{{ route('manage-login.PostRegistration') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="name" placeholder="Enter your username">
            </div>
            <div class="mb-3">

            <div class="mb-3">
                <label class="form-label">Email</label>
                 <input type="email" class="form-control" name="email" placeholder="Enter your email">
            </div>

            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
@endsection
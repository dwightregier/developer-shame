@extends('layouts.master')

@section('title', 'Home')

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>Welcome</h1>
        </div>

        @include('shared.errors')

        <div class="row">
            <div class="col-md-8">
                <p>You are on the home page.</p>
            </div>
        </div>
    </div>

@endsection
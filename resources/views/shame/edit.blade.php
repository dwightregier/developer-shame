@extends('layouts.master')

@section('title', 'Edit a Shame')

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>Edit <small>a Shame</small></h1>
        </div>

        @include('shared.errors')

        <div class="row">
            <div class="col-md-8">

                {!! Form::model($shame, ['route' => ['shames.update', $shame->id] , 'method' => 'put']) !!}

                @include('shame.partials.form', ['submit_button_text' => 'Update Shame', 'shame' => $shame])

                {!! Form::close() !!}

            </div>

            <div class="col-md-4 form-group">
                @include('shared.profilenav')
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    @include('shame.partials.formscripts')

@endsection
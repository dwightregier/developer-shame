@extends('layouts.master')

@section('title', 'Edit a comment')

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>Edit <small>a Comment</small></h1>
        </div>

        @include('shared.errors')

        <div class="row">
            <div class="col-md-8">

                {!! Form::model($comment, ['route' => ['comments.update', $comment->id] , 'method' => 'put']) !!}

                {!! Form::label('text', 'Comment') !!}
                {!! Form::textarea('text', $comment->text, ['class' => 'form-control']) !!}
                <br>
                {!! Form::submit('Update Comment', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

            </div>
            <div class="col-md-4 form-group">
                @include('shared.profilenav')
            </div>
        </div>
    </div>

@endsection

@section('scripts')
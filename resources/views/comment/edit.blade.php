@extends('layouts.master')

@section('content')
    <h1>Edit Shame</h1>

    @include('shared.errors')

    {!! Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) !!}
    {!! Form::label('text', 'Comment') !!}
    {!! Form::textarea('text', $comment->text, ['class' => 'form-control']) !!}

    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
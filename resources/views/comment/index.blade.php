@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1> Posted Comments</h1>
                @if ($comments->count() > 0)
                    @foreach($comments as $comment)
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4><b></b></h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-1">
                                        {!! Form::open(['route' => 'comments.upvote']) !!}
                                        {!! Form::hidden('comment_id',$comment->id) !!}
                                        <i class="fa fa-arrow-up"></i>
                                        {!! Form::submit($comment->upvotes->count(), ['class' => 'btn btn-default']) !!}
                                        {!! Form::close() !!}
                                        {!! Form::model($comment, ['route' => ['comments.edit', $comment->id], 'method' => 'GET']) !!}
                                        {!! Form::submit('Edit', ['class' => 'btn btn-default']) !!}
                                        {!! Form::close() !!}
                                        {!! Form::model($comment, ['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-default']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-xs-10 col-sm-9">
                                        {!! $comment->text !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
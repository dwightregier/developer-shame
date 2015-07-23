@extends('layouts.master')

@section('content')


    <div class="container">
        <div class="page-header">
            <h1>{{ $shame->title }} </h1>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                {!! $shame->markdown !!}
            </div>
        </div>

        <div class="col-md-8">
            {!! Form::open(['route' => 'comments.store']) !!}
            <div class="form-group">
                {!! Form::label('text', 'Comment') !!}
                {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
                {!! Form::hidden('shame_id',$shame->id)!!}
                <br>
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
            <br>
        </div>
        <div class="row">
            <div class="col-md-8">
                @if ($comments->count() > 0)
                    @foreach($comments as $comment)
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4><b>{!!$comment->user->display_name !!}</b></h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-1">
                                        {!! Form::open(['route' => 'comments.upvote']) !!}
                                        {!! Form::hidden('comment_id',$comment->id) !!}
                                        <i class="fa fa-arrow-up">
                                            {!! Form::submit($comment->upvotes->count(), ['class' => 'btn btn-default']) !!}
                                        </i>
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
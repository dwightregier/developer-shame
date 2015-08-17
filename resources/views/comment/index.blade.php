@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>Posted Comments</h1>
        </div>

        <div class="row">
            <div class="col-md-8">
                @if ($comments->count())
                    @foreach($comments as $comment)
                        <div class="panel panel-default">
                            <div class="panel-heading"  style ="overflow: auto">
                                <b>
                                    Shame: {{$comment->shame->title}}
                                    <br/>
                                    Created At: {{$comment->created_at}}
                                </b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-8"  style ="overflow: auto">
                                        <p>
                                            {{$comment->text}}
                                        </p>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        {!! Form::open(['route' => ['comments.destroy', $comment->id] , 'method' => 'DELETE']) !!}
                                        {!! link_to_route('comments.edit', 'Edit', ['id' => $comment->id], ['class' => 'btn btn-primary']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-md-4">
                @include('shared.profilenav')
            </div>
        </div>
    </div>

@endsection
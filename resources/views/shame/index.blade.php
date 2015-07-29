@extends('layouts.master')

@section('title', $title)

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>{{$title}}</h1>
        </div>

        <div class="row">
            <div class="col-md-8">
                @if ($shames->count())
                    @foreach($shames as $shame)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>{!! link_to_route('shames.show', $shame->title, ['id' => $shame->id]) !!}</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <p>
                                            Created At: {{$shame->created_at}}

                                            @if ($shame->is_anonymous)
                                                Anonymous
                                            @else
                                                - By: {{$shame->user->display_name}}
                                            @endif
                                        </p>

                                        @if($shame->tags->count())
                                            <div class="well well-sm">Tags:
                                                @foreach($shame->tags as $tag)
                                                    <b>{{$tag->title}}</b>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        {!! Form::open(['route' => ['shames.destroy', $shame->id] , 'method' => 'DELETE']) !!}
                                            {!! link_to_route('shames.edit', 'Edit', ['id' => $shame->id], ['class' => 'btn btn-primary']) !!}
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
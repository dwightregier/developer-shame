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
                                    <div class="col-xs-4 col-sm-1">
                                        {!! Form::open(['route' => 'shames.upvote']) !!}
                                        {!! Form::hidden('shame_id',$shame->id) !!}
                                        @if($shame->upvotes()->where('user_id', Auth::user()->id)->count() > 0)
                                            <i class="fa fa-arrow-down">
                                                {!! Form::submit($shame->upvotes->count(), ['class' => 'btn btn-default']) !!}
                                            </i>
                                        @else
                                            <i class="fa fa-arrow-up">
                                                {!! Form::submit($shame->upvotes->count(), ['class' => 'btn btn-default']) !!}
                                            </i>
                                        @endif
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-xs-8 col-sm-9">
                                        Created At: {{$shame->created_at}} - By:

                                        @if ($shame->is_anonymous)
                                            Anonymous
                                        @else
                                            {{$shame->user->display_name}}
                                        @endif

                                        @if($shame->tags->count())
                                            <div class="well well-sm">Tags:
                                                @foreach($shame->tags as $tag)
                                                    <b>{{$tag->title}}</b>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-xs-8 col-sm-2">
                                        {!! link_to_route('shames.show', "Read More", ['id' => $shame->id], ['class' => 'btn btn-primary']) !!}

                                        {!! Form::open(['route' => 'shames.follow']) !!}
                                        {!! Form::hidden('shame_id',$shame->id) !!}
                                        @if($shame->follows()->where('user_id', Auth::user()->id)->count() > 0)
                                            {!! Form::submit('Unfollow', ['class' => 'btn btn-default']) !!}
                                        @else
                                            {!! Form::submit('Follow', ['class' => 'btn btn-default']) !!}
                                        @endif
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
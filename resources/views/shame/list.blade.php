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
                                    <div class="col-xs-2 text-center">
                                        {!! Form::open(['route' => 'shames.upvote']) !!}
                                        {!! Form::hidden('shame_id',$shame->id) !!}
                                        @if (Auth::check() && $shame->upvotes()->where('user_id', Auth::user()->id)->count() > 0)
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-arrow-down"></i>
                                                <br>
                                                {{ $shame->upvotes->count() }}
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-default">
                                                <i class="fa fa-arrow-up"></i>
                                                <br>
                                                {{ $shame->upvotes->count() }}
                                            </button>
                                        @endif
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-xs-7">
                                        <p>
                                            Created At: {{$shame->created_at}}

                                            @if (!$shame->is_anonymous)
                                                &mdash; By: <strong>{{$shame->user->display_name}}</strong>
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
                                    <div class="col-xs-3 text-center">
                                        {!! Form::open(['route' => 'shames.follow']) !!}
                                        {!! Form::hidden('shame_id',$shame->id) !!}
                                        @if (Auth::check() && $shame->follows()->where('user_id', Auth::user()->id)->count() > 0)
                                            {!! Form::submit('Unfollow', ['class' => 'btn btn-success']) !!}
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
                @include('shared.shamenav')
            </div>
        </div>
    </div>

@endsection
@extends('layouts.master')

@section('title', 'Badges Page')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{Auth::user()->display_name}}'s Badges</h1>
        </div>

        <div class="row">
            <div class="col-md-8">
                @if($badges->count() == 0)
                    <p>You have no badges loser.</p>
                @endif
                <?php $i = 0 ?>
                @foreach($badges as $badge)
                    @if($i%3 == 0)
                        <div class="row" style="margin: 50px auto">
                            @endif
                            <div class="col-md-4">
                                <span class="hide-sm">
                                    {!! $badge->icon !!}
                                </span>
                                <h4>{{$badge->title}}</h4>
                                {{$badge->description}}
                            </div>

                            <?php $i++; ?>
                            @if($i%3 == 0)
                        </div>
                    @endif
                @endforeach

                @if($i % 3 !== 0)
            </div>
            @endif
        </div>
        <div class="col-md-4">
            @include('shared.profilenav')
        </div>
    </div>
    </div>
@endsection
@extends('layouts.master')

@section('title', 'Post a Shame')

@section('content')

	<div class="container">
		<div class="page-header">
			<h1>Post <small>a Shame</small></h1>
		</div>

		@include('shared.errors')

        <div class="row">
            <div class="col-md-8">

                {!! Form::open(['route' => 'shame.store']) !!}

                    @include('shame.partials.form', ['submit_button_text' => 'Post Shame'])

                {!! Form::close() !!}

            </div>

            <div class="col-md-4 form-group">
                @include('shared.shamenav')
            </div>
        </div>
	</div>

@endsection

@section('scripts')

    @include('shame.partials.formscripts')

@endsection
@extends('layouts.master')

@section('title', 'Register')

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>Register <small>for an Account</small></h1>
        </div>

        @include('shared.errors')

        <div class="row">
            <div class="col-md-8">
                {!! Form::open(['route' => 'auth.postRegister']) !!}

                    <div class="form-group">
                        {!! Form::label('display_name') !!}
                        {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password_confirmation') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('Register', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>

            <div class="col-md-4 form-group">
                <div class="panel panel-default">
                    <div class="panel-heading">Already Have an Account?</div>
                    <div class="panel-body">

                        {!! Form::open(['route' => 'auth.postLogin']) !!}

                            <div class="form-group">
                                {!! Form::label('email') !!}
                                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password') !!}
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>

                            {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
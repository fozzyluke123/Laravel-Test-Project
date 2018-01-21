@extends('layouts.app')

@section('title', 'Table Display')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            {{ $message }}
            {{ Form::open() }}
                <div class="form-group">
                    {{ Form::label('username', 'Username') }}
                    {{ Form::text('username', "", array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', "", array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('dob', 'Date of Birth') }}
                    {{ Form::text('dob', "", array('class' => 'form-control')) }}
                </div>
                {{ Form::submit('Add User', array('class' => 'btn btn-primary')) }}
                {{ Form::hidden('id', "", array('class' => 'form-control')) }}
            {{ Form::close() }}
        </div>
        <div class="col-xs-12">
            <a href="/users">
                Back to all users
            </a>
        </div>
    </div>
@endsection
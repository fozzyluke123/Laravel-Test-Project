@extends('layouts.app')

@section('title', 'Table Display')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            {{ $message }}
            {{ Form::open() }}
                <div class="form-group">
                    {{ Form::label('username', 'Username') }}
                    {{ Form::text('username', $user->username, array('class' => 'form-control', 'required')) }}
                </div>
                @foreach ($errors->get('username') as $error)
                    <div class="formError">
                        {{ $error }}
                    </div>
                @endforeach
                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::email('email', $user->email, array('class' => 'form-control', 'required')) }}
                </div>
                @foreach ($errors->get('email') as $error)
                    <div class="formError">
                        {{ $error }}
                    </div>
                @endforeach
                <div class="form-group">
                    {{ Form::label('dob', 'Date of Birth') }}
                    {{ Form::date('dob', $user->dob, array('class' => 'form-control', 'required')) }}
                </div>
                @foreach ($errors->get('dob') as $error)
                    <div class="formError">
                        {{ $error }}
                    </div>
                @endforeach
                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                {{ Form::hidden('id', $user->id) }}
            {{ Form::close() }}
        </div>
        <div class="col-xs-12">
            <a href="/users">
                Back to all users
            </a>
        </div>
    </div>
@endsection
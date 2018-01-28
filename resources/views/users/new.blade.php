@extends('layouts.app')

@section('title', 'Table Display')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @if ($errors->any())
                <h4 class="formError">
                    There were some errors in the form, please check the messages below.
                </h4>
            @endif
            {{ $message }}
            {{ Form::open() }}
                <div class="form-group">
                    {{ Form::label('username', 'Username') }}
                    {{ Form::text('username', "", array('class' => 'form-control', "required")) }}
                    @foreach ($errors->get('username') as $error)
                        <div class="formError">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::email('email', "", array('class' => 'form-control', "required")) }}
                </div>
                @foreach ($errors->get('email') as $error)
                    <div class="formError">
                        {{ $error }}
                    </div>
                @endforeach
                <div class="form-group">
                    {{ Form::label('dob', 'Date of Birth') }}
                    {{ Form::date('dob', "", array('class' => 'form-control', "required")) }}
                </div>
                @foreach ($errors->get('dob') as $error)
                    <div class="formError">
                        {{ $error }}
                    </div>
                @endforeach
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
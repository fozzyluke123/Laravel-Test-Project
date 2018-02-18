@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @if ($errors->any())
                <h4 class="formError">
                    There were some errors in the form, please check the messages below.
                </h4>
            @endif
            {{ Form::open() }}
                <div class="form-group">
                    {{ Form::label('username', 'Username') }}
                    {{ Form::text('username', "", array('class' => 'form-control', "required", "maxlength" =>"50")) }}
                    @foreach ($errors->get('username') as $error)
                        <div class="formError">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password', array('class' => 'form-control', "required", "maxlength" =>"50")) }}
                </div>
                @foreach ($errors->get('password') as $error)
                    <div class="formError">
                        {{ $error }}
                    </div>
                @endforeach
                {{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
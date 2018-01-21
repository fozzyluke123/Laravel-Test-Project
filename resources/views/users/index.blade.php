@extends('layouts.app')

@section('title', 'Table Display')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>E-Mail</th>
                </tr>
                @foreach ($data as $item)
                    <tr>
                        <td>
                            <a href="/users/{{ $item['id'] }}">{{ $item["id"] }}</a>
                        </td>
                        <td>{{ $item["username"] }}</td>
                        <td>{{ $item["dob"] }}</td>
                        <td>{{ $item["email"] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-xs-12">
            <a href="/users/new" class="btn btn-primary">
                Add new user
            </a>
        </div>
    </div>
@endsection
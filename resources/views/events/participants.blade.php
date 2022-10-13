@extends('layouts.main')

@section('title', $event->title)

@section('content')

    <div class="col-md-10 offset-1">
        <h1>Participantes do evento</h1>
        <h4>{{ $event->title }}</h4>
    </div>
    <div class="col-md-10 offset-1">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event->users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
                <tr></tr>
            </tbody>
        </table>
    </div>


@endsection

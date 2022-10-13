@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="col-md-10 offset-md-1" id="dashboard-container">
        <h1>Meus eventos</h1>
    </div>

    <div id="dashboard-events-container" class="col-md-10 offset-md-1">
        @if (count($events) > 0)

            <table id="dashboard-events-table" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Participantes</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td class="text-center">{{ $loop->index + 1 }}</td>
                            <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                            <td class="text-center">{{ count($event->users) }}</td>
                            <td class="action-cell">
                                <a href="/events/edit/{{ $event->id }}" class="btn btn-info btn-edit">
                                    <ion-icon name="create-outline"></ion-icon>Editar
                                </a>

                                <form action="/events/{{ $event->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-delete">
                                        <ion-icon name="trash-outline"></ion-icon>Deletar

                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você não tem eventos, <a href="/events/create">Criar Evento</a></p>
        @endif
    </div>

    <div class="col-md-10 offset-md-1" id="dashboard-container">
        <h1>Eventos como participante</h1>
    </div>

    <div id="dashboard-events-container" class="col-md-10 offset-md-1">

        @if(count($eventsAsParticipant) > 0)

        <table id="dashboard-events-table" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Participantes</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventsAsParticipant as $event)
                    <tr>
                        <td class="text-center">{{ $loop->index + 1 }}</td>
                        <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                        <td class="text-center">{{ count($event->users) }}</td>
                        <td class="action-cell">
                            <form action="/events/leave/{{ $event->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="#" class="btn btn-danger" id="event-submit"
                                    onclick="console.log(event);
                                event.preventDefault();
                                this.closest('form').submit();
                        ">
                                    Cancelar participação
                                </a>
                            </form>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>Você não tem presença confirmada em eventos. <a href="/">Procurar eventos</a></p>
        @endif
    </div>


@endsection

@extends('layouts.main')

@section('title', 'RW Eventos')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um Evento</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>

<div id="events-container" class="col-md-12">

    @if($search)
    <h2>Buscando eventos: {{ $search }}</h2>

    @else
    <h2>Próximos Eventos</h2>

    <p class="subtitle">Veja os eventos dos próximos dias</p>
    @endif


    @if(count($events) == 0 && $search)
    <p class="subtitle">Não foi possivel encontrar eventos com o termo {{ $search }}.
        <a href="/">Ver todos</a>
    </p>

    @elseif(count($events) == 0)
    <p class="subtitle">Nenhum evento disponível.
        <a href="/events/create">Criar evento</a>
    </p>

    @endif


    <div id="card-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{ $event->image }}" alt="{{$event->title}}">
            <div class="card-body">
                <div class="card-date">{{date('d/m/Y', strtotime($event->date))}}</div>
                <h5 class="card-title">{{$event->title}}</h5>
                <div class="card-participants">{{ count($event->users)}} Participantes</div>
                <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- <img src="/img/banner.webp" alt="Banner"> -->



@endsection

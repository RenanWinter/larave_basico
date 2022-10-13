@extends('layouts.main')

@section('title', $event->title)

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{ $event->title }}</h1>
                <p class="event-date">
                    <ion-icon name="calendar-outline"></ion-icon> {{ date('d/m/Y', strtotime($event->date)) }}
                </p>
                <p class="event-city">
                    <ion-icon name="location-outline"></ion-icon> {{ $event->city }}
                </p>
                <p class="event-participants">
                    <ion-icon name="people-outline"></ion-icon>
                    <a href="/events/{{ $event->id }}/participants">
                        {{ count($event->users) }} participantes
                    </a>

                </p>

                <p class="envent-owner">
                    <ion-icon name="star-outline"></ion-icon> {{ $owner->name }}
                </p>

                @if ($isParticipant == true)
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
                @else
                    <form action="/events/join/{{ $event->id }}" method="POST">
                        @csrf

                        <a href="#" class="btn btn-primary" id="event-submit"
                            onclick="console.log(event);
                        event.preventDefault();
                        this.closest('form').submit();
                ">
                            Confirmar Presença
                        </a>
                    </form>
                @endif


                @if (count($event->items) == 0)
                    <p>Evento sem facilidades</p>
                @else
                    <h3> O evento conta com:</h3>
                    <div id="items-container" class="d-flex flex-row align-items-center ">
                        @foreach ($event->items as $item)
                            <div class="d-flex align-items-center">
                                <ion-icon name="checkmark-outline"></ion-icon>
                                <span>{{ $item }}</span>
                            </div>
                        @endforeach

                    </div>
                @endif

            </div>
        </div>
        <div id="description-container" class="col-md-12">
            <h3>Sobre o evento</h3>
            <p class="event-description">{{ $event->description }} </p>
        </div>

    </div>

@endsection

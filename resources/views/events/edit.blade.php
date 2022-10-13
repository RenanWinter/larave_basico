@extends('layouts.main')

@section('title', $event->title)

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Alterando evento</h1>
    <form action="/events/{{$event->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Imagem</label>
            <input type="file" name="image" id="image" class="form-control-file" accept="iamge/*">
            @if($event->image)
            <img id="current-image-preview" src="/img/events/{{ $event->image}}" alt="{{$event->title}}">
            @endif

        </div>

        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{$event->title}}">
        </div>

        <div class="form-group">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" id="date" name="date"  value="{{ $event->date->format('Y-m-d') }}">
        </div>

        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Cidade do evento"  value="{{$event->city}}">
        </div>
        <div class="form-group">
            <label for="private">O Evento é privado?</label>
            <select name="private" id="private" class="form-control"  value="{{$event->private}}">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento">{{$event->description}}
            </textarea>
        </div>

        <label for="items">Facilidades:</label>
        <div id="facilities" class="form-group">
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras" id="cadeiras" {{ in_array("Cadeiras", $event->items) ? 'checked="checked"' : '' }}>
                <label for="cadeiras">Cadeiras</label>
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco" id="palco" {{ in_array("Palco", $event->items) ? 'checked="checked"' : '' }}>
                <label for="palco">Palco</label>
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Mesas" id="mesas" {{ in_array("Mesas", $event->items) ? 'checked="checked"' : '' }}>
                <label for="mesas">Mesas</label>
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cerveja Gratis" id="cerveja" {{ in_array("Cerveja Gratis", $event->items) ? 'checked="checked"' : '' }}>
                <label for="cerveja">Cerveja Gratis</label>
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open Food" id="food"  {{ in_array("Open Food", $event->items) ? 'checked="checked"' : '' }}>
                <label for="food">Comida Liberada</label>
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes" id="brindes"  {{ in_array("Brindes", $event->items) ? 'checked="checked"' : '' }}>
                <label for="brindes">Brindes</label>
            </div>

        </div>

        <input type="submit" class="btn btn-primary" value="Salvar alterações">

    </form>
</div>


@endsection

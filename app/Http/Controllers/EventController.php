<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index()
    {
        $search = request('search');
        if ($search) {
            $events = Event::where([
                ['title', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $events = Event::all();
        }


        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {

        $user = auth()->user();

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->items = $request->items;
        $event->date = $request->date;
        $event->user_id = $user->id;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->image;
            $extension = $image->extension();
            $imageName = md5($image->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $image->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }

        $event->save();
        return redirect('/')->with('msg', "Evento " . $event->name . " criado com sucesso");
    }

    public function update(Request $request)
    {

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->image;
            $extension = $image->extension();
            $imageName = md5($image->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $image->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        }

        if (!key_exists('items', $data)) {
            $data['items'] = [];
        }

        $event = Event::findorfail($request->id)->update($data);
        return redirect('/dashboard')->with('msg', 'Evento alterado com sucesso');
    }

    public function show($id)
    {

        $user = auth()->user();
        $event = Event::findOrFail($id);
        $eventOwner = User::where('id', $event->user_id)->first();

        $participant = false;
        if ($user) {
            foreach ($user->eventsAsParticipant as $userEvent) {
                if ($userEvent->id == $event->id) {
                    $participant = true;
                    break;
                }
            }
        }


        return view('events.show', ['event' => $event, 'owner' => $eventOwner, 'isParticipant' => $participant]);
    }

    public function edit($id)
    {

        $event = Event::findOrFail($id);
        $user = auth()->user();

        if ($event->user_id != $user->id) {
            return redirect('/dashboard')->with('msg-error', 'Você não pode editar este evento.');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function dashboard()
    {
        $user = auth()->user();
        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;


        return view('events.dashboard', ['events' => $events, 'eventsAsParticipant' => $eventsAsParticipant]);
    }

    public function joinEvent($id)
    {

        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);


        $event = Event::findorfail($id);
        return redirect('/dashboard')->with('msg', 'Sua participação está confirmada no evento: ' . $event->title);
    }

    public function leaveEvent($id)
    {
        $user = auth()->user();
        $event = Event::findorfail($id);
        $user->eventsAsParticipant()->detach($id);
        return redirect('/dashboard')->with('msg', 'Você cancelou sua participação no evento: ' . $event->title);
    }

    public function destroy($id)
    {

        Event::findorfail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluido com sucesso');
    }

    public function participants($id)
    {
        $event = Event::findorfail($id);
        return view('events.participants', ['event' => $event]);
    }
}

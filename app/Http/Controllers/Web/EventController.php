<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Webuser;
use Storage;

class EventController extends Controller
{
    public function index(){
        $event = Event::all();
        return view('backend.events.index', compact('event'));
    }

    public function create(){
        return view('backend.events.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1500',
            'participants' => 'nullable',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:5200'
        ]);
        $event = new Event;
        $event->name = $request['name'];
        $event->description = $request['description'];
        if($request->hasFile('image')){
            $path = $request->file('image');
            $storedpath = $path->store('events', 'public');
            $event->image = basename($storedpath);
        }
        $event->save();
        return redirect()->route('events.index');
    }

    public function edit($id){
        $event = Event::find($id);
        return view('backend.events.edit', compact('event'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1500',
            'participants' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:5200'
        ]);
        $event = Event::find($id);
        if($request->hasFile('image')){
            if ($event->image) {
                Storage::disk('public')->delete('events/' . $event->image);
            }
            $path = $request->file('image');
            $storedpath = $path->store('events', 'public');
            $event->image = basename($storedpath);
        }
        $event->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'participants' => $request['participants'],
        ]);
        return redirect()->route('events.index');
    }

    public function delete($id){
        $event = Event::find($id);
        if ($event->image) {
            Storage::disk('public')->delete('events/' . $event->image);
        }
        $event->delete();
        return redirect()->route('events.index');
    }

    public function allparticipants($id){
        $event = Event::find($id);
        $allparticipants = $event->participants;
        $webuserIds = Webuser::pluck('id')->toArray();
        $sortedparticipants = array_intersect($webuserIds, $allparticipants);
        $participants = Webuser::whereIn('id', $sortedparticipants)->get();
        return view('backend.events.manageparticipants', compact('participants','event'));
    }

    public function removeparticipant($eventid, $id){
        $event = Event::where('id', $eventid)->first();
        $participants = $event->participants;
        $participants = array_diff($participants, [$id]);
        $event->participants = $participants;
        $event->save();
        return redirect()->back();
    }
    
}

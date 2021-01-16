<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function home(){
        $events = auth()->user()->events()->get();
        return view('dashboard')->with('events' , $events);
    }

    public function welcome(){
        $events = Event::all();
        return view('welcome')->with('events', $events);
    }



    public function addEvent(){
        return view('add_event'); 
    }

    public function createEvent(Request $request){
        $request->validate([
            "name" => "required",
            "type" => "required", 
            "description" => "required",
            "start_date" => "required|before:end_date",
            "end_date" =>"required",
            "time" => "required", 
            "venue" => "required",
            "city" => "required",
            "website" => "url",
            "twitter" => "url", 
            "facebook" => "url",
            "linkedin" => "url",
            "instagram" => "url",
            "event_logo" => "image|nullable",
            "event_sponsors" => "image|nullable",
            "event_speakers" => "image|nullable",
            "state" => "required",
            "firstname" => "required",
            "lastname" => "required",
            "company_name" => "required",
            "email" => "required|email|unique:users",
            "phone" => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10",
      
        ]);
        auth()->user()->events()->create($request->all());

        return redirect()->route('dashboard')->with('message', 'Event successfully created');
    

    }
    public function eventDetail($id){
        $event = Event::findOrFail($id);

        return view('event_detail')->with('event', $event);
    }



    public function search(Request $request){
        $search = $request->input('search');
        $events = Event::query()
        ->where('name', 'LIKE', "%{$search}%")
        ->orWhere('type', 'LIKE', "%{$search}%")
        ->orWhere('state', 'LIKE', "%{$search}%")
        ->get();
        return view('welcome', compact('events'));
    }


}
















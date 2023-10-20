<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        // dd(Event::latest()->get()->count());
        return view('eventlist', [
            'events' => Event::latest()->get(),
        ]);
    }

    public function adminindex()
    {
        return view('admin.event.eventlist', [
            'events' => Event::latest()->get(),
            'event' => new Event()
        ]);
    }

    public function store(Request $request)
    {

         if($request->id) {
            $data = $request->validate([
                'user_id' => ['required', 'integer'],
                'title' => ['required'],
                'event_date' => ['required', 'date'],
                'banner_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
                'body' => ['required']
            ]);

            if($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filename = uniqid() . now()->timestamp . '.' .$extension;
                $file->storeAs('public/event-banners', $filename, 'local');

                // Update banner_image filename
                $data['banner_image'] = $filename;
            }

            

            $event = Event::findOrFail($request->id);
            $event->fill($data);
            $event->save();

            session()->flash('success', 'Event post updated successfully.');
            return redirect()->back();
        } else {
            $data = $request->validate([
                'user_id' => ['required', 'integer'],
                'title' => ['required'],
                'event_date' => ['required', 'date'],
                'banner_image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
                'body' => ['required']
            ]);

            if($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filename = uniqid() . now()->timestamp . '.' .$extension;
                $file->storeAs('public/event-banners', $filename, 'local');

                // Update banner_image filename
                $data['banner_image'] = $filename;
            }

            $event = Event::create($data);

            session()->flash('success', 'Event post created successfully.');
            return redirect()->back();
        }

        

        
    }

    public function adminshow(Request $request, Event $event)
    {
        return view('admin.event.eventshow', [
            'event' => $event
        ]);
    }

    public function show(Request $request, Event $event)
    {
        return view('eventshow', [
            'event' => $event
        ]);
    }

    public function destroy(Request $request, Event $event)
    {
        $event->delete();

        session()->flash('success', 'Event post deleted successfully.');
        return redirect()->back();

    }
}

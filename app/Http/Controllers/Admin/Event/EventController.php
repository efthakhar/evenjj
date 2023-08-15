<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    public function index(Request $request)
    {

        $this->authorize('view_event');

        $perpage = $request->query('perpage') ?? 10;
        $title = $request->query('title');
        $sortby = $request->query('sortby');
        $sorttype = $request->query('sorttype') ?? 'asc';

        $events = Event::where('created_by', auth()->user()->id);

        $events
            ->when($title, function ($query, $title) {
                $query->where('title', 'LIKE', '%'.$title.'%');
            })
            ->when($sortby, function ($query, $sortby) use ($sorttype) {
                $query->orderby($sortby, $sorttype);
            }, function ($query) use ($sorttype) {
                $query->orderBy('id', $sorttype);
            });

        return view('admin.event.index', [
            'events' => $events->paginate($perpage)->appends($request->query()),
        ]);
    }

    public function create()
    {
        $this->authorize('create_event');

        return view('admin.event.create', [
            'categories' => EventCategory::select('id', 'name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create_event');

        $validatedData = $request->validate([
            'title' => ['required', 'max:100'],
            'event_category_id' => ['required'],
            'date' => ['required'],
            'time' => ['required'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
        ], [
            'event_category_id.required' => 'plesase select a category',
        ]);

        $event = new Event();
        $event->title = $validatedData['title'];
        $event->event_category_id = $validatedData['event_category_id'];
        $event->date = $validatedData['date'];
        $event->time = $validatedData['time'];
        $event->location = $validatedData['location'];
        $event->description = $validatedData['description'];
        $event->created_by = auth()->user()->id;

        $event->save();

        return redirect()->route('admin.event.index');
    }

    public function show($id)
    {
        $this->authorize('view_event');

        return view('admin.event.single', [
            'event' => Event::where(['id' => $id,'created_by' => auth()->user()->id,])->first(),
            'categories' => EventCategory::select('id', 'name')->get()
        ]);
    }

    public function edit($id)
    {
        $this->authorize('edit_own_event');

        return view('admin.event.edit', [
            'event' => Event::where(['id' => $id,'created_by' => auth()->user()->id,])->first(),
            'categories' => EventCategory::select('id', 'name')->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit_own_event');

       
        $validatedData = $request->validate([
            'title' => ['required', 'max:100'],
            'event_category_id' => ['required'],
            'date' => ['required'],
            'time' => ['required'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
        ], [
            'event_category_id.required' => 'plesase select a category',
        ]);

        $event = Event::where(['id' => $id,'created_by' => auth()->user()->id,])->first();
        $event->title = $validatedData['title'];
        $event->event_category_id = $validatedData['event_category_id'];
        $event->date = $validatedData['date'];
        $event->time = $validatedData['time'];
        $event->location = $validatedData['location'];
        $event->description = $validatedData['description'];
        $event->created_by = auth()->user()->id;

        $event->save();

        return redirect()->route('admin.event.edit', $id)
            ->with('EventUpdateSuccess', 'Event Updated Successfully');
    }

    public function delete($id)
    {
        $id = explode(',', $id);
        $this->authorize('delete_own_event');

        foreach ($id as $i) {
            $event = Event::find($i);
            $event->delete();
        }

        return response()->json(['message' => 'event  deleted'], 201);
    }

    public function reserve($id)
    {
       DB::table('event_reservations')->insert([
        'event_id' => $id, 
        'user_id' => auth()->user()->id
       ]);
    }
}

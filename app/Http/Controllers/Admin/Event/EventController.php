<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {

        $this->authorize('view_event');

        $perpage = $request->query('perpage') ?? 10;
        $title = $request->query('title');
        $sortby = $request->query('sortby');
        $sorttype = $request->query('sorttype') ?? 'asc';

        $events = Event::where('created_by',auth()->user()->id);

        $events
            ->when($title, function ($query, $title) {
                $query->where('name', 'LIKE', '%'.$title.'%');
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
}

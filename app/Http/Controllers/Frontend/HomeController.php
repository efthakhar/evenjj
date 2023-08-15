<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function showHomePage(Request $request) 
    {       
       
        $title = $request->query('title');
        $event_category_id = $request->query('event_category_id');

        $events = Event::query();

        $events
            ->when($title, function ($query, $title) {
                $query->where('title', 'LIKE', '%'.$title.'%');
            })
            ->when($event_category_id, function ($query, $event_category_id) {
                $query->where('event_category_id', $event_category_id);
            });


        return view('frontend.home',[
            'events' => $events->paginate(10),
            'categories' => EventCategory::select('id', 'name')->get()
        ]);
    }
}

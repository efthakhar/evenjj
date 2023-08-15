<?php

namespace App\Http\Controllers\Admin\EventCategory;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventCategoryController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_event_category');

        $perpage = $request->query('perpage') ?? 10;
        $name = $request->query('name');
        $slug = $request->query('slug');
        $sortby = $request->query('sortby');
        $sorttype = $request->query('sorttype') ?? 'asc';

        $categories = EventCategory::query();

        $categories
            ->when($name, function ($query, $name) {
                $query->where('name', 'LIKE', '%'.$name.'%');
            })
            ->when($slug, function ($query, $slug) {
                $query->where('slug', 'LIKE', '%'.$slug.'%');
            })->when($sortby, function ($query, $sortby) use ($sorttype) {
                $query->orderby($sortby, $sorttype);
            }, function ($query) use ($sorttype) {
                $query->orderBy('id', $sorttype);
            });

        return view('admin.event-category.index', [
            'categories' => $categories->paginate($perpage)->appends($request->query()),
        ]);
    }

    public function list()
    {
        $this->authorize('view_event_category');
        $categories = EventCategory::select(['id', 'name'])->get();

        return response()->json($categories);
    }

    public function show($id)
    {
        $this->authorize('view_event_category');

        return view('admin.event-category.single', [
            'category' => EventCategory::find($id),
        ]);
    }

    public function create()
    {
        $this->authorize('create_event_category');

        return view('admin.event-category.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create_event_category');

        $slug = $request->slug ? strtolower(str_replace(' ', '-', $request->slug)) : strtolower(str_replace(' ', '-', $request->name));

        $request->merge(['slug' => $slug]);

        $validatedData = $request->validate([

            'name' => ['required', 'max:30', Rule::unique('event_categories')],
            'slug' => ['required', 'max:30', Rule::unique('event_categories')],
        ]);

        $category = new EventCategory();
        $category->name = $validatedData['name'];
        $category->slug = $validatedData['slug'];

        $category->save();

        return redirect()->route('admin.event_category.index');
    }

    public function edit($id)
    {
        $this->authorize('edit_event_category');

        return view('admin.event-category.edit', [
            'category' => EventCategory::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('edit_event_category');

        $slug = $request->slug ? strtolower(str_replace(' ', '-', $request->slug)) : strtolower(str_replace(' ', '-', $request->name));

        $request->merge(['slug' => $slug]);

        $validatedData = $request->validate([

            'name' => ['required', 'max:30', Rule::unique('event_categories')->ignore($id)],
            'slug' => ['required', 'max:30', Rule::unique('event_categories')->ignore($id)],
        ]);

        $category = EventCategory::find($id);
        $category->name = $validatedData['name'];
        $category->slug = $validatedData['slug'];

        $category->save();

        return redirect()->route('admin.event_category.edit', $id)
            ->with('EventCategoryUpdateSuccess', 'EventCategory Updated Successfully');
    }

    public function delete($id)
    {
        $id = explode(',', $id);
        $this->authorize('delete_event_category');

        foreach ($id as $i) {
            $category = EventCategory::find($i);
            $category->delete();
        }

        return response()->json(['message' => 'event category deleted'], 201);
    }
}

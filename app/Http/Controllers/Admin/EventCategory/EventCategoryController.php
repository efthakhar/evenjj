<?php

namespace App\Http\Controllers\Admin\EventCategory;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\Request;

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
            'categories' => $categories->paginate($perpage)->appends($request->query())
        ]);
    }

    // public function list(Request $request)
    // {
    //     $this->authorize('view-categories');

    //     $language = $request->query('language');
    //     $posttype = $request->query('posttype');

    //     // return [$language,$posttype];
    //     $categories = EventCategory::where('lang', '=', $language)->where('post_type', '=', $posttype)->select(['id', 'name', 'parent_category_id'])->get();

    //     return response()->json($categories);
    // }

    // public function show($id)
    // {
    //     $this->authorize('view-categories');

    //     return view('admin.category.single', [
    //         'category' => EventCategory::find($id),
    //     ]);
    // }

    // public function create()
    // {
    //     $this->authorize('create-categories');

    //     return view('admin.category.create');
    // }

    // public function store(Request $request)
    // {
    //     $this->authorize('create-categories');

    //     $slug = $request->slug ? strtolower(str_replace(' ', '-', $request->slug)) : strtolower(str_replace(' ', '-', $request->name));

    //     $request->merge(['slug' => $slug]);

    //     $validatedData = $request->validate([
    //         'lang' => 'required',
    //         'post_type' => 'required',
    //         'parent_category' => 'nullable',
    //         'name' => [
    //             'required',
    //             'max:30',
    //             new CombineUnique(['lang' => $request->lang, 'name' => $request->name, 'post_type' => $request->post_type], 'categories', 'name must be unique'),
    //         ],
    //         'slug' => [
    //             'required',
    //             'max:30',
    //             new CombineUnique(['lang' => $request->lang, 'name' => $request->name, 'post_type' => $request->post_type], 'categories', 'slug must be unique'),
    //         ],
    //         'description' => 'string|nullable',
    //         'meta_tag_description' => 'string|nullable',
    //         'meta_tag_keywords' => 'string|nullable',
    //     ]);

    //     $validatedData['created_by'] = auth()->id();

    //     $category = new EventCategory();
    //     $category->parent_category_id = $validatedData['parent_category'] ?? null;
    //     $category->name = $validatedData['name'];
    //     $category->slug = $validatedData['slug'];
    //     $category->description = $validatedData['description'];
    //     $category->meta_tag_description = $validatedData['meta_tag_description'];
    //     $category->meta_tag_keywords = $validatedData['meta_tag_keywords'];
    //     $category->lang = $validatedData['lang'];
    //     $category->post_type = $validatedData['post_type'];

    //     $category->save();
    //     $category->attachMedia($request->category_thumbnail, 'thumbnail');

    //     return redirect()->route('admin.category.index');
    // }

    // public function edit($id)
    // {
    //     $this->authorize('update-categories');

    //     return view('admin.category.edit', [
    //         'category' => EventCategory::find($id),
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $this->authorize('view-categories');

    //     $slug = $request->slug ? strtolower(str_replace(' ', '-', $request->slug)) : strtolower(str_replace(' ', '-', $request->name));

    //     $request->merge(['slug' => $slug]);

    //     $validatedData = $request->validate([
    //         'lang' => 'required',
    //         'post_type' => 'required',
    //         'name' => [
    //             'required',
    //             'max:30',
    //             new CombineUnique(['lang' => $request->lang, 'name' => $request->name, 'post_type' => $request->post_type], 'categories', 'name must be unique', $id),
    //         ],
    //         'slug' => [
    //             'required',
    //             'max:30',
    //             new CombineUnique(['lang' => $request->lang, 'name' => $request->name, 'post_type' => $request->post_type], 'tags', 'slug must be unique', $id),
    //         ],
    //         'description' => 'string|nullable',
    //         'meta_tag_description' => 'string|nullable',
    //         'meta_tag_keywords' => 'string|nullable',
    //     ]);

    //     $validatedData['updated_by'] = auth()->id();

    //     $category = EventCategory::find($id);
    //     $category->parent_category_id = $validatedData['parent_category'] ?? null;
    //     $category->name = $validatedData['name'];
    //     $category->slug = $validatedData['slug'];
    //     $category->description = $validatedData['description'];
    //     $category->meta_tag_description = $validatedData['meta_tag_description'];
    //     $category->meta_tag_keywords = $validatedData['meta_tag_keywords'];
    //     $category->lang = $validatedData['lang'];
    //     $category->post_type = $validatedData['post_type'];

    //     $category->save();
    //     $category->detachMediaTags('thumbnail');
    //     $category->attachMedia($request->category_thumbnail, 'thumbnail');

    //     return redirect()->route('admin.category.edit', $id)->with('EventCategoryUpdateSuccess', 'EventCategory Updated Successfully');
    // }

    // public function delete($id)
    // {
    //     $id = explode(',', $id);
    //     $this->authorize('delete-categories');

    //     foreach ($id as $i) {
    //         $category = EventCategory::find($i);
    //         $category->delete();
    //     }

    //     return response()->json(['message' => 'category deleted'], 201);
    // }
}

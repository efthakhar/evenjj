@extends('admin.layouts.app')

@section('content')
    <div>
        <div class="d-flex flex-wrap">
            <h4 class="h4 text-capitalize"> Event Category List </h4>

            <span class="ms-auto"></span>
            @can('create_event_category')
                <a href="/admin/event-categories/create" >
                    <button class="btn btn-sm btn-primary m-1">
                        <i class="ri-add-circle-line h6"></i>
                        <span class="d-none d-sm-inline ms-1"> Add New</span>
                    </button>
                </a>
            @endcan
            <button class="btn btn-sm btn-info text-white m-1 filter-toggle-btn">
                <i class="ri-filter-2-fill h6"></i>
                <span class="d-none d-sm-inline ms-1">Filter</span>
            </button>

        </div>

        <div class="filter-form-container mt-2 d-none">
            <form action="{{ route('admin.event_category.index') }}" class="row" method="GET" id="filter-form">
                <div class="form-item col-sm-4 col-md-2">
                    <label for="">per page</label>
                    {{ generate_perpage_options('perpage', 'category-filter-form-perpage', $_GET['perpage'] ?? '', 'form-control form-control-sm my-1') }}
                </div>
                <div class="form-item col-sm-4 col-md-2">
                    <label>name</label>
                    <input type="text" class="form-control form-control-sm my-1" name='name' id="name"
                        value="{{ isset($_GET['name']) ? $_GET['name'] : '' }}" placeholder="type & enter">
                </div>
                <div class="form-item col-sm-4 col-md-2">
                    <label>slug</label>
                    <input type="text" class="form-control form-control-sm my-1" name='slug' id="slug"
                        value="{{ isset($_GET['slug']) ? $_GET['slug'] : '' }}" placeholder="type & enter">
                </div>
                <div class="form-item col-sm-4 col-md-2">
                    <label for="">sort by</label>
                    <select name="sortby" id="sortby" class="form-control form-control-sm">
                        <option value="name">name</option>
                        <option value="slug">slug</option>
                    </select>
                </div>
                <div class="form-item col-sm-4 col-md-2">
                    <label for="">sort type</label>
                    <select name="sorttype" id="sorttype" class="form-control form-control-sm">
                        <option value="asc">asc</option>
                        <option value="desc">desc</option>
                    </select>
                </div>
                <div class="form-item col-md-12 my-1">
                    <button type="submit" class="btn btn-sm btn-primary">Apply Filter</button>
                </div>

            </form>
        </div>

        <div class="admin-main-content-table-container mt-4">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="mw100px">Name</th>
                            <th scope="col" class="mw200px">Slug</th>
                            @can(['edit_event_category'])
                                <th scope="col" class="mw200px">Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                @can(['edit_event_category'])
                                    <td>
                                        <div class="d-flex justify-center align-center">
                                            <a href="{{ route('admin.event_category.single', $category->id) }}"
                                                class="btn btn-sm p-0 text-info mx-1">
                                                <i class="ri-eye-line h4"></i>
                                            </a>
                                            <a href="{{ route('admin.event_category.edit', $category->id) }}"
                                                class="btn btn-sm p-0 text-sb1 mx-1">
                                                <i class="ri-edit-2-line h4"></i>
                                            </a>

                                            <button class="p-0 btn btn-sm text-danger delete-category mx-1"
                                                data-category-id="{{ $category->id }}">
                                                <i class="ri-delete-bin-line h4"></i>
                                            </button>

                                        </div>
                                    </td>
                                @endcan

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (count($categories) == 0)
                    <h2 class="h2 text-capitalize text-warning"> {{ __('no records found') }} </h2>
                @endif
            </div>
        </div>

        <div class="pagination-container">
            {{ $categories->links() }}
        </div>
    @endsection

    @section('footer-script')
        <script src="{{ asset('assets/admin/js/event-category.js') }}"></script>
    @endsection

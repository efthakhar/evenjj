@extends('admin.layouts.app')

@section('content')

<div class="d-flex flex-wrap">
    <h4 class="h4 text-capitalize"> Event List </h4>

    <a href="/admin/events/create" class="ms-auto">
        <button class="btn btn-sm btn-primary m-1">
            <i class="ri-add-circle-line h6"></i>
            <span class="d-none d-sm-inline ms-1"> Add New</span>
        </button>
    </a>
    <button class="btn btn-sm btn-info text-white m-1 filter-toggle-btn">
        <i class="ri-filter-2-fill h6"></i>
        <span class="d-none d-sm-inline ms-1">Filter</span>
    </button>

</div>

<div class="filter-form-container mt-2 d-none">
    <form action="{{route('admin.event.index')}}" class="row" method="GET" id="filter-form">
        <div class="form-item col-sm-4 col-md-2">
            <label for="">per page</label>
            {{ generate_perpage_options('perpage','event-filter-form-perpage', $_GET['perpage']??'',"form-control form-control-sm my-1") }}
        </div>
        <div class="form-item col-sm-4 col-md-2">
            <label>title</label>
            <input type="text" class="form-control form-control-sm my-1" name='title' id="title"
                value="{{ isset($_GET['title']) ? $_GET['title']:'' }}" placeholder="type & enter">
        </div>
        <div class="form-item col-sm-4 col-md-2">
            <label for="">sort by</label>
            <select name="sortby" id="sortby" class="form-control form-control-sm">
                <option value="title">name</option>
                <option value="date">date</option>
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
                    <th scope="col" class="mw100px">Title</th>
                    <th scope="col" class="mw100px">Date</th>
                    <th scope="col" class="mw200px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{$event->title}}</td>
                    <td>{{$event->date}}</td>
                    <td>
                        <div class="d-flex justify-center align-center">

                            <a href="{{ route('admin.event.single', $event->id) }}"
                                class="btn btn-sm p-0 text-info mx-1">
                                <i class="ri-eye-line h4"></i>
                            </a>

                            <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-sm p-0 text-sb1 mx-1">
                                <i class="ri-edit-2-line h4"></i>
                            </a>

                            <button class="p-0 btn btn-sm text-danger delete-event mx-1"
                                data-event-id="{{ $event->id }}">
                                <i class="ri-delete-bin-line h4"></i>
                            </button>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($events)==0)
        <h2 class="h2 text-capitalize text-warning"> {{ __('no records found') }} </h2>
        @endif
    </div>
</div>

<div class="pagination-container">
    {{$events->links()}}
</div>

@endsection

@section('footer-script')
<script src="{{asset('assets/admin/js/event.js')}}"></script>
@endsection
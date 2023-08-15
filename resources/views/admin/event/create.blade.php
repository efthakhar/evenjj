@extends('admin.layouts.app')

@section('content')
<div>
    <div>
        <h3 class="text-capitalize"> Create Event </h3>
    </div>
    <div class="form-container">
        <form method="post" action="{{route('admin.event.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="row col-md-6">
                    <div class="form_item col-12">
                        <label class="mt-3 mb-1">Title</label>
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input type="text" class="form-control form-control-sm" name='title' value=" {{old('title')}} ">
                    </div>
                    <div class="form_item col-12">
                        <label class="mt-3 mb-1">Category</label>
                        @error('event_category_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <select name="event_category_id" id="category" class="form-control form-control-sm">
                            <option value="">none</option>
                            @foreach ($categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_item col-12">
                        <label class="mt-3 mb-1">Date</label>
                        @error('date')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input type="date" class="form-control form-control-sm" name='date' value=" {{old('date')}} ">
                    </div>
                    <div class="form_item col-12">
                        <label class="mt-3 mb-1">time</label>
                        @error('time')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input step="any" type="time" class="form-control form-control-sm" name='time' value=" {{old('time')}} ">
                    </div>
                    <div class="form_item col-md-12">
                        <label class="mt-3 mb-1">Description</label>
                        @error('description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror 
                        <textarea name="description" class="form-control form-control-sm">{{old('description')}}</textarea>
                    </div>
                    <div class="form_item col-md-12">
                        <label class="mt-3 mb-1">Location</label>
                        @error('location')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror 
                        <textarea name="location" class="form-control form-control-sm">{{old('location')}}</textarea>
                    </div>
                </div>
                <div class="submit-form-btn-container">
                    <button type="submit" class="btn btn-primary btn-sm mt-3 ">
                        Save Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('footer-script')
<script src="{{asset('assets/admin/js/event-category.js')}}"></script>
@endsection
@extends('admin.layouts.app')

@section('content')
    <div>
        <div>
            <h3 class="text-capitalize"> Event Details</h3>
        </div>
        <div class="form-container">                  
                <div class="row">
                    <div class="row col-md-6">
                        <div class="form_item col-12">
                            <label class="mt-3 mb-1">Title</label>
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input disabled  type="text" class="form-control form-control-sm" name='title'
                                value="{{ $event->title }}" >
                        </div>
                        <div class="form_item col-12">
                            <label class="mt-3 mb-1">Category</label>
                            @error('event_category_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <select disabled name="event_category_id" id="category" class="form-control form-control-sm">
                                <option value="">none</option>
                                @foreach ($categories as $c)
                                    <option {{ $c->id == $event->event_category_id ? 'selected' : '' }}
                                        value="{{ $c->id }}">
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form_item col-12">
                            <label class="mt-3 mb-1">Date</label>
                            @error('date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input disabled type="date" class="form-control form-control-sm" name='date'
                                value="{{ $event->date }}">
                        </div>
                        <div class="form_item col-12">
                            <label class="mt-3 mb-1">time</label>
                            @error('time')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input disabled type="time" step="any" class="form-control form-control-sm" name='time'
                                value="{{ $event->time }}">
                        </div>
                        <div class="form_item col-md-12">
                            <label class="mt-3 mb-1">Description</label>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea disabled name="description" class="form-control form-control-sm">{{ $event->description }}</textarea>
                        </div>
                        <div class="form_item col-md-12">
                            <label class="mt-3 mb-1">Location</label>
                            @error('location')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea disabled name="location" class="form-control form-control-sm">{{ $event->location }}</textarea>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

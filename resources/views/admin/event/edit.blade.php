@extends('admin.layouts.app')

@section('content')
    <div>
        <div>
            <h3 class="text-capitalize"> Edit Event</h3>
        </div>
        @if (session()->has('EventUpdateSuccess'))
            <div class="alert bg-success-1 text-success-1">
                {{ session()->get('EventUpdateSuccess') }}
            </div>
        @endif
        <div class="form-container">
            <form method="post" action="{{ route('admin.event.update', $event->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
                <div class="row">
                    <div class="row col-md-6">
                        <div class="form_item col-12">
                            <label class="mt-3 mb-1">Title</label>
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input type="text" class="form-control form-control-sm" name='title'
                                value="{{ old('title') ?? $event->title }}">
                        </div>
                        <div class="form_item col-12">
                            <label class="mt-3 mb-1">Category</label>
                            @error('event_category_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <select name="event_category_id" id="category" class="form-control form-control-sm">
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
                            <input type="date" class="form-control form-control-sm" name='date'
                                value="{{ old('date') ?? $event->date }}">
                        </div>
                        <div class="form_item col-12">
                            <label class="mt-3 mb-1">time</label>
                            @error('time')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input type="time" step="any" class="form-control form-control-sm" name='time'
                                value="{{ old('time') ?? $event->time }}">
                        </div>
                        <div class="form_item col-md-12">
                            <label class="mt-3 mb-1">Description</label>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="description" class="form-control form-control-sm">{{ old('description') ?? $event->description }}</textarea>
                        </div>
                        <div class="form_item col-md-12">
                            <label class="mt-3 mb-1">Location</label>
                            @error('location')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <textarea name="location" class="form-control form-control-sm">{{ old('location') ?? $event->location }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="submit-form-btn-container">
                    <button type="submit" class="btn btn-sm btn-primary mt-3 ">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer-script')
    <script src="{{ asset('assets/admin/js/event-category.js') }}"></script>
@endsection

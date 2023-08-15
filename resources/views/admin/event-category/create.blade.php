@extends('admin.layouts.app')

@section('content')
<div>
    <div>
        <h3 class="text-capitalize"> Create Event Category</h3>
    </div>
    <div class="form-container">
        <form method="post" action="{{route('admin.event_category.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="row col-md-6">
                    <div class="form_item col-12">
                        <label class="mt-3 mb-1">Category name</label>
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input type="text" class="form-control form-control-sm" name='name' value=" {{old('name')}} ">
                    </div>
                    <div class="form_item col-12">
                        <label class="mt-3 mb-1">Category slug</label>
                        @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input type="text" class="form-control form-control-sm" name='slug' value=" {{old('slug')}} ">
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
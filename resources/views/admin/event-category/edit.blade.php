@extends('admin.layouts.app')

@section('content')
    <div>
        <div>
            <h3 class="text-capitalize"> Edit Category</h3>
        </div>
        @if(session()->has('EventCategoryUpdateSuccess'))
        <div class="alert bg-success-1 text-success-1">
            {{ session()->get('EventCategoryUpdateSuccess') }}
        </div>
        @endif
        <div class="form-container">
            <form method="post" action="{{ route('admin.event_category.update', $category->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="cat_id" id="cat_id" value="{{$category->id}}">
                <div class="row">
                    <div class="row col-md-6">
                        <div class="form_item col-12">
                            <label class="mt-3 mb-1">Category name</label>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input type="text" class="form-control form-control-sm" name='name'
                                value=" {{ old('name') ?? $category->name }}">
                        </div>
                        <div class="form_item col-12">
                            <label class="mt-3 mb-1">Category slug</label>
                            @error('slug')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input type="text" class="form-control form-control-sm" name='slug'
                                value=" {{ old('slug') ?? $category->slug }} ">
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
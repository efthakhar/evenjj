@extends('admin.layouts.app')

@section('content')
<div class="admin-single-view">
    <div>
        <h3 class="text-capitalize"> Category Details</h3>
    </div>

    <div class="form-container">
        <form>
            <div class="row">
                <div class="col-md-6 row">
                    <div class="form_item col-12">
                        <label class="mt-3 mb-1">Category name</label>
                        <input type="text" class="form-control form-control-sm" disabled name='name'
                            value=" {{ $category->name }}">
                    </div>
                    <div class="form_item col-12">
                        <label class="mt-3 mb-1">Category slug</label>
                        <input type="text" class="form-control form-control-sm" disabled name='slug'
                            value=" {{  $category->slug }} ">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('footer-script')
<script src="{{ asset('assets/admin/js/event-category.js') }}"></script>
@endsection
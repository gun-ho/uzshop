<?php
    use App\Models\Category;

    /**
     * @var Category $category
     */
?>
@extends('admin.dashboard')
@section('title', 'Изменить категорию')
@push('scripts')
    <script src="{{ asset('js/validate_fields.js') }}"></script>
@endpush
@section('container')
    @include('admin.messages')
    <form action="{{ route('admin.category.update', $category->getId()) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Изменить категорию</h6>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="name" class="required">Названия</label>
                        <input type="text" class="form-control" id="name" placeholder="Названия" name="name" maxlength="200" value="{{ is_null(old('name')) ? $category->getName() : old('name') }}">
                    </div>
                    <div class="col-sm-6">
                        <label for="slug" class="required">Таг</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Таг" maxlength="200" value="{{ is_null(old('slug')) ? $category->getSlug() : old('slug') }}">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success btn-icon-split" type="submit">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                    <span class="text">Изменить</span>
                </button>
                <a class="btn btn-danger btn-icon-split" href="{{ route('admin.category.index') }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-window-close"></i>
                                        </span>
                    <span class="text">Отменить</span>
                </a>
            </div>
        </div>
    </form>
@endsection

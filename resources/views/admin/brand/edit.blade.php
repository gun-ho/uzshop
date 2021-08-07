<?php
    use App\Models\Brand;

    /**
     * @var Brand $brand
     */
?>
@extends('admin.dashboard')
@section('title', 'Изменить бренд')
@push('scripts')
    <script src="{{ asset('js/validate_fields.js') }}"></script>
@endpush
@section('container')
    @include('admin.messages')
    <form action="{{ route('admin.brand.update', $brand->getId()) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Изменить бренд</h6>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="name" class="required">Названия</label>
                        <input type="text" class="form-control" id="name" placeholder="Названия" name="name" maxlength="200" value="{{ is_null(old('name')) ? $brand->getName() : old('name') }}">
                    </div>
                    <div class="col-sm-6">
                        <label for="slug" class="required">Таг</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Таг" maxlength="200" value="{{ is_null(old('slug')) ? $brand->getSlug() : old('slug') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="image" class="required">Выберите рисунка(jpeg, jpg, png)</label>
                        <input id="image" name="image" type="file" class="file" title="Не выбран файл">
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <img src="{{ $brand->image->getUrl() }}" alt="image" width="400" height="400">
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
                <a class="btn btn-danger btn-icon-split" href="{{ route('admin.brand.index') }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-window-close"></i>
                                        </span>
                    <span class="text">Отменить</span>
                </a>
            </div>
        </div>
    </form>
@endsection

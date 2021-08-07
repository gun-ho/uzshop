<?php
    use App\Models\Category;
    use Illuminate\Pagination\LengthAwarePaginator;

    /**
     * @var Category $category
     * @var LengthAwarePaginator $categories
     */
?>
@extends('admin.dashboard')
@section('title', 'Бренд')
@section('brand', 'active')
@section('container')
    @include('admin.messages')
    <h1 class="h3 mb-4 text-gray-800">Бренды</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Общая количество: {{ $brands->total() }}</h6>
            <a href="{{ route('admin.brand.create') }}" class="btn btn-primary btn-icon-split float-right">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text">Добавить новую бренд</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Названия</th>
                            <th>Таг</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $key => $brand)
                            <tr>
                                <td>{{ ( $key + 1 ) + ( $brands->currentPage() - 1) * $brands->perPage() }}</td>
                                <td>{{ $brand->getName() }}</td>
                                <td>{{ $brand->getSlug() }}</td>
                                <td>
                                    <div class="row">
                                    <div class="col-md-3">
                                        <a class="btn btn-warning btn-icon-split" href="{{ route('admin.brand.edit', $brand->getId()) }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                            <span class="text">Изменить</span>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <form action="{{ route('admin.brand.destroy', $brand->getId()) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-icon-split" type="submit">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span class="text">Удалить</span>
                                            </button>
                                        </form>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $brands->links() }}
            </div>
        </div>
    </div>
@endsection

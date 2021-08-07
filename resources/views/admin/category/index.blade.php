<?php
    use App\Models\Category;
    use Illuminate\Pagination\LengthAwarePaginator;

    /**
     * @var Category $category
     * @var LengthAwarePaginator $categories
     */
?>
@extends('admin.dashboard')
@section('title', 'Категория')
@section('category', 'active')
@section('container')
    @include('admin.messages')
    <h1 class="h3 mb-4 text-gray-800">Категории</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Общая количество: {{ $categories->total() }}</h6>
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-icon-split float-right">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text">Добавить новую категорию</span>
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
                        @foreach($categories as $key => $category)
                            <tr>
                                <td>{{ ( $key + 1 ) + ( $categories->currentPage() - 1) * $categories->perPage() }}</td>
                                <td>{{ $category->getName() }}</td>
                                <td>{{ $category->getSlug() }}</td>
                                <td>
                                    <div class="row">
                                    <div class="col-md-3">
                                        <a class="btn btn-warning btn-icon-split" href="{{ route('admin.category.edit', $category->getId()) }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                            <span class="text">Изменить</span>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <form action="{{ route('admin.category.destroy', $category->getId()) }}" method="POST">
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
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection

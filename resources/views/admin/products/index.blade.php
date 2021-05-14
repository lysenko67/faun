@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Статьи</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список продуктов</h3>
            </div>
            <div class="card-body">
                <a href="{{route('products.create')}}" class="btn btn-primary mb-3">Добавить продукт</a>
                @if(count($products))
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-wrap">
                            {{--                                <thead>--}}
                            {{--                                <tr>--}}
                            {{--                                    <th style="width: 30px">#</th>--}}
                            {{--                                    <th>Фото</th>--}}
                            {{--                                    <th>Наименование</th>--}}
                            {{--                                    <th>Категория</th>--}}
                            {{--                                    <th>Дата</th>--}}
                            {{--                                    <th>Actions</th>--}}
                            {{--                                </tr>--}}
                            {{--                                </thead>--}}
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>
                                        @if(!empty($product->images[0]->img))
                                            <img
                                                src="{{asset('storage/images/' . $product->id . '/' . $product->images[0]->img)}}"
                                                alt="" style="width: 100px; height: 100px">
                                        @endif
                                    </td>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->category->title}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>
                                        <a href="{{route('products.edit', ['product' => $product->id])}}"
                                           class="btn btn-info btn-sm float-left mr-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{route('products.destroy', ['product' => $product->id])}}"
                                              method="post" class="float-left">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Подтвердите удаление')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    <p>Продуктов пока нет...</p>
                @endif
            </div>
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{$products->links()}}
                </ul>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

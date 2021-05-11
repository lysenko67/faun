@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование продукта</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    "{{$product->title}}"
                </h3>
            </div>
            <form role="form" method="post" action="{{route('products.update', ['product' => $product->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Автор</label>
                        <input type="text" class="form-control" name="title" value="{{$product->author}}">
                    </div>

                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{$product->title}}">
                    </div>

                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5">
                            {{$product->description}}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Категория</label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach($categories as $k => $v)
                                <option value="{{$k}}" @if($k == $product->category_id) celected @endif>{{$v}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="files">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="files">
                                <label class="custom-file-label" for="files">Загрузка картинок</label>
                            </div>
                        </div>
                        <div class="mt-2">

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>

        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

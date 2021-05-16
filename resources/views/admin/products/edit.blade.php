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
            <form role="form" name="my">
{{--                @csrf--}}
{{--                @method('PUT')--}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="author">Автор</label>
                        <input type="text" class="form-control" name="author" value="{{$product->author}}">
                    </div>

                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{$product->title}}">
                    </div>

                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                  id="description" rows="5">
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
                        <label for="title">Цена</label>
                        <input type="number" class="form-control @error('title') is-invalid @enderror" name="price" value="{{$product->price}}">
                    </div>

                    <div class="form-group">
                        <label for="files">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file">
                                <label class="custom-file-label" for="files">Загрузить картинку</label>
                            </div>
                        </div>
                    </div>
                    <div id="preview" class="row" product="{{$product->id}}">
                        @foreach($product->images as $image)
                            <div class="preview-img">
                                <img src="{{asset('storage/images/' . $product->id . '/' . $image->img)}}" alt=""
                                     style="width: 200px">
                                <div class="img-close" data="img_name" >del</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->

            </form>

            <div class="card-footer">
                <button class="btn btn-primary" id="addFormData">Сохранить</button>
            </div>
        </div>

        <!-- /.card -->
        <script src="{{asset('assets/admin/my-js/upload_img.js')}}"></script>
    </section>
    <!-- /.content -->
@endsection

@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Контакты</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">

                <form action="">
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text" class="form-control" name="phone" value="{{$contact->phone}}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{$contact->email}}">
                    </div>
                    <div class="form-group">
                        <label>Часы работы</label>
                        <input type="text" class="form-control" name="working_hours" value="{{$contact->working_hours}}">
                    </div>
                    <div class="form-group">
                        <label>Текст</label>
                        <textarea class="form-control" name="text" cols="30" rows="5">{{$contact->text}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Отправить</button>
                </form>

            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection


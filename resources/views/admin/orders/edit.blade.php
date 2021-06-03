@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Изменение заказа id: {{$order->id}}</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <form role="fomr" method="post" action="{{route('orders.update', ['order' => $order->id])}}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="name" value="{{$order->name}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="email" value="{{$order->email}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Телефон</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="phone" value="{{$order->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="text">Примечания</label>
                                <textarea name="text" id="text" cols="30" rows="5" class="form-control @error('title') is-invalid @enderror">{{$order->text}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="text">Товар</label>
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Артикул</td>
                                        <td>Назание</td>
                                        <td>Колличество</td>
                                        <td>Сумма</td>
                                    </tr>
                                    @foreach($order->products as $product)
                                    <tr>
                                        <td>
                                            {{$product->vendor_code}}
                                        </td>
                                        <td>
                                            {{$product->title}}
                                        </td>
                                        <td>
                                            <input name="qty_{{$product->vendor_code}}" class="form-control" value="{{$product->qty}}">
                                        </td>
                                        <td>
                                            <input name="id_{{$product->vendor_code}}" class="form-control" value="{{$product->sum}} ">
                                            <input type="hidden" name="id:{{$product->vendor_code}}" value="{{$product->id}}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
{{--    @php--}}
{{--        dd($order);--}}
{{--    @endphp--}}
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

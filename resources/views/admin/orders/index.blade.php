@extends('admin.layouts.layout')

@section('content')
    <div class="card" style="color:#666666">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Список заказов</h3>
                </div>
                <div class="col">
                    <form action="">
                        @csrf
                        @method('GET')
                        <select onchange="this.form.submit()" class="form-control" class="form-control" name="sort-status">
                            <option value="">{{isset($get) ? \App\Models\Order::statusTranslates($get) : 'Все заказы'}}</option>
                            <option value="all">Все заказы</option>
                            <option value="accepted">Принят</option>
                            <option value="mail">Ожидает отправки</option>
                            <option value="delivery">В пути</option>
                            <option value="arrived">Прибыл</option>
                            <option value="completed">Завершён</option>
                        </select>
                    </form>
                </div>
            </div>

        </div>
        <div class="card-body">
            @if(count($orders))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-wrap">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Имя Фамилия</th>
                            <th>Телефон</th>
                            <th>Товар</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th>Править</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $order)
                            <tr style="background: {{\App\Models\Order::getStatus($order->status)}}">
                                <td>{{$order->id}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->phone}}</td>
                                <td>
                                    @foreach($order->products->all() as $product)
                                        <span>{{'Артикул: '.$product->vendor_code}} <span
                                                style="color:cornflowerblue">{{'"'.$product->title.'"'}}</span> - {{$product->qty}} шт.</span>
                                        <br>
                                        @php $sum[] = $product->sum @endphp
                                    @endforeach
                                </td>
                                <td>{{array_sum($sum)}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="{{asset('/images/mail/'.$order->status.'.svg')}}" alt="" width="40">
                                        </div>
                                        <div class="col">
                                            <form action="{{route('orders.update', ['order' => $order->id])}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select onchange="this.form.submit()" class="form-control" style="margin-left: 20px; width: 80%" name="status" id="status">
                                                    <option value="">{{\App\Models\Order::statusTranslates($order->status)}}</option>
                                                    <option value="accepted">Принят</option>
                                                    <option value="mail">Ожидает отправки</option>
                                                    <option value="delivery">В пути</option>
                                                    <option value="arrived">Прибыл</option>
                                                    <option value="completed">Завершён</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('orders.edit', ['order' => $order->id])}}"
                                       class="btn btn-info btn-sm float-left mr-1">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{route('orders.destroy', ['order' => $order->id])}}"
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
                <p>Заказов пока нет...</p>
            @endif
        </div>
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                {{$orders->links()}}
            </ul>
        </div>
    </div>
@endsection

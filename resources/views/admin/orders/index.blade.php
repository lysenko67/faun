@extends('admin.layouts.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Список продуктов</h3>
        </div>
        <div class="card-body">
            @if(count($clients))
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-wrap">
                        <thead>
                        <tr>
                            <th>Артикул</th>
                            <th>Имя Фамилия</th>
                            <th>Телефон</th>
                            <th>Товар</th>
                            <th>Сумма</th>
                            <th>Править</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($clients as $client)
                            <tr>
                                <td>{{$client->id}}</td>
                                <td>{{$client->name}}</td>
                                <td>{{$client->phone}}</td>
                                <td>
                                    @foreach($client->product->all() as $product)
                                        <span>{{'"'.$product->title.'" - '.$product->qty}} шт.</span><br>
                                        @php $sum[] = $product->sum @endphp
                                    @endforeach
                                </td>
                                <td>{{array_sum($sum)}}</td>
                                <td>
                                    <a href="{{route('orders.edit', ['order' => $client->id])}}"
                                       class="btn btn-info btn-sm float-left mr-1">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action=""
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
                {{$clients->links()}}
            </ul>
        </div>
    </div>
@endsection

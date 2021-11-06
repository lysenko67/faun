@extends('shop.layout.main')

@section('title', 'Корзина')

@section('content')
    <div class="row">

        @include('shop.layout.sidebur')

        <div class="col-10">

            @include('shop.layout.breadcrumbs')

            @if(!empty($cart))
                <form id="order" method="post" action="{{route('shop-orders.store')}}" name="order">
{{--                <form id="order" name="order" method="post" action="{{route('orders')}}">--}}
                    @csrf

                    <table class="table">
                        <tbody>
                        @foreach($cart as $item)
                            <tr class="order-product">
                                <td>
                                    <a href="{{route('product.index', [$item['category_slug'], $item['product_slug']])}}">
                                        <img src="{{asset('storage/images/'.$item['id'].'/'.$item['img'])}}" width="150"
                                             alt="">
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <span>{{$item['title']}}</span><br>
                                    <span style="color: #999999">Артикул: {{$item['id']}}</span>
                                </td>
                                <td class="align-middle">
                                    <span>Колличество: </span>
                                    <input data-id="{{$item['id']}}" type="button" class="add-buttom del-qty" value="-"
                                           style="border-radius: 50%; padding-left: 10px; padding-right: 10px;">
                                    <span
                                        data-id="{{$item['id']}}" class="input-add-qty qty-product">{{session()->get('cart.'.$item['id'].'.qty_product')}}</span>
                                    <input data-id="{{$item['id']}}" type="button" class="add-buttom add-to-cart"
                                           value="+"
                                           style="border-radius: 50%; padding-left: 8px; padding-right: 8px;">
                                </td>
                                <td class="align-middle">
                                    <span data-id-price="{{$item['id']}}" class="price-table price-product">{{$item['price']}}</span>
                                    <input type="hidden" name="id_{{$item['id']}}" value="{{$item['price']}}">
                                    <input type="hidden" name="qty_{{$item['id']}}" class="qty-product" value="{{session()->get('cart.'.$item['id'].'.qty_product')}}">
                                    <input type="hidden" name="title_{{$item['id']}}" class="qty-product" value="{{$item['title']}}">
                                </td>
                                <td class="align-middle">
                                <span style="cursor: pointer" title="Удалить">
                                    <img class="delete-product" data-id="{{$item['id']}}" src="{{asset('images/cansel.svg')}}" alt="" width="13">
                                </span>
                                </td>
                            </tr>
                        @endforeach
                        <tr style="background: #f1f1f1">
                            <td colspan="5" style="text-align: center">
                                <p>Итого: товара на сумму <span
                                        class="price-table price-sum">{{session()->get('result.sum')}}</span> руб.</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="fs-5 bronze">Контактная информация</p>
                            <div class="mb-3 row">

                                <label class="col-sm-3 col-form-label">*Телефон</label>
                                <div class="col-sm-9">
                                    <span data-err="phone" class="errors-forms"></span>
                                    <input
                                        type="text"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        name="phone"
                                        placeholder="Телефон"
                                    >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">*Имя Фамилия</label>
                                <div class="col-sm-9">
                                    <span data-err="name" class="errors-forms"></span>
                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        placeholder="Имя Фамилия"
                                    >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">*Email</label>
                                <div class="col-sm-9">
                                    <span data-err="email" class="errors-forms"></span>
                                    <input
                                        type="text"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        placeholder="Email"
                                    >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Примечание</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="text" id="text" cols="20" rows="5"
                                          placeholder="Примечание"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <p class="fs-5 bronze">Доставка и оплата</p>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Город/село</label>
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control @error('city') is-invalid @enderror"
                                        name="city"
                                        id="city"
                                    >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Улица</label>
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control @error('street') is-invalid @enderror"
                                        name="street"
                                        id="street"
                                    >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Дом/корп/кв</label>
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control @error('house') is-invalid @enderror"
                                        name="house"
                                        id="house"
                                    >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Индекс</label>
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control @error('index') is-invalid @enderror"
                                        name="index"
                                        id="index"
                                    >
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="buy" class="btn btn-outline-secondary" style="margin: 60px; width: 70%">Заказать</button>
                    </div>
                </form>

            @else
                <h5>Ваша корзина пуста :(</h5>
            @endif
        </div>
    </div>

@endsection

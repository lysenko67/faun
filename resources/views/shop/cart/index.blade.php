@extends('shop.layout.main')

@section('title', 'Корзина')

@section('content')
    <div class="row">

        @include('shop.layout.sidebur')

        <div class="col-10">

            @include('shop.layout.breadcrumbs')

            @if(!empty($cart))
                <form method="post" id="order" name="order">
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
                                    <img src="{{asset('images/cansel.svg')}}" alt="" width="13">
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
                            <p class="fs-5">Контактная информация</p>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Телефон</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Имя Фамилия</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Имя Фамилия">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Примечание</label>
                                <textarea class="form-control" name="text" id="text" cols="30" rows="5"
                                          placeholder="Примечание"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <p class="fs-5">Доставка и оплата</p>
                            <div class="mb-3">
                                <label for="сity" class="form-label">Город</label>
                                <input type="text" class="form-control" name="сity" id="city">
                            </div>
                            <div class="mb-3">
                                <label for="street" class="form-label">Улица</label>
                                <input type="text" class="form-control" name="street" id="street">
                            </div>
                            <div class="mb-3">
                                <label for="house" class="form-label">Дом</label>
                                <input type="text" class="form-control" name="house" id="house">
                            </div>
                            <div class="mb-3">
                                <label for="index" class="form-label">Индекс</label>
                                <input type="text" class="form-control" name="index" id="index">
                            </div>
                            <div class="mb-3">
                                <label for="index" class="form-label">Адрес пунккта выдачи</label>
                                <input type="text" class="form-control" name="index" id="index">
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="buy" class="btn btn-success">Купить</button>
                </form>

            @else
                <h5>Ваша корзина пуста :(</h5>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('buy').addEventListener('click', function (e) {
            e.preventDefault();

            const forms = document.forms.order.elements

            fetch('admin/orders', {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.getElementById('token').getAttribute('content')
                },
                body: formsSerialize(forms)
            })

        })

        function formsSerialize(forms) {
            const formData = new FormData()
            for (let i = 0; i < forms.length; i++) {
                formData.append(forms[i].name, forms[i].value)
            }
            return formData
        }

    </script>
@endsection

@extends('shop.layout.main')

@section('title', 'Корзина')

@section('content')
    <div class="row">

        @include('shop.layout.sidebur')

        <div class="col-10">

            <div class="row">
                <div class="col-auto me-auto">
                    <a href="javascript:history.back(1)">
                        <svg class="back-svg" id="Layer" enable-background="new 0 0 64 64" fill="#949494FF" height="30"
                             viewBox="0 0 64 64" width="30" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m54 30h-39.899l15.278-14.552c.8-.762.831-2.028.069-2.828-.761-.799-2.027-.831-2.828-.069l-17.448 16.62c-.755.756-1.172 1.76-1.172 2.829 0 1.068.417 2.073 1.207 2.862l17.414 16.586c.387.369.883.552 1.379.552.528 0 1.056-.208 1.449-.621.762-.8.731-2.065-.069-2.827l-15.342-14.552h39.962c1.104 0 2-.896 2-2s-.896-2-2-2z"/>
                        </svg>
                    </a>
                </div>
                <div class="col-auto">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Корзина</li>
                    </ol>
                </div>
            </div>
            <hr id="basket">
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
                        </div>
                    </div>
                    <button type="submit" id="buy" class="btn btn-success">Купить</button>
                </form>

            @else
                <h3>Моя корзина</h3>
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

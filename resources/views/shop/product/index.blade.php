@extends('shop.layout.main')

@section('title', 'Главная')

@section('content')

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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    {!!\App\Services\Breadcrumbs\Breadcrumbs::render($category, $product)!!}
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-7">
            <div id="carouselExampleControls" class="carousel slide">
                <div class="carousel-inner">
                    @foreach($product->images as $key => $item)
                        <div class="carousel-item {{$key === 0 ? 'active' : false}}">
                            <img src="{{asset('storage/images/'.$product['id'].'/'.$item['img'])}}"
                                 class="d-block w-100" alt="...">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev" style="display: {{$key<1 ? 'none' : ''}}">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Предыдущий</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next" style="display: {{$key<1 ? 'none' : ''}}">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Следующий</span>
                </button>
                <div class="carousel-indicators">
                    @foreach($product->images as $key => $item)
                        <img src="{{asset('storage/images/'.$product['id'].'/'.$item['img'])}}"
                             data-bs-target="#carouselExampleControls" data-bs-slide-to="{{$key}}"
                             class="{{$key === 0 ? 'active' : false}}" aria-current="true" aria-label="Slide {{$key+1}}"
                             width="70">
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-5">
            <h3>{{$product->title}}</h3>
            <p>{{$product->description}}</p>
            <hr>
            <div  style="margin-top: 50px;">
                <p>Высота: 23см;</p>
                <p>Ширина: 15см;</p>
                <p>Материал: Полимер, кварц</p>
            </div>
            <hr>
            <div style="margin-top: 50px; text-align: center">
{{--                <div class="col" style="text-align: center">--}}

{{--                </div>--}}
                <div>
                    Цена: {{$product->price}} руб.
                </div>
            </div>
            <div style="margin-top: 30px">
                <div style="text-align: center">
                    <button data-id="{{$product->id}}" class="btn btn-outline-secondary add-to-cart">
                        В корзину
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal" tabindex="-1">
        <div class="modal-dialog" style="margin: 15rem auto">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none; padding: .7rem">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal__body">
                    <h5 class="modal-title text-center">Товар добавлен в корзину</h5>
                    <p class="text-center">
                        Всего в вашей корзине товаров 3<br>
                        на сумму  <span class="price-sum price-table"></span> руб.
                    </p>
                    <div class="row">
                        <div class="col-3">
                            <img src="{{asset('storage/images/'.$product['id'].'/'.$product->images[0]->img)}}" alt="" width="100">
                        </div>
                        <div class="col-9">
                            <p class="fs-5">{{$product->title}} <span>{{$product->price}} руб.</span></p>
                            <div>
                                <span>Колличество: </span>
                                <input data-id="{{$product->id}}" type="button" class="add-buttom del-qty" value="-"
                                       style="border-radius: 50%; padding-left: 10px; padding-right: 10px;">
                                <span data-id="{{$product->id}}" class="input-add-qty qty-product">{{session()->get('cart.'.$product['id'].'.qty_product')}}</span>
                                <input data-id="{{$product->id}}" type="button" class="add-buttom add-to-cart" value="+"
                                       style="border-radius: 50%; padding-left: 8px; padding-right: 8px;">
                            </div>

                        </div>
                    </div>
                </div>
                <div style="border-top: none; text-align: center; padding-bottom: 1rem; padding-top: 1rem">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary" data-bs-dismiss="modal">Продолжиит покупки</button>
                    <button id="to-cart" type="button" class="btn btn-outline-success">Перейти в корзину</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom_js')
    <script>
        (function () {
            document.getElementById('to-cart').addEventListener('click', function() {
                myModal.toggle()
                window.location.href = document.location.protocol + '//' + document.location.host + '/cart'
            })
        })()
    </script>
@endsection

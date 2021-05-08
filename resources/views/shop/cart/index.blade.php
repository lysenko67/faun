@extends('shop.layout.main')

@section('title', 'Корзина')

@section('content')
    <div class="row">

        @include('shop.layout.sidebur')

        <div class="col-10">
            @if(!empty($cart))
                @foreach($cart as $item)
                    <div class="row">
                        <div class="col">
                            <img src="/images/{{$item['img']}}" width="150" alt="">
                        </div>
                        <div class="col">
                            <h5>Апполон</h5>
                        </div>
                        <div class="col">

                        </div>
                        <div class="col">
                            <h4>{{session()->get('result.sum')}}</h4>
                        </div>
                    </div>
                @endforeach
            @else
                <h3>Моя корзина</h3>
                <h5>Ваша корзина пуста :(</h5>
            @endif
        </div>
    </div>


@endsection

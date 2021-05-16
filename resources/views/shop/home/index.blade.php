@extends('shop.layout.main')

@section('title', 'Главная')

@section('content')
    <div class="row">

        @include('shop.layout.sidebur')

        <div class="col-10">
            <div class="row">
                <div class="col">
                    <h1>
                        Микеланджело Буонарроти
                    </h1>
                    <p>
                        «Если есть что хорошее в моём даровании, то это от того, что я родился в разрежённом воздухе
                        аретинской вашей земли, да и резцы, и молот, которыми я делаю свои статуи, я извлёк из молока
                        моей кормилицы»
                    </p>
                </div>
                <div class="col-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item"><a href="#">Библиотека</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Данные</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                @foreach($products as $key => $product)
                    <div class="card" style="width: 18rem; margin: 20px">
                        <div class="card-body">
                            <a href="{{route('product.index', [$product->category['slug'], 'slug' => $product->slug])}}">

                                <img src="{{asset('storage/images/'.$product['id'].'/'.$product->images[0]->img)}}" alt="" width="240">

                            </a>
                            <p class="card-text">{{$product->price}} руб.</p>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$products->links()}}
        </div>
    </div>

@endsection


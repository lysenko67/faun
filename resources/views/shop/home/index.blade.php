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
                @foreach($products as $product)
                    <div class="card" style="width: 18rem; margin: 20px">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->category['title']}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Подзаголовок карты</h6>
                            <a href="{{route('category.index', $product->category['slug'])}}">

                                {{--<img src="/images/{{$product->images[0]['img']}}" alt="" width="240">--}}

                            </a>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                            <p class="card-text">{{$product->price}} руб.</p>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$products->links()}}
        </div>
    </div>

@endsection


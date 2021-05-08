@extends('shop.layout.main')

@section('title', 'Главная')

@section('content')
    <div class="row">
        <div class="col-7">
            <div id="carouselExampleControls" class="carousel slide">
                <div class="carousel-inner">
                    @foreach($product->images as $key => $item)
                        <div class="carousel-item {{$key === 0 ? 'active' : false}}">
                            <img src="/images/{{$item['img']}}" class="d-block w-100" alt="...">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Предыдущий</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Следующий</span>
                </button>
                <div class="carousel-indicators">
                    @foreach($product->images as $key => $item)
                    <img src="/images/{{$item['img']}}" data-bs-target="#carouselExampleControls" data-bs-slide-to="{{$key}}"
                         class="{{$key === 0 ? 'active' : false}}" aria-current="true" aria-label="Slide {{$key+1}}" width="70">
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-5">
            <h3>{{$product->title}}</h3>
            <p>{{$product->description}}</p>
            <p>{{$product->price}} руб.</p>
        </div>
    </div>
@endsection

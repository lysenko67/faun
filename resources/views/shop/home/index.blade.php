@extends('shop.layout.main')

@section('title', 'Главная')

@section('content')

    <div class="row">

        @include('shop.layout.sidebur')

        <div class="col-xl-10 col-lg-12">
            <div class="row">
                <div class="home-image">
                    <div style="position: fixed; margin-bottom: 30px; width: 80%;">
                        <div style="position: absolute; left: 25px">
                            <h1>Классическая скульптура</h1>
                            Цифровые копии с образцов мирвого искусства
                        </div>
                        <img class="img-fluid" src="{{asset('pun.png')}}" style="height: auto; max-width: 100%;" alt="">
                    </div>
                </div>
    @include('shop.layout.content')
@endsection


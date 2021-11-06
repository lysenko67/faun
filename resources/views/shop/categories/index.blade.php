@extends('shop.layout.main')

@section('title', $category)

@section('content')

    <div class="row">

        @include('shop.layout.sidebur')

        <div class="col-10">

            @include('shop.layout.breadcrumbs')

            <div class="row">

                <div class="home-image">
                    <div style="position: fixed; margin-bottom: 30px; width: 80%;">
                        <div id="titleClassic" style="position: absolute; left: 25px">
                            <h1 class="bronze">Анатомические пособия</h1>
                            <div style="width: 400px">В отличие от гипсовых изделий, наши учебные пособия отличаются необычайной лёгкостью
                                и прочностью.
                                Это очень удобно при переносе и постановке изделия. Скульптура может быть реализована в любом размере
                            и вы сможете легко её поднять даже при габаритах в человеческий рост.</div>
                        </div>
                        <img id="pun" class="img-fluid" src="{{asset('ecorche_houdon.png')}}"
                             style="height: auto; max-width: 100%;" alt="" width="1000">
                    </div>
                </div>

                @include('shop.layout.content')

            </div>

            <script src="{{asset('assets/shop/my-js/hide_img.js')}}"></script>
@endsection

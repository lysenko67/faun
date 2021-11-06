@extends('shop.layout.main')

@section('title', 'Ваш заказ №' . $id)

@section('content')
    <div class="row">

        @include('shop.layout.sidebur')

        <div class="col-10">

            @include('shop.layout.breadcrumbs')
            <p>На вашу почту отправленно письмо</p>
            <p>В ближайшее время с вами свяжется наш менеджер для подтверждения заказа и уточнения деталей.</p>
        </div>
    </div>
@endsection

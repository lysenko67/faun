@extends('shop.layout.main')

@section('title', 'Контакты')

@section('content')
<div class="row">

    @include('shop.layout.sidebur')

    <div class="col-10">

        @include('shop.layout.breadcrumbs')

        <div class="row" style="margin-top: 40px">
            <div class="col-6">
                @if($contact)
                <p>Телефон: &nbsp;&nbsp;<span class="fs-5">{{$contact->phone}}</span></p>
                <p>Email: &nbsp;&nbsp;<span class="fs-5">{{$contact->email}}</span></p>
                <p>Время работы: &nbsp;&nbsp;<span class="fs-5">{{$contact->working_hours}}</span></p>
                <p>Отправить сообщение:</p>
                @endif
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Ваше имя">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <textarea style="outline: none" class="textarea-control" name="text" id="" cols="30" rows="5" placeholder="Сообщение"></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary">Отправить</button>
                </form>

            </div>
        </div>

    </div>

</div>

@endsection
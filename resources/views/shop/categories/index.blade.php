@extends('shop.layout.main')

@section('title', $category->title)

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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            {!!\App\Services\Breadcrumbs\Breadcrumbs::render($category)!!}
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1>
                        {{$category->title}}
                    </h1>
                    <p>
                        «Если есть что хорошее в моём даровании, то это от того, что я родился в разрежённом воздухе
                        аретинской вашей земли, да и резцы, и молот, которыми я делаю свои статуи, я извлёк из молока
                        моей кормилицы»
                    </p>
                </div>

                @include('shop.layout.content')

            </div>

@endsection

<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href={{asset('assets/shop/my-css/my-style.css')}}>
    <title>@yield('title')</title>
</head>

<body id="body">

    <header id="header" class="fixed-top hide-block" style="background: white">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <a href="/">
                        <div style="position: relative;">
                            <h3 style=""><span style="color:#02ac02">f</span>aun</h3>
                            <div style="position: absolute; top: 25px; font-size: 12px; ">мастерcкая</div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <div class="input-group mb-2">

                        <span class="input-group-text search">
                            <a href="">
                                <svg class="MuiSvgIcon-root jss26 MuiSvgIcon-colorDisabled" focusable="false" width="24" fill="#BABABAFF" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                                    </path>
                                </svg>
                            </a>
                        </span>

                        <input id="search" type="text" class="form-control search-input" placeholder="поиск">
                        <ul id="dataSearch" class="dropdown-menu" style="width: 100%"></ul>

                    </div>
                    <div id="check-search">
                        <div class="form-check form-check-inline" style="margin: 0 0 10px 15px">
                            <input id="searchName" class="form-check-input" type="radio" name="inlineRadioOptions" data-id="title" checked>
                            <label class="form-check-label" for="inlineRadio1">По названию</label>
                        </div>
                        <div class="form-check form-check-inline" style="margin-left: 10px">
                            <input id="searchAuthor" class="form-check-input" type="radio" name="inlineRadioOptions" data-id="author">
                            <label class="form-check-label" for="inlineRadio2">По автору</label>
                        </div>
                        <hr>
                    </div>

                </div>

                <div class="col col-auto">
                    <div class="basket" style="padding-top: 10px">
                        <a href="{{route('cart.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#BABABAFF" width="28" height="28" viewBox="0 0 24 24">
                                <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                            </svg>
                            <div class="qty {{session()->get('result.qty') ? 'show-qty' : ''}}">
                                {{session()->get('result.qty') ? session()->get('result.qty') : 0}}
                            </div>
                        </a>
                    </div>

                </div>
            </div>
            <div class="row">
                <ul class="nav-header">
                    <li class="n-item">
                        <a class="n-link" href="/">Главная</a>
                    </li>
                    <li class="n-item">
                        <a class="n-link" href="{{route('about.index')}}">О нас</a>
                    </li>
                    <li class="n-item">
                        <a class="n-link" href="">Доставка</a>
                    </li>
                    <li class="n-item">
                        <a class="n-link" href="{{route('contact.index')}}">Контакты</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div id="content" class="container content">

        @yield('content')

    </div>

    <footer class="hide-block">
        <hr style="margin-top: 40px">
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    @if($contact)
                    <span class="contact">Телефон: &nbsp;&nbsp;{{$contact->phone}}</span>
                    <span class="contact">Email: &nbsp;&nbsp;{{$contact->email}}</span>
                    <span class="contact">Время работы: &nbsp;&nbsp;{{$contact->working_hours}}</span>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>
    <script>
        var myCarousel = document.querySelector('#carouselExampleControls')
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: false,
        })
    </script>

    <script src="{{asset('assets/shop/my-js/search.js')}}"></script>

    <script src="{{asset('assets/shop/my-js/add_product_to_basket.js')}}"></script>

    @yield('custom_js')

</body>

</html>
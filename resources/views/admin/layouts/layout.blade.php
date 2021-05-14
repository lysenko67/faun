<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" content="{{ csrf_token() }}">
    <title>AdminLTE 3 | Blank Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/my-css/admin.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('/')}}" target="_blank" class="brand-link">
            <span class="brand-text font-weight-light">На сайт</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('admin.index')}}" class="nav-link">
                            <i class="fas nav-icon fa-home"></i>
                            <p>Главная</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Категории
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('categories.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Список категорий</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('categories.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Новая категория</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Продукты
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('products.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Список продуктов</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('products.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Новый продукт</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="container">
            <div class="row">
                <div class="col-12 mt-2">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                {{session('error')}}
                            </ul>
                        </div>
                    @endif

                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <ul class="list-unstyled">
                                {{session('success')}}
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/js/adminlte.min.js')}}"></script>
{{--<!-- AdminLTE for demo purposes -->--}}
{{--<script src="../../dist/js/demo.js"></script>--}}
{{--<script>--}}
{{--    const input = document.getElementById('file')--}}
{{--    const forms = document.forms.my.elements--}}
{{--    const formData = new FormData()--}}
{{--    let num = {i: -1}--}}

{{--    document.getElementById('addFormData').addEventListener('click', (e) => {--}}
{{--        fetch('files', {--}}
{{--            method: "POST",--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': document.getElementById('token').getAttribute('content')--}}
{{--            },--}}
{{--            body: formsSerialize(forms)--}}
{{--        })--}}
{{--            .then(response => response.json())--}}
{{--            .then(res => {--}}
{{--                console.log(res)--}}
{{--                window.location.href = 'http://faun.loc/admin/products'--}}
{{--            })--}}
{{--            .catch(err => alert('Ошибка! Попробуйте ещё раз.'))--}}
{{--    })--}}

{{--    input.addEventListener('change', function (e) {--}}
{{--        num.i = num.i + 1--}}
{{--        console.log(num.i)--}}
{{--        const img = input.files[0]--}}
{{--        formData.append('files[' + num.i + ']', img)--}}
{{--        console.log(formData)--}}
{{--        handleFiles(img)--}}
{{--    })--}}

{{--    preview.addEventListener('click', function (e) {--}}
{{--        if (e.target.getAttribute('class') === 'img-close') {--}}
{{--            let id = e.target.getAttribute('id')--}}
{{--            console.log(id)--}}
{{--            let del = confirm("Удалить это фото?")--}}
{{--            if (del) {--}}
{{--                formData.delete('files[' + id + ']')--}}
{{--                preview.removeChild(e.target.parentNode);--}}
{{--            }--}}
{{--        }--}}
{{--    })--}}

{{--    function formsSerialize(forms) {--}}
{{--        for (let i = 0; i < forms.length; i++) {--}}
{{--            formData.append(forms[i].name, forms[i].value)--}}
{{--        }--}}
{{--        return formData--}}
{{--    }--}}

{{--    function handleFiles(file) {--}}
{{--        let div = document.createElement("div")--}}
{{--        div.classList.add("preview-img")--}}

{{--        let span = document.createElement("div")--}}
{{--        span.classList.add("img-close")--}}
{{--        span.innerHTML = 'del'--}}
{{--        span.id = num.i--}}

{{--        let img = document.createElement("img")--}}
{{--        img.style.width = '200px'--}}
{{--        img.file = file--}}

{{--        div.append(img)--}}
{{--        div.append(span)--}}
{{--        preview.appendChild(div)--}}

{{--        let reader = new FileReader()--}}
{{--        reader.onload = (function (aImg) {--}}
{{--            return function (e) {--}}
{{--                aImg.src = e.target.result--}}
{{--            };--}}
{{--        })(img);--}}
{{--        reader.readAsDataURL(file)--}}
{{--    }--}}
{{--</script>--}}
</body>
</html>

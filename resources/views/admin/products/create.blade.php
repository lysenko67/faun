@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Новый товар</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Новый продукт
                </h3>
            </div>
            <form role="form" method="post" name="my">
                {{--                @csrf--}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="author">Автор</label>
                        <input type="text" class="form-control" name="author" placeholder="Автор">
                    </div>

                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Название">
                    </div>

                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5" placeholder="Цитата ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Категория</label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach($categories as $k => $v)
                                <option value="{{$k}}">{{$v}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Цена</label>
                        <input type="number" class="form-control @error('title') is-invalid @enderror" name="price" placeholder="0">
                    </div>

                    <div class="form-group">
                        <label for="files">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file">
                                <label class="custom-file-label" for="files">Загрузить картинку</label>
                            </div>
                        </div>
                    </div>
                    <div id="preview" class="row"></div>
                </div>
                <!-- /.card-body -->
            </form>

            <div class="card-footer">
                <button class="btn btn-primary" id="addFormData">Сохранить</button>
            </div>
        </div>
        <!-- /.card -->

{{--        <script>--}}

{{--            const input = document.getElementById('file')--}}
{{--            const forms = document.forms.my.elements--}}
{{--            console.log(document.querySelector('.img-close'))--}}
{{--            if(document.querySelector('.img-close').hasAttribute('product')) {--}}
{{--                const url = document.location.protocol+'//'+document.location.host+'/admin/products/files/'+document.querySelector('.img-close').getAttribute('product')--}}
{{--            } else {--}}
{{--                const url =  document.location.protocol+'//'+document.location.host+'/admin/products/create'--}}
{{--            }--}}

{{--            console.log(url)--}}
{{--            const formData = new FormData()--}}
{{--            formData.append('_method', 'PUT')--}}
{{--            let num = {i: -1}--}}

{{--            document.getElementById('addFormData').addEventListener('click', (e) => {--}}

{{--                fetch(url, {--}}
{{--                    method: "POST",--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN': document.getElementById('token').getAttribute('content')--}}
{{--                    },--}}
{{--                    body: formsSerialize(forms)--}}
{{--                })--}}
{{--                    .then(response => response.json())--}}
{{--                    .then(res => {--}}
{{--                        window.location.href = 'http://faun.loc/admin/products'--}}
{{--                    })--}}
{{--                    .catch(err => alert('Ошибка! Попробуйте ещё раз.'))--}}
{{--            })--}}

{{--            input.addEventListener('change', function (e) {--}}
{{--                num.i = num.i + 1--}}
{{--                console.log(num.i)--}}
{{--                const img = input.files[0]--}}
{{--                formData.append('files[' + num.i + ']', img)--}}
{{--                handleFiles(img)--}}
{{--            })--}}

{{--            preview.addEventListener('click', function (e) {--}}
{{--                if (e.target.getAttribute('class') === 'img-close') {--}}
{{--                    if(e.target.getAttribute('data') === 'img_name') {--}}
{{--                        formData.append('img_name', e.target.previousElementSibling.getAttribute('src').split('/').pop())--}}
{{--                        fetch(url, {--}}
{{--                            method: "POST",--}}
{{--                            headers: {--}}
{{--                                'X-CSRF-TOKEN': document.getElementById('token').getAttribute('content')--}}
{{--                            },--}}
{{--                            body: formData--}}
{{--                        })--}}
{{--                            .then(response => response.json())--}}
{{--                            .then(res => {--}}
{{--                                formData.delete('img_name')--}}
{{--                            })--}}
{{--                            .catch(err => alert('Ошибка! Попробуйте ещё раз.'))--}}
{{--                    }--}}
{{--                    let id = e.target.getAttribute('id')--}}
{{--                    let del = confirm("Удалить это фото?")--}}
{{--                    if (del) {--}}
{{--                        formData.delete('files[' + id + ']')--}}
{{--                        preview.removeChild(e.target.parentNode);--}}
{{--                    }--}}
{{--                }--}}
{{--            })--}}

{{--            function formsSerialize(forms) {--}}
{{--                for (let i = 0; i < forms.length; i++) {--}}
{{--                    formData.append(forms[i].name, forms[i].value)--}}
{{--                }--}}
{{--                return formData--}}
{{--            }--}}

{{--            function handleFiles(file) {--}}
{{--                let div = document.createElement("div")--}}
{{--                div.classList.add("preview-img")--}}

{{--                let span = document.createElement("div")--}}
{{--                span.classList.add("img-close")--}}
{{--                span.innerHTML = 'del'--}}
{{--                span.id = num.i--}}

{{--                let img = document.createElement("img")--}}
{{--                img.style.width = '200px'--}}
{{--                img.file = file--}}

{{--                div.append(img)--}}
{{--                div.append(span)--}}
{{--                preview.appendChild(div)--}}

{{--                let reader = new FileReader()--}}
{{--                reader.onload = (function (aImg) {--}}
{{--                    return function (e) {--}}
{{--                        aImg.src = e.target.result--}}
{{--                    };--}}
{{--                })(img);--}}
{{--                reader.readAsDataURL(file)--}}
{{--            }--}}
{{--        </script>--}}

        <script>

            const input = document.getElementById('file')
            const forms = document.forms.my.elements
            const formData = new FormData()
            let num = {i: -1}

            document.getElementById('addFormData').addEventListener('click', (e) => {
                fetch('files', {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.getElementById('token').getAttribute('content')
                    },
                    body: formsSerialize(forms)
                })
                    .then(response => response.json())
                    .then(res => {
                        console.log(res)
                        window.location.href = 'http://faun.loc/admin/products'
                    })
                    .catch(err => alert('Ошибка! Попробуйте ещё раз.'))
            })

            input.addEventListener('change', function (e) {
                num.i = num.i + 1
                console.log(num.i)
                const img = input.files[0]
                formData.append('files[' + num.i + ']', img)
                console.log(formData)
                handleFiles(img)
            })

            preview.addEventListener('click', function (e) {
                if (e.target.getAttribute('class') === 'img-close') {
                    let id = e.target.getAttribute('id')
                    console.log(id)
                    let del = confirm("Удалить это фото?")
                    if (del) {
                        formData.delete('files[' + id + ']')
                        preview.removeChild(e.target.parentNode);
                    }
                }
            })

            function formsSerialize(forms) {
                for (let i = 0; i < forms.length; i++) {
                    formData.append(forms[i].name, forms[i].value)
                }
                return formData
            }

            function handleFiles(file) {
                let div = document.createElement("div")
                div.classList.add("preview-img")

                let span = document.createElement("div")
                span.classList.add("img-close")
                span.innerHTML = 'del'
                span.id = num.i

                let img = document.createElement("img")
                img.style.width = '200px'
                img.file = file

                div.append(img)
                div.append(span)
                preview.appendChild(div)

                let reader = new FileReader()
                reader.onload = (function (aImg) {
                    return function (e) {
                        aImg.src = e.target.result
                    };
                })(img);
                reader.readAsDataURL(file)
            }
        </script>
    </section>
    <!-- /.content -->
@endsection

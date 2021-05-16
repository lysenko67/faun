(function () {
    const input = document.getElementById('file')
    const forms = document.forms.my.elements
    const formData = new FormData()

    const getUrl = () => {
        if (document.querySelector('#preview').hasAttribute('product')) {
            formData.append('_method', 'PUT')
            return document.location.protocol + '//' + document.location.host + '/admin/products/files/' + document.querySelector('#preview').getAttribute('product')
        } else {
            return document.location.protocol + '//' + document.location.host + '/admin/products/files'
        }
    }

    let num = {i: -1}

    document.getElementById('addFormData').addEventListener('click', (e) => {
        fetch(getUrl(), {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': document.getElementById('token').getAttribute('content')
            },
            body: formsSerialize(forms)
        })
            .then(response => response.json())
            .then(res => {
                window.location.href = 'http://faun.loc/admin/products'
            })
            .catch(err => alert('Ошибка! Попробуйте ещё раз.'))
    })

    input.addEventListener('change', function (e) {
        num.i = num.i + 1
        console.log(num.i)
        const img = input.files[0]
        formData.append('files[' + num.i + ']', img)
        handleFiles(img)
    })

    preview.addEventListener('click', function (e) {
        if (e.target.getAttribute('class') === 'img-close') {
            if (e.target.getAttribute('data') === 'img_name') {
                formData.append('img_name', e.target.previousElementSibling.getAttribute('src').split('/').pop())
                fetch(getUrl(), {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.getElementById('token').getAttribute('content')
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(res => {
                        formData.delete('img_name')
                    })
                    .catch(err => alert('Ошибка! Попробуйте ещё раз.'))
            }
            let id = e.target.getAttribute('id')
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
})()


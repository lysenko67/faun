(function () {
    document.addEventListener('click', (event) => {

        const url = document.location.protocol + '//' + document.location.host
        const csrf = document.getElementById('token').getAttribute('content')
        const search = document.getElementById('search')
        const dataSearch = document.getElementById('dataSearch')
        const checkSearch = document.getElementById('check-search')
        let checked = ''

        if (event.target.id === 'search' || event.target.id === 'searchName' || event.target.id === 'searchAuthor') {
            checkSearch.style.display = 'block'
            const allCheckInput = document.querySelectorAll('.form-check-input')
            allCheckInput.forEach((elem) => {
                if(elem.checked) {
                    checked = elem.getAttribute('data-id')
                }
            })
        } else {
            dataSearch.style.display = 'none'
            checkSearch.style.display = 'none'
            search.value = ''
        }

        search.addEventListener('input', (event) => {
            let text = search.value

            if (text.length > 3) {
                fetchSearch(text, checked)
            } else if (text.length < 3) {
                dataSearch.style.display = 'none'
            } else if (event.data == null) {
                fetchSearch(text, checked)
            }
        })

        function fetchSearch(text, checked) {
            fetch(url + '/search', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({'text': text, 'checked': checked})
            })
                .then(response => response.json())
                .then(res => {
                    let html = ''
                    dataSearch.style.display = 'block'
                    if (res.length > 0) {
                        res.forEach(item => {
                            html += `<li>
                                        <a class="dropdown-item" href=${url}/${item.category_slug}/${item.slug}>
                                            <img src=${item.images[0].image} alt="" width="70" height="70">
                                            <span style="margin-left: 20px">${item.title}</span>
                                        </a>
                                    </li>`
                        })
                        dataSearch.innerHTML = html
                    } else {
                        dataSearch.innerHTML = '<p style="margin-left: 20px">Ничего не найдено...</p>'
                    }
                })
        }
    })

})()

const myModal = new bootstrap.Modal(document.getElementById('myModal'))
const addToCart = document.querySelectorAll('.add-to-cart')
const delQty = document.querySelectorAll('.del-qty')
const qty = document.querySelector('.qty')
const qtyProduct = document.querySelectorAll('.qty-product')
const priceProduct = document.querySelectorAll('.price-product')
const priceSum = document.querySelector('.price-sum')
const csrf = document.getElementById('token').getAttribute('content')
const deleteProduct = document.querySelectorAll('.delete-product')

addToCart.forEach(elem => {
    elem.addEventListener('click', function (e) {
        if(myModal._element) {
            let modalShow = document.getElementById('myModal').classList.contains('show')
        }

        let id = e.target.getAttribute('data-id')
        let price = document.getElementById('price').textContent
        let heightSm = document.getElementById('heightSm').value
        const payload = {'id': id, 'price': price, 'heightSm': heightSm}

        postCart(
            payload,
            qty,
            qtyProduct,
            priceSum,
            myModal,
            modalShow=null,
            url='/cart',
            method='POST',
            csrf
        )
    })
})

delQty.forEach(elem => {
    elem.addEventListener('click', function (e) {
        let id = e.target.getAttribute('data-id')
        let price = document.getElementById('price').textContent
        let heightSm = document.getElementById('heightSm').value
        const payload = {'id': id, 'price': price, 'heightSm': heightSm}
        postCart(payload, qty, qtyProduct, priceSum, myModal, modalShow=null, url='/cart/'+id, method='PUT', csrf)
    })
})

deleteProduct.forEach(elem => {
    elem.addEventListener('click', function(e) {
        const id = e.target.getAttribute('data-id')
        const collection = e.target.parentNode.parentNode.parentNode
        let text = []
        for(let node of collection.childNodes) {
            for(let child of node.childNodes) {
                if(child.textContent.match(/[0-9]/)) {
                    text.push(child.textContent)
                }
            }
        }
        fetch('/cart/'+id+'/'+text[1]+'/'+text[2], {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrf
            },
        })
            .then(response => response.json())
            .then(res => {
                qty.textContent = res.result['qty']
                priceSum.textContent = res.result['sum']

                elem.parentNode.parentNode.parentNode.remove()
                if(res.cart.length < 1) {
                        document.getElementById('order').remove()
                        basket.insertAdjacentHTML('afterend', '<h5>Ваша корзина пуста :(</h5>')
                    }
                })
    })
})



function postCart(payload, qty, qtyProduct, priceSum, myModal, modalShow, url, method, csrf) {
    if (payload) {
        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({'payload': payload})
        })
            .then(response => response.json())
            .then(res => {
                qty.textContent = res.qty
                priceSum.textContent = res.result

                qtyProduct.forEach((elem, index) => {
                    if(qtyProduct[index].getAttribute('data-id') == payload.id) {
                        if(res.qty_product < 1) {
                            if(res.qty == 0) {
                                document.getElementById('order').remove()
                                basket.insertAdjacentHTML('afterend', '<h5>Ваша корзина пуста :(</h5>')
                                return
                            }
                            elem.parentNode.parentNode.remove()
                            return
                        }
                        elem.textContent = res.qty_product
                    }
                })

                priceProduct.forEach((elem, index) => {
                    if(priceProduct[index].getAttribute('data-id-price') == id) {
                        elem.textContent = res.price
                        elem.nextElementSibling.value = res.price
                        elem.nextElementSibling.nextElementSibling.value = res.qty_product
                    }
                })
                if(myModal._element) {
                    myModal.show()
                }
            })
            .catch(err => alert('Ошибка! Попробуйте ещё раз.'))
    }
}

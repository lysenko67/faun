const myModal = new bootstrap.Modal(document.getElementById('myModal'))
const addToCart = document.querySelectorAll('.add-to-cart')
const delQty = document.querySelectorAll('.del-qty')
const qty = document.querySelector('.qty')
const qtyProduct = document.querySelectorAll('.qty-product')
const priceProduct = document.querySelectorAll('.price-product')
const priceSum = document.querySelector('.price-sum')
const csrf = document.getElementById('token').getAttribute('content')

addToCart.forEach(elem => {
    elem.addEventListener('click', function (e) {
        if(myModal._element) {
            let modalShow = document.getElementById('myModal').classList.contains('show')
        }
        let id = e.target.getAttribute('data-id')
        postCart(id, qty, qtyProduct, priceSum, myModal, modalShow=null, url='/cart', method='POST', csrf)
    })
})

delQty.forEach(elem => {
    elem.addEventListener('click', function (e) {
        let id = e.target.getAttribute('data-id')
        postCart(id, qty, qtyProduct, priceSum, myModal, modalShow=null, url='/cart/'+id, method='DELETE', csrf)
    })
})

function postCart(id, qty, qtyProduct, priceSum, myModal, modalShow, url, method, csrf) {
    if (id) {
        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({'id': id})
        })
            .then(response => response.json())
            .then(res => {
                qty.textContent = res.qty
                priceSum.textContent = res.result

                qtyProduct.forEach((elem, index) => {
                    if(qtyProduct[index].getAttribute('data-id') == id) {
                        if(res.qty_product < 1) {
                            if(res.qty == 0) {
                                document.getElementById('order').remove()
                                basket.insertAdjacentHTML('afterend', '<h3>Моя корзина</h3><h5>Ваша корзина пуста :(</h5>')
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
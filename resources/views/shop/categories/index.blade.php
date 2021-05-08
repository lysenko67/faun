@extends('shop.layout.main')

@section('title', $category->title)

@section('content')
    <div class="row">

        @include('shop.layout.sidebur')

        <div class="col-10">
            <div class="row">
                @foreach($products as $key => $product)
                    <p>{{$product->title}}</p>
                    @if(count($product->images) > 0)
                        <div class="card" style="width: 18rem; margin: 20px">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->category['title']}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Подзаголовок карты</h6>
                                <a href="{{route('category.index', $product->category['slug'])}}">

                                    <img src="/images/{{$product->images[$key]['img']}}" alt="" width="240">

                                </a>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of
                                    the card's content.</p>
                                <p class="card-text">{{$product->price}} руб.</p>
                                <a href="" data-id="{{$product->id}}" class="btn btn-success add-to-cart">Добавить в
                                    корзину</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            {{$products->links()}}
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        document.querySelector('.add-to-cart').addEventListener('click', function (e) {
            e.preventDefault()
            let id = e.target.getAttribute('data-id')
            fetch('cart', {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.getElementById('token').getAttribute('content')
                },
                body: JSON.stringify({'id': id})
            })
                .then(response => response.json())
                .then(res => {
                    const qty = document.querySelector('.qty')
                    qty.classList.add('show-qty')
                    qty.textContent = res
                    console.log(document.querySelector('.qty'))
                 })
                .catch(err => alert('Ошибка! Попробуйте ещё раз.'))
        })

    </script>
@endsection

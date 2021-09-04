</div>

<div class="row" style="position: relative">
    @foreach($products as $key => $product)
        <div class="card-product" style="z-index: 100">
            <a href="{{route('product.index', [$product->category->slug, 'slug' => $product->slug])}}">
                <img src="{{asset($product->images[0]->img ? 'storage/images/'.$product->id.'/'.$product->images[0]->img : '')}}" alt=""
                     style="width: 100%">
                <div class="img-title">
                    <p>{{$product->title}}</p>
                </div>
                <div class="card-price">
                    {{$product->price}}&#8381;
                </div>
            </a>
        </div>

    @endforeach
    <div style="width: 100%; height: 100%; position: absolute; bottom: 0px; background: white; z-index: 0"></div>
</div>
{{$products->links()}}
</div>

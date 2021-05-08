<div class="col-2">
    <ul class="nav flex-column">
        @foreach($categories as $category)
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"
                   href="{{route('category.index', $category->slug)}}">{{$category->title}}</a>
            </li>
        @endforeach
    </ul>
</div>



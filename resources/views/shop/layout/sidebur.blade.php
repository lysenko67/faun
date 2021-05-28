<div class="col-2 my-sidebar">
    <ul class="nav flex-column" style="position: fixed">
        @foreach($categories as $category)
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"
                   href="{{route('category.index', $category->slug)}}">{{$category->title}}</a>
            </li>
        @endforeach
    </ul>
</div>



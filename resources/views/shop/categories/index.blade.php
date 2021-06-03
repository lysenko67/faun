@extends('shop.layout.main')

@section('title', $category->title)

@section('content')

    <div class="row">

        @include('shop.layout.sidebur')

        <div class="col-10">

            @include('shop.layout.breadcrumbs')

            <div class="row">

                @include('shop.layout.content')

            </div>

@endsection

@extends('layouts.front')
@section('title','Товары')
@section('content')
    <div class="container mt-5">
        <!-- <h1>Категория: {{ $category->name }}</h1> -->

        <h1>Категории</h1>
        @include('components.category', ['categories' => $categories])
        
        @if($category->products->isNotEmpty())
        <div class="b-example-divider"></div>
        <h2>Список товаров категории</h2>
            @foreach ($category->products as $product)
            <div class="card mb-4">
                <div class="card-header">
                    <h2><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h2>
                    <p>Цена: {{ $product->price }} руб.</p>
                </div>
                <div class="card-body">
                    <p class="card-text">{!! $product->description !!}</p>
                    <hr>
                    <h5>Категория:</h5>
                    <p>{{ $product->category->name }}</p>
                </div>
            </div>
            @endforeach
        @else
        <div class="fw-semibold fst-italic text-info fs-3 mt-3">В этой категории пока нет товаров.</div>
        @endif
    </div>

@endsection

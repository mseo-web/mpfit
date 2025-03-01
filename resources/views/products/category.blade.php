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
        <div class="mt-5 row">
            @foreach($category->products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h3>
                            <h4> - {{ $product->price }} руб.</h4>
                            <p>Опубликовано: {{ $product->created_at }}</p>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! $product->description !!}</p>
                            <hr>
                            <h5>Категории:</h5>
                            <ul>
                                <li>{{ $product->category->name }}</li>
                            </ul>
                            <form action="{{ route('orders.create') }}" method="GET">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit">Заказать</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @else
        <div class="fw-semibold fst-italic text-info fs-3 mt-3">В этой категории пока нет товаров.</div>
        @endif
    </div>

@endsection

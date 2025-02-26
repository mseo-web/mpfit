@extends('layouts.front')
@section('title','Товары')
@section('content')
    <!-- <h1>Товары</h1>
    <ul>
        @foreach($products as $product)
            <li>
                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a> - {{ $product->price }} руб.
                <form action="{{ route('orders.create') }}" method="GET">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit">Заказать</button>
                </form>
            </li>
        @endforeach
    </ul> -->

    <div class="container mt-5">
        <h1>Категории</h1>
        @include('components.category', ['categories' => $categories])

        <div class="b-example-divider"></div>

        <h1 class="mt-3">Список товаров</h1>
        <div class="mt-5 row">
            @foreach($products as $product)
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
    </div>
@endsection

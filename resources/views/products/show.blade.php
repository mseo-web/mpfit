@extends('layouts.front')
@section('title','Товары')
@section('content')

<div class="container mt-5">
    <div class="">
        <div class="card mb-4">
            <div class="card-header">
                <h2>{{ $product->name }} - {{ $product->price }} руб.</h2>
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
    <div class="mt-2">
        <a href="{{ route('products.index') }}">Вернуться к списку товаров</a>
    </div>
</div>
@endsection

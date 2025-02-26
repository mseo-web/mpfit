@extends('layouts.front')
@section('title','Заказы')
@section('content')

    <div class="container mt-5">
        <h1>Создание заказа</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="customer_name">ФИО покупателя*</label>
                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                    id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                @error('customer_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label>Товар</label>
                <div class="form-control">
                    {{ $product->name }} ({{ number_format($product->price, 2) }} ₽)
                </div>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
            </div>

            <div class="form-group mb-3">
                <label for="quantity">Количество*</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                    id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" required>
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="comment">Комментарий</label>
                <textarea class="form-control @error('comment') is-invalid @enderror" 
                    id="comment" name="comment" rows="3">{{ old('comment') }}</textarea>
                @error('comment')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <strong>Итоговая сумма: <span id="total-price">{{ number_format($product->price, 2) }}</span> ₽</strong>
            </div>

            <button type="submit" class="btn btn-primary">Создать заказ</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const totalPriceSpan = document.getElementById('total-price');
            const productPrice = {{ $product->price }};

            function updateTotalPrice() {
                const quantity = parseInt(quantityInput.value) || 0;
                const total = productPrice * quantity;
                totalPriceSpan.textContent = total.toFixed(2);
            }

            quantityInput.addEventListener('input', updateTotalPrice);
        });
    </script>

@endsection

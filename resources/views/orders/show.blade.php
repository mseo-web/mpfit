@extends('layouts.front')
@section('title','Заказы')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Заказ #{{ $order->id }}</h2>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>ФИО покупателя:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Дата создания:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
                    <p><strong>Статус заказа:</strong> {{ $order->status === 'new' ? 'Новый' : 'Выполнен' }}</p>
                    <p><strong>Товар:</strong> {{ $order->product->name }}</p>
                    <p><strong>Количество:</strong> {{ $order->quantity }}</p>
                    <p><strong>Итоговая цена:</strong> {{ number_format($order->product->price * $order->quantity, 2) }} ₽</p>
                    @if($order->comment)
                        <p><strong>Комментарий:</strong> {{ $order->comment }}</p>
                    @endif
                </div>
            </div>

            @if($order->status === 'new')
                <form action="{{ route('orders.complete', $order) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Отметить как выполненный</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection

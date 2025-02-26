<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        return view('orders.create', compact('product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string',
        ]);

        $order = new Order();
        $order->customer_name = $validated['customer_name'];
        $order->product_id = $validated['product_id'];
        $order->quantity = $validated['quantity'];
        $order->comment = $validated['comment'];
        $order->status = 'new';
        $order->created_at = now();
        $order->save();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Заказ успешно создан');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function complete(Order $order)
    {
        $order->status = 'completed';
        $order->save();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Статус заказа успешно изменен на "Выполнен"');
    }
}

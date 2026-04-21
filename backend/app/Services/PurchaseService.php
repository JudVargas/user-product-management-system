<?php

namespace App\Services;
use App\Models\Product;
use App\Models\Orders as Order;
use App\Models\Orders_items as OrderItem;
use Illuminate\Support\Facades\DB;


class PurchaseService
{
    public function purchase($user, $data){

    return DB::transaction(function () use ($user, $data) {
        $total = 0;
        $products = [];

        foreach ($data['items'] as $item) {
            // Bloquear el producto para evitar condiciones de carrera
            $product = Product::lockForUpdate()->findOrFail($item['product_id']);
            if ($product->stock < $item['quantity']) {
                throw new \Exception("Producto {$product->name} no tiene suficiente stock.");
            }

            $total += $product->price * $item['quantity'];

            $products[] = [
                'model' => $product,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ];
        }

        // Crear orden
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
        ]);

        foreach ($products as $product) {
            // Crear item de orden
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product['model']->id,
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);

            // Actualizar stock
            $product['model']->decrement('stock', $product['quantity']);
        }
        return $order->load('items.product');
    });
    }
}
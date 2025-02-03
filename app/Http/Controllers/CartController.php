<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(string $id, int $quantity)
    {
        $product = Product::find($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = ['name' => $product->name, 'quantity' => $quantity, 'price' => $product->price];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(0, (int)$request->input('quantity'));
            if($cart[$id]['quantity'] < 1) {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Quantidade atualizada com sucesso.');
        }

        return redirect()->route('cart.index')->with('error', 'Produto não encontrado no carrinho.');
    }

   


    public function remove(string $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produto removido com sucesso');
    }

}

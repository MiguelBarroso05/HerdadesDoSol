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
            $cart[$id]['quantity'] = max(0, (int)$request->input('quantity')); // Evita valores negativos
            if($cart[$id]['quantity'] < 1) {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Quantidade atualizada com sucesso.');
        }

        return redirect()->route('cart.index')->with('error', 'Produto não encontrado no carrinho.');
    }

    public function index()
    {

        $totalPrice = 0;

        $cart = session()->get('cart');
        foreach ($cart as $item) {
            $totalPrice += $item['quantity'] * $item['price'];
        }
        return view('cart.index', compact('cart', 'totalPrice'));
    }


    /**
     * A estratégia implementada é usar sempre as variáveis de sessão.
     * O utilizador quando faz logout é guardado em BD o carrinho
     * Quando o utilizador faz login é efetuado o merge para a variável de sessão
     *
     */
   

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

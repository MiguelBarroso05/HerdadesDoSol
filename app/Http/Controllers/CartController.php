<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(string $id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = ['name' => $product->name, 'quantity' => 1, 'price' => $product->price];
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
    public function merge()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cartSession = session()->get('cart', []);
            $cartDB = Cart::where('user_id', $userId)->get();
            foreach ($cartDB as $item) {
                if (isset($cartSession[$item->id])) {
                    //Se já existe em sessão o item
                    $cartSession[$item->id]['quantity'] += $item->quantity;
                } else {
                    $cartSession[$item->id] = [
                        'name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                    ];
                }

            }
            //Apagar os registo que estvam guardados na BD
            session()->put('cart', $cartSession);
            Cart::where('user_id', $userId)->delete();
        }
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

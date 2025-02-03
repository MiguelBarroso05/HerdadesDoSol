<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{

    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
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
            //dd(session()->get('cart'));
            Cart::where('user_id', $userId)->delete();
        }
    }

}

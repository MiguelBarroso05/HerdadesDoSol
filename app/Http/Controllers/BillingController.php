<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillingRequest;
use App\Models\Billing;
use App\Models\user\User;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function storePersonalInfo(User $user){
        Billing::updateOrCreate(['user_id' => $user->id], [
            'name' => $user->name,
            'nif' => $user->nif,
            'phone' => $user->phone,
            'email' => $user->email,
        ]);

        return redirect()->route('payment-methods');
    }
}

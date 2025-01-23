<?php

namespace App\Livewire;

use App\Http\Requests\user\UserRequest;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewBillingModal extends Component
{
    public $modalIdName;
    public $user;

    public $nif;
    public $name;
    public $email;
    public $phone;

    public $redirectUrl;

    protected $rules = [
        'name' => 'required|string|max:255',
        'nif' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ];

    public function submit()
    {
        $this->validate();

        $user_id = auth()->id();

        DB::table('billings')->insert([
            'user_id' => $user_id,
            'name' => $this->name,
            'nif' => $this->nif,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);
        session()->flash('message', 'Billing information submitted successfully.');
        return redirect()->to($this->redirectUrl);
        $this->reset();
    }


    public function render()
    {
        return view('livewire.new-billing-modal');
    }
}

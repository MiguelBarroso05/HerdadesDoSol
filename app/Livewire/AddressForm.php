<?php

namespace App\Livewire;

use App\Http\Requests\AddressRequest;
use App\Models\user\Address;
use App\Models\user\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class AddressForm extends Component
{
    public $addressIdentifier;
    public $addressPhone;
    public $address = [
        'country' => '',
        'city' => '',
        'street' => '',
        'zipcode' => '',
    ];

    public $user;
    public $modalIdName;
    public $redirectUrl;

    public function mount(User $user, $modalIdName)
    {
        $this->user = $user;
        $this->modalIdName = $modalIdName;
    }

    public function submit()
    {
        // Cria uma instância do AddressRequest
        $request = new AddressRequest();

        // Valida os dados com as regras e mensagens do AddressRequest
        $this->validate(
            $request->rules(),      // Regras de validação
            $request->messages()    // Mensagens personalizadas
        );

        try {
            $validated = [
                'addressIdentifier' => $this->addressIdentifier,
                'addressPhone' => $this->addressPhone,
                'address' => $this->address,
            ];

            // Verifique se o endereço já existe
            $existentAddress = Address::where('country', $validated['address']['country'])
                ->where('city', $validated['address']['city'])
                ->where('street', $validated['address']['street'])
                ->where('zipcode', $validated['address']['zipcode'])
                ->first();

            $this->user->addresses()->detach($this->addressId);

            if ($existentAddress) {
                $this->user->addresses()->attach($existentAddress->id, [
                    'addressPhone' => $validated['addressPhone'],
                    'addressIdentifier' => $validated['addressIdentifier'],
                ]);
            } else {
                $newAddress = Address::create($validated['address']);
                $newAddressId = $newAddress->id;
                $this->user->addresses()->attach($newAddressId, [
                    'addressPhone' => $validated['addressPhone'],
                    'addressIdentifier' => $validated['addressIdentifier'],
                ]);
            }

            session()->flash('success', 'Address successfully created!');
            return redirect()->to($this->redirectUrl);
            $this->resetForm();

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating address: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->addressIdentifier = '';
        $this->addressPhone = '';
        $this->address = [
            'country' => '',
            'city' => '',
            'street' => '',
            'zipcode' => '',
        ];
    }

    public function render()
    {
        return view('livewire.address-form');
    }
}

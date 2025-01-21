<?php

namespace App\Livewire;

use App\Http\Requests\AddressRequest;
use App\Models\user\Address;
use App\Models\user\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditAddressForm extends Component
{
    public $user;
    public $address = [
        'country' => '',
        'city' => '',
        'street' => '',
        'zipcode' => '',
    ];
    public $addressIdentifier;
    public $addressPhone;
    public $addressId;
    public $redirectUrl;

    public function mount($user, $address, $redirectUrl)
    {
        $this->user = $user;
        $this->address = [
            'country' => $address->country,
            'city' => $address->city,
            'street' => $address->street,
            'zipcode' => $address->zipcode,
        ];
        $this->addressId = $address->id;
        $this->addressIdentifier = $address->pivot->addressIdentifier;
        $this->addressPhone = $address->pivot->addressPhone;
        $this->redirectUrl = $redirectUrl;
    }

    public function submit()
    {
        $request = new AddressRequest();

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
            $existentAddress = DB::table('addresses')
                ->where('country', $validated['address']['country'])
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
                $newAddressId = DB::table('addresses')->insertGetId($validated['address']);
                $this->user->addresses()->attach($newAddressId, [
                    'addressPhone' => $validated['addressPhone'],
                    'addressIdentifier' => $validated['addressIdentifier'],
                ]);
            }

            session()->flash('success', 'Address successfully updated!');
            return redirect()->to($this->redirectUrl);
            $this->resetForm();

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating address: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.edit-address-form');
    }
}

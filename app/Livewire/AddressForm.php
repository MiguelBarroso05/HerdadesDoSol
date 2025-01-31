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
    public $lastOrder;
    public $countries;

    public function mount(User $user, $modalIdName)
    {
        $this->user = $user;
        $this->modalIdName = $modalIdName;
        $this->lastOrder = $this->user->addresses()->orderByPivot('order', 'desc')->first()->pivot->order ?? 0;

        try {
            $response = Http::get('https://restcountries.com/v2/all?fields=flag&fields=name');
            $this->countries = $response->json();
            $this->countries = Arr::sort($this->countries);

        } catch (\Exception $e) {
            $this->countries = ['No countries loaded'];
        }
    }

    public function submit()
    {
        $request = new AddressRequest();

        $this->validate(
            $request->rules(),
            $request->messages()
        );

        try {
            $validated = [
                'addressIdentifier' => $this->addressIdentifier,
                'addressPhone' => $this->addressPhone,
                'address' => $this->address,
            ];

            $existentAddress = Address::where('country', $validated['address']['country'])
                ->where('city', $validated['address']['city'])
                ->where('street', $validated['address']['street'])
                ->where('zipcode', $validated['address']['zipcode'])
                ->first();

            if ($existentAddress) {
                if ($this->user->addresses()->where('address_id', $existentAddress->id)->exists()) {
                    $this->user->addresses()->updateExistingPivot($existentAddress->id, [
                        'addressPhone' => $validated['addressPhone'],
                        'addressIdentifier' => $validated['addressIdentifier'],
                        'order' => $this->lastOrder + 1,
                    ]);
                } else {
                    $this->user->addresses()->attach($existentAddress->id, [
                        'addressPhone' => $validated['addressPhone'],
                        'addressIdentifier' => $validated['addressIdentifier'],
                        'order' => $this->lastOrder + 1,
                    ]);
                }
            } else {
                $newAddress = Address::create($validated['address']);
                $newAddressId = $newAddress->id;

                $this->user->addresses()->attach($newAddressId, [
                    'addressPhone' => $validated['addressPhone'],
                    'addressIdentifier' => $validated['addressIdentifier'],
                    'order' => $this->lastOrder + 1,
                ]);
            }

            session()->flash('success', 'Address successfully created!');
            return redirect()->to($this->redirectUrl);
            $this->reset();

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating address: ' . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.address-form');
    }
}

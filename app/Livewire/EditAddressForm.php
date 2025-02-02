<?php

namespace App\Livewire;

use App\Http\Requests\AddressRequest;
use App\Models\user\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class EditAddressForm extends Component
{
    public $user;
    public $address;
    public $addressIdentifier;
    public $addressPhone;
    public $addressId;
    public $addressOrder;
    public $countries;


    public function mount(User $user)
    {
        $this->user = $user;
        $this->addressId = $this->address->id;
        $this->addressIdentifier = $this->address->pivot->addressIdentifier;
        $this->addressPhone = $this->address->pivot->addressPhone;
        $this->addressOrder = $this->address->pivot->order ?? 1;

        $this->address = [
            'country' => $this->address->country ?? '',
            'city' => $this->address->city ?? '',
            'street' => $this->address->street ?? '',
            'zipcode' => $this->address->zipcode ?? '',
        ];

        try {
            $response = Http::get('https://restcountries.com/v2/all?fields=flag&fields=name');
            $this->countries = $response->json();
            $this->countries = Arr::sort($this->countries);

        } catch (\Exception $e) {
            $this->countries = ['Failed to retrieve countries'];
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

            $currentPivot = $this->user->addresses()->where('address_id', $this->addressId)->first();
            $currentOrder = $currentPivot->pivot->order ?? 1;

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
                    'order' => $currentOrder,
                ]);
            } else {
                $newAddressId = DB::table('addresses')->insertGetId($validated['address']);
                $this->user->addresses()->attach($newAddressId, [
                    'addressPhone' => $validated['addressPhone'],
                    'addressIdentifier' => $validated['addressIdentifier'],
                    'order' => $currentOrder,
                ]);
            }

            session()->flash('success', 'Address successfully updated!');
            return redirect()->to(route('personal-info'));
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

<?php

namespace App\Livewire;

use App\Http\Requests\BillingRequest;
use App\Models\Billing;
use App\Models\user\Address;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class BillingNewAddressInfoModal extends Component
{
    public $modalIdName;
    public $user;
    public $country;
    public $city;
    public $zipcode;
    public $street;

    public $countries;
    public $billingAddressId;

    public function mount(){
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
        $billingRequest = new BillingRequest();
        $rules = $billingRequest->rulesFor('address-info');
        $messages = $billingRequest->messages();

        $this->validate($rules, $messages);
        $user_id = $this->user->id;

        $address = Address::where('country', $this->country)
            ->where('city', $this->city)
            ->where('street', $this->street)
            ->where('zipcode', $this->zipcode)
            ->first();

        if ($address) {
            Billing::updateOrCreate(['user_id' => $user_id], [
                'address_id' => $address->id,
            ]);
        }
        else{
            $newAddress = Address::create([
                'country' => $this->country,
                'city' => $this->city,
                'street' => $this->street,
                'zipcode' => $this->zipcode,
            ]);

            Billing::updateOrCreate(['user_id' => $user_id], [
                'address_id' => $newAddress->id,
            ]);
        }

        session()->flash('message', 'Billing information submitted successfully.');
        $this->redirectRoute('payment-methods');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.billing-new-address-info-modal');
    }
}

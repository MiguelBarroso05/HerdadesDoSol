<?php

namespace App\Livewire;

use App\Http\Requests\BillingRequest;
use App\Models\Billing;
use App\Models\user\Address;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class EditBillingInfoModal extends Component
{

    public $openChooseAddressModal;
    public $userBillingInfo;
    public $usePersonalInfo;
    public $useAddressInfo;

    public $name;
    public $email;
    public $phone;
    public $nif;

    public $billingAddress;
    public $userAddress;
    public $countries;

    public $country;
    public $city;
    public $zipcode;
    public $street;


    public function mount()
    {
        $this->userBillingInfo = Billing::where('user_id', auth()->id())->first();
        if (!$this->userBillingInfo) {
            return;
        }

        $this->billingAddress = Address::where('id', $this->userBillingInfo->address_id)->first() ?? null;

        $this->userAddress = auth()->user()->addresses->first() ?? null;
        $this->usePersonalInfo = false;

        if ($this->userBillingInfo && $this->userBillingInfo->name) {
            $this->name = $this->userBillingInfo->name;
            $this->email = $this->userBillingInfo->email;
            $this->phone = $this->userBillingInfo->phone;
            $this->nif = $this->userBillingInfo->nif;
        }
        if ($this->userBillingInfo && $this->userBillingInfo->address_id) {
            $this->country = $this->billingAddress->country;
            $this->city = $this->billingAddress->city;
            $this->zipcode = $this->billingAddress->zipcode;
            $this->street = $this->billingAddress->street;
        }

        try {
            $response = Http::get('https://restcountries.com/v2/all?fields=flag&fields=name');
            $this->countries = $response->json();
            $this->countries = Arr::sort($this->countries);

        } catch (\Exception $e) {
            $this->countries = ['Failed to retrieve countries'];
        }
    }

    public function UsePersonalInfoButton()
    {
        $this->usePersonalInfo = true;
    }

    public function UseBillingPersonalInfoButton()
    {
        $this->usePersonalInfo = false;
    }

    public function UseAddressInfoButton()
    {
        $this->useAddressInfo = true;
    }

    public function UseBillingAddressInfoButton()
    {
        $this->useAddressInfo = false;
    }

    public function deletePersonalInfo()
    {
        $this->userBillingInfo->update([
            'name' => null,
            'phone' => null,
            'nif' => null,
            'email' => null,
        ]);
        $this->redirectRoute('payment-methods');
    }

    public function deleteAddressInfo()
    {
        $this->userBillingInfo->update([
            'address_id' => null,
        ]);
        $this->redirectRoute('payment-methods');
    }

    public function submit()
    {
        $billingRequest = new BillingRequest();
        $personalInfoRules = $billingRequest->rulesFor('personal-info');
        $addressInfoRules = $billingRequest->rulesFor('address-info');
        $messages = $billingRequest->messages();

        if ($this->userBillingInfo->name) {
            if ($this->usePersonalInfo) {
                $this->userBillingInfo->fill([
                    'name' => auth()->user()->firstname . ' ' . auth()->user()->lastname,
                    'phone' => auth()->user()->phone,
                    'nif' => auth()->user()->nif,
                    'email' => auth()->user()->email,
                ]);
            } else {
                $this->validate($personalInfoRules, $messages);

                try {
                    $validated = [
                        'name' => $this->name,
                        'phone' => $this->phone,
                        'nif' => $this->nif,
                        'email' => $this->email,
                    ];

                    $this->userBillingInfo->fill([
                        'name' => $validated['name'],
                        'phone' => $validated['phone'],
                        'nif' => $validated['nif'],
                        'email' => $validated['email'],
                    ]);

                } catch (\Exception $e) {
                    session()->flash('error', 'Error updating billing: ' . $e->getMessage());
                }
            }
        }
        if ($this->userBillingInfo->address_id) {
            if ($this->useAddressInfo) {
                $this->userBillingInfo->fill([
                    'country' => $this->userAddress->country,
                    'city' => $this->userAddress->phone,
                    'zipcode' => $this->userAddress->nif,
                    'street' => $this->userAddress->email,
                ]);
            } else {
                $this->validate($addressInfoRules, $messages);

                try {
                    $address = Address::where('country', $this->country)
                        ->where('city', $this->city)
                        ->where('zipcode', $this->zipcode)
                        ->where('street', $this->street)
                        ->first();

                    if ($address) {
                        $this->userBillingInfo->update([
                            'address_id' => $address->id,
                        ]);
                    } else {
                        $newAddress = Address::create([
                            'country' => $this->country,
                            'city' => $this->city,
                            'zipcode' => $this->zipcode,
                            'street' => $this->street,
                        ]);

                        $this->userBillingInfo->update([
                            'address_id' => $newAddress->id,
                        ]);
                    }

                } catch (\Exception $e) {
                    session()->flash('error', 'Error updating billing: ' . $e->getMessage());
                }
            }
        }
        $this->userBillingInfo->save();
        $this->redirectRoute('payment-methods');
    }

    public function render()
    {
        return view('livewire.edit-billing-info-modal');
    }
}

<?php

namespace App\Livewire;

use App\Http\Requests\BillingRequest;
use App\Models\Billing;
use Livewire\Attributes\On;
use Livewire\Component;

class EditBillingInfoModal extends Component
{
    public $userBillingInfo;
    public $usePersonalInfo;
    public $name;
    public $email;
    public $phone;
    public $nif;
    public $address_id;


    public function mount(){
        $this->userBillingInfo = Billing::where('user_id', auth()->id())->first();
        $this->usePersonalInfo = false;

        if($this->userBillingInfo){
            $this->name = $this->userBillingInfo->name;
            $this->email = $this->userBillingInfo->email;
            $this->phone = $this->userBillingInfo->phone;
            $this->nif = $this->userBillingInfo->nif;
        }
    }

    public function UsePersonalInfoButton(){
        $this->usePersonalInfo = true;
    }

    public function UseBillingPersonalInfoButton(){
        $this->usePersonalInfo = false;
    }

    public function deletePersonalInfo(){
        $this->userBillingInfo->update([
            'name' => null,
            'phone' => null,
            'nif' => null,
            'email' => null,
        ]);
    }

    public function submit(){
        $billingRequest = new BillingRequest();
        $personalInfoRules = $billingRequest->rulesFor('personal-info');
        $addressRules = $billingRequest->rulesFor('address-info');
        $messages = $billingRequest->messages();

        if ($this->userBillingInfo->name != null){
            if($this->usePersonalInfo){
                $this->userBillingInfo->fill([
                    'name' => auth()->user()->firstname . ' ' . auth()->user()->lastname,
                    'phone' => auth()->user()->phone,
                    'nif' => auth()->user()->nif,
                    'email' => auth()->user()->email,
                ]);
            }
            else{
                $this->validate($personalInfoRules, $messages);

                try{
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

                }catch (\Exception $e) {
                    session()->flash('error', 'Error updating billing: ' . $e->getMessage());
                }
            }
        }
        $this->userBillingInfo->save();
        $this->redirectRoute('payment-methods');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.edit-billing-info-modal');
    }
}

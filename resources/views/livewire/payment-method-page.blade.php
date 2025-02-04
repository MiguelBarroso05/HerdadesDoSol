<main class="hs-col-md-11 hs-w-85 hs-align-self-center hs-mt-8 hs-p-2 hs-flex-grow-1">
    <div class="hs-d-flex hs-justify-content-between">
        <x-client-side-bar/>
        <div style="width: 1280px; display: flex;" class="hs-bg-card hs-rounded-3 hs-m-0">
            <div style="width: 320px;"
                 class="hs-bg-custom-light hs-border hs-h-100 hs-rounded-3 hs-m-0 hs-p-0 ">
                <div class="hs-p-4 hs-ml-5">
                    <div class="hs-text-black hs-fs-5 hs-fw-bold hs-pb-1">
                        Payment Method
                    </div>
                    <div class="hs-text-card-pm">
                        Cards and Billing
                    </div>
                </div>
                <div class="hs-border-custom-black hs-w-100"></div>
                @foreach($paymentMethods as $card)
                    <div
                        class="w-[240px] h-[94px] hs-rounded-3 hs-m-3 flex flex-col justify-around place-self-center bg-[#EEEEEE] hs-cursor-pointer {{ $selectedCard && $selectedCard->id === $card->id ? 'hs-card-selected' : '' }}"
                        wire:click="selectCard({{ $card->id }})">

                        <div class="flex flex-row items-center w-full">
                            <div class="hs-col-md-5 px-2">
                                <div
                                    class="w-[90px] h-[55px] bg-gradient-to-r from-orange-500 to-orange-700 text-white p-2 rounded shadow-lg flex flex-col justify-between">
                                    <span class="text-[5px] uppercase">{{$card->name}}</span>
                                    <img class="w-[15px] h-auto"
                                         src="{{asset('/imgs/pages/creditCardChip.png')}}"
                                         alt="creditCardChip"/>
                                    <div class="text-[5px]">
                                        <span>**** **** **** {{$card->last4}}</span>
                                    </div>
                                    <div class="flex justify-between text-[5px]">
                                        <span class="content-center">**/**</span>
                                        <img class="w-[15px] h-auto"
                                             src="{{asset($card->type->img) ?? null}}"
                                             alt="{{$card->type->name}}Logo">
                                    </div>
                                </div>
                            </div>

                            <div class="hs-col-md-7 px-2">
                                <p class="m-0 text-sm">{{ $card->identifier ?? 'Card' }}</p>
                                <p class="m-0 text-xs">Card ending in {{ $card->last4 }}</p>
                            </div>
                        </div>

                        @if($card->predefined == 1)
                            <div class="hs-row w-full px-2 pb-1">
                                <span class="text-xs font-bold">Predefined Payment Method <i class="bi bi-check"></i></span>
                            </div>
                        @endif
                    </div>
                @endforeach
                @if($paymentMethods->count() < 5)
                    <div class="hs-dashed-box hs-m-4 hs-rounded-3 hs-cursor-pointer"
                         data-bs-toggle="modal"
                         data-bs-target="#createPaymentMethodModal">
                        <i class="bi bi-plus-circle hs-box-icon"></i>
                    </div>
                @endif
            </div>

            <div class="hs-p-4 hs-w-md-100">
                <div class="hs-p-4">
                    <div class="hs-d-flex hs-justify-content-between">
                        <p>BILLING INFORMATION</p>
                        @if($userBillingInfo && ($userBillingInfo->name || $userBillingInfo->address_id))
                            <a id="openEditBillingInfoModal" class="mx-2"><i
                                    class="bi bi-pencil-square hs-fs-5"
                                    style="color: #2B6EFF; cursor: pointer"></i></a>
                        @endif
                    </div>
                    @if($userBillingInfo && $userBillingInfo->name != null)
                        <div id="personal-billing-info">
                            <div>
                                <div class="hs-row">
                                    <div class="hs-col-md-6">
                                        <p>
                                            <strong>Name: </strong> {{ limit_word($userBillingInfo->name, 30, true) }}
                                        </p>
                                    </div>
                                    <div class="hs-col-md-4">
                                        <p><strong>NIF: </strong> {{$userBillingInfo->nif ?? 'none'}}</p>
                                    </div>
                                </div>
                                <div class="hs-row">
                                    <div class="hs-col-md-6">
                                        <p><strong>Email: </strong> {{$userBillingInfo->email}}</p>
                                    </div>
                                    <div class="hs-col-md-4">
                                        <p><strong>Phone: </strong> {{$userBillingInfo->phone ?? 'none'}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else()
                        <div class="hs-text-black hs-icon-text-container" id="billing-info">No client
                            information
                            provided for biling
                            <x-plus-button onclick="toggleComponents()"/>
                        </div>
                        <div class="hs-justify-content-between" style="width: 450px; display: none;"
                             id="payment-methods">
                            <livewire:billing-personal-info id="defaultPersonalInfo"
                                                            text="Use your personal information"
                                                            icon="bi bi-arrow-right-circle hs-payment-button-icon hs-mr-custom-15"
                                                            :user="auth()->user()"/>
                            <x-payment-method-button modalToOpen="#newPersonalInfoForm"
                                                     text="Create new billing information"
                                                     icon="bi bi-plus-circle hs-payment-button-icon hs-mr-custom-15"/>
                        </div>
                    @endif
                    <div class="hs-py-4">
                        <p>ADDRESS INFORMATION</p>
                        @if($userBillingInfo && $userBillingInfo->address_id)
                            <div id="address-billing-info">
                                <div class="hs-row">
                                    <div class="hs-col-md-6">
                                        <p><strong>Country: </strong> {{$userBillingInfo->address->country}}</p>
                                    </div>
                                    <div class="hs-col-md-6">
                                        <p><strong>City: </strong> {{$userBillingInfo->address->city}}</p>
                                    </div>
                                </div>
                                <div class="hs-row">
                                    <div class="hs-col-md-6">
                                        <p><strong>Zipcode: </strong> {{$userBillingInfo->address->zipcode}}</p>
                                    </div>
                                    <div class="hs-col-md-6">
                                        <p><strong>Street: </strong> {{$userBillingInfo->address->street}}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="hs-text-black hs-icon-text-container" id="billing1-info">No address
                                information
                                defined
                                <x-plus-button onclick="toggleComponents1()"/>
                            </div>
                            <div class="hs-justify-content-between" style="width: 450px; display: none;"
                                 id="payment1-methods">
                                @if(auth()->user()->addresses->count() == 1)
                                    <livewire:billing-address-info id="defaultAddressInfo"
                                                                   text="Use your address information"
                                                                   icon="bi bi-arrow-right-circle hs-payment-button-icon hs-mr-custom-15"
                                                                   :user="auth()->user()"/>
                                @elseif(auth()->user()->addresses->count() > 1)
                                    <x-payment-method-button modalToOpen="#chooseExistentAddress"
                                                             text="Choose one of your addresses"
                                                             icon="bi bi-arrow-right-circle hs-payment-button-icon hs-mr-custom-15"/>
                                @endif
                                <x-payment-method-button modalToOpen="#newAddressInfoForm"
                                                         text="Create new address information"
                                                         icon="bi bi-plus-circle hs-payment-button-icon hs-mr-custom-15"/>
                            </div>
                        @endif
                    </div>
                    <div class="hs-py-4 hs-mt-2">
                        <div class="flex justify-between">
                            <p>PAYMENT INFORMATION</p>
                            @if($selectedCard)
                                <button class="cursor-pointer" wire:click="deleteCard({{ $selectedCard->id }})"
                                        style="border: none; background-color: transparent">
                                    <i class="bi bi-trash fs-5" style="color: red"></i>
                                </button>
                            @endif
                        </div>

                        @if($paymentMethods->isEmpty())
                            <div class="hs-text-black hs-icon-text-container">
                                No payment method defined, consider inserting a method to facilitate payment
                            </div>
                        @elseif($selectedCard)
                            <div class="flex">
                                <div class="hs-row hs-col-md-8">
                                    <div class="hs-row">
                                        <div class="hs-col-md-6">
                                            <p><strong>Number: </strong> **** **** **** {{$selectedCard->last4}}</p>
                                        </div>
                                        <div class="hs-col-md-6">
                                            <p><strong>Name: </strong> {{$selectedCard->name}}</p>
                                        </div>
                                    </div>
                                    <div class="hs-row">
                                        <div class="hs-col-md-6">
                                            <p><strong>Expiration Date: </strong> **/**</p>
                                        </div>
                                        <div class="hs-col-md-6">
                                            <p class="flex"><strong>Method </strong>
                                                <img class="w-[50px] h-auto"
                                                     src="{{asset($selectedCard->type->img) ?? null}}"
                                                     alt="{{$selectedCard->type->name}}Logo">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hs-row">
                                        <div class="hs-col-md-6">
                                            <p class="m-0"><strong>Predefined Payment Method </strong></p>
                                            <div wire:poll>
                                            <span wire:click="PredefinedCard({{ $selectedCard->id }})"
                                                  id="cardPredefined{{$selectedCard->id}}"
                                                  class="cursor-pointer">
                                                @if($selectedCard->predefined)
                                                    <i class="bi bi-toggle-on hs-fs-3"></i>
                                                @else
                                                    <i class="bi bi-toggle-off hs-fs-3"></i>
                                                @endif
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hs-row hs-col-md-4">
                                    <div class="flex flex-col items-center gap-4">
                                        <div
                                            class="w-80 h-48 bg-gradient-to-r from-orange-500 to-orange-700 text-white p-6 rounded-xl shadow-lg flex flex-col justify-between">
                                            <span class="text-lg uppercase">{{$selectedCard->name}}</span>
                                            <img class="w-[40px] h-auto"
                                                 src="{{asset('/imgs/pages/creditCardChip.png')}}"
                                                 alt="creditCardChip"/>
                                            <div class="text-lg font-mono tracking-widest">
                                                <span>**** **** **** {{$selectedCard->last4}}</span>
                                            </div>
                                            <div class="flex justify-between text-sm">
                                                <span class="content-center">**/**</span>
                                                <img class="w-[70px] h-auto"
                                                     src="{{asset($selectedCard->type->img) ?? null}}"
                                                     alt="{{$selectedCard->type->name}}Logo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="hs-text-black hs-icon-text-container">
                                Click on a card to view details
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <livewire:create-payment-method-modal :modalIdName="'createPaymentMethodModal'"/>
        <livewire:billing-new-personal-info-modal :modalIdName="'newPersonalInfoForm'" :user="auth()->user()"/>
        <livewire:billing-new-address-info-modal :modalIdName="'newAddressInfoForm'" :user="auth()->user()"/>
        <livewire:choose-existent-address :user="auth()->user()"/>
        <livewire:edit-billing-info-modal/>
    </div>
</main>

@push('js')
    <script>
        function toggleComponents() {
            const billingInfo = document.getElementById('billing-info') || document.getElementById('billing1-info');
            const paymentMethods = document.getElementById('payment-methods') || document.getElementById('payment1-methods');
            const plusButton = event.target.parentElement;

            if (paymentMethods.style.display === "none") {
                paymentMethods.style.display = "flex";
                billingInfo.style.display = "none";
            } else {
                paymentMethods.style.display = "none";
                billingInfo.style.display = "block";
                plusButton.style.display = "block";
            }
        }

        function toggleComponents1() {
            const billingInfo = document.getElementById('billing1-info');
            const paymentMethods = document.getElementById('payment1-methods');
            const plusButton = event.target.parentElement;

            if (paymentMethods.style.display === "none") {
                paymentMethods.style.display = "flex";
                billingInfo.style.display = "none";
            } else {
                paymentMethods.style.display = "none";
                billingInfo.style.display = "block";
                plusButton.style.display = "block";
            }
        }

        document.getElementById('openEditBillingInfoModal').addEventListener('click', function () {
            let editBillingModal = new bootstrap.Modal(document.getElementById('editBillingInfoModal'));
            editBillingModal.show();
        });


        document.getElementById('openChooseAddressModal').addEventListener('click', function () {
            let chooseAddressModal = new bootstrap.Modal(document.getElementById('chooseExistentAddress'));

            let editBillingElement = document.getElementById('editBillingInfoModal');
            let editBillingModal = bootstrap.Modal.getInstance(editBillingElement);

            if (editBillingModal) {
                editBillingModal.hide();
            }
            chooseAddressModal.show();
        });

        document.getElementById('closeButton').addEventListener('click', function () {

            let prevModalElement = document.getElementById('editBillingInfoModal');
            let prevModal = bootstrap.Modal.getInstance(prevModalElement) || new bootstrap.Modal(prevModalElement);

            let actualElement = document.getElementById('chooseExistentAddress');
            let actualModal = bootstrap.Modal.getInstance(actualElement);

            if (actualModal) {
                actualModal.hide();
            }

            prevModal.show();
        });
    </script>
@endpush


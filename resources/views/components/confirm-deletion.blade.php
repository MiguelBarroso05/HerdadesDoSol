<div class="modal fade" id="{{ $modalId  }}" tabindex="-1"
     @if ($errors->any()) style="display: block;" @endif>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="hs-col-10 hs-align-self-center">
                <div class="modal-body">
                    <h5 class="modal-title hs-align-self-center hs-text-uppercase" style="color: black !important; font-size: 20px;"
                        id="exampleModalLabel">{{ $title }}</h5>
                    <div class="hs-py-4">
                        <span style="font-size: 15px">{{ $message }}</span>
                    </div>
                    <div class="hs-d-flex hs-justify-content-between">
                        <div class="hs-d-flex">
                            <form action="{{ $route }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hs-btn hs-btn-sm ms-auto"
                                        style="border: 1px solid black;">
                                    Confirm
                                </button>
                            </form>
                        </div>
                        <div class="hs-d-flex">
                            <button type="button" id="cancelButton{{$modalId}}" class="hs-btn hs-btn-sm hs-ms-auto"
                                    style="border: 1px solid black;">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        document.getElementById('cancelButton{{$modalId}}').addEventListener('click', function () {

            let prevModalElement = document.getElementById('{{ $prevModalId }}');
            let prevModal = bootstrap.Modal.getInstance(prevModalElement) || new bootstrap.Modal(prevModalElement);

            let deletionModalElement = document.getElementById('{{ $modalId }}');
            let deletionModal = bootstrap.Modal.getInstance(deletionModalElement);

            if (deletionModal) {
                deletionModal.hide();
            }

            prevModal.show();
        });

    </script>
@endpush

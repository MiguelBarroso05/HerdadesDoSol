<div class="modal fade" id="addressModal{{ $address->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Country:</strong> {{ $address->country }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>City:</strong> {{ $address->city }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Street:</strong> {{ $address->street }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Zipcode:</strong> {{ $address->zipcode }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Address Phone:</strong> {{ $address->pivot->addressPhone ?? 'none' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Address Identifier:</strong> {{ $address->pivot->addressIdentifier ?? 'none' }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{ route('users.destroyUserAddress', ['user' => $user, 'address' => $address]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary btn-sm ms-auto bg-gradient-danger">
                        Delete Address
                    </button>
                </form>
                <button type="button" class="btn btn-secondary btn-sm ms-auto bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<div id="{{$id}}" class="billing-dashed-box rounded-3" style="cursor: pointer;">
    <span class="payment-button-text">{{$text}} </span>
    <i class="{{$icon}}"></i>
</div>

@push('js')
    <script>
        document.getElementById('{{$id}}').addEventListener('click', function () {
            let modal = new bootstrap.Modal(document.getElementById('AlterarDepois'));
            modal.show();
        });
    </script>
@endpush



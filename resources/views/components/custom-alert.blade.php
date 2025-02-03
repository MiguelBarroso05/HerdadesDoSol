@if($type == 'warning')
    @if($session)
        <div id="warning-alert" class="h-[100px] w-[300px] flex flex-col justify-between mt-2 bg-[#ffa602] text-sm text-black rounded-lg p-4 dark:bg-white dark:text-neutral-800 fixed bottom-0 right-0 mb-4 mr-4" role="alert" tabindex="-1" aria-labelledby="hs-solid-color-dark-label">
            <div class="flex">
                <i class="bi bi-exclamation-triangle hs-fs-5 pe-2"></i>
                <strong>Warning!</strong>
            </div>
            <div>
                <p class="text-base">{{ $session }}</p>
            </div>
        </div>
    @endif
@endif

@if($type == 'success')
    @if($session)
        <div id="success-alert" class="h-[100px] w-[300px] flex flex-col justify-between mt-2 bg-[#18864f] text-sm text-black rounded-lg p-4 dark:bg-white dark:text-neutral-800 fixed bottom-0 right-0 mb-4 mr-4" role="alert" tabindex="-1" aria-labelledby="hs-solid-color-dark-label">
            <div class="flex">
                <i class="bi bi-check-square hs-fs-5 pe-2"></i>
                <strong>Success!</strong>
            </div>
            <div>
                <p class="text-base">{{ $session }}</p>
            </div>
        </div>
    @endif
@endif

@if($type == 'error')
    @if($session)
        <div id="error-alert" class="h-[100px] w-[300px] flex flex-col justify-between mt-2 bg-[#ba1236] text-sm text-black rounded-lg p-4 dark:bg-white dark:text-neutral-800 fixed bottom-0 right-0 mb-4 mr-4" role="alert" tabindex="-1" aria-labelledby="hs-solid-color-dark-label">
            <div class="flex">
                <i class="bi bi-exclamation-circle hs-fs-5 pe-2"></i>
                <strong>Error!</strong>
            </div>
            <div>
                <p class="text-base">$session</p>
            </div>
        </div>
    @endif
@endif

@push('js')
    <script>
        <!-- Script to auto-hide the message -->
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('success-alert') || document.getElementById('warning-alert') || document.getElementById('error-alert');

            if (alert) {
                setTimeout(() => {
                    alert.classList.remove('hs-show');
                    alert.classList.add('hs-fade');
                    setTimeout(() => {
                        alert.remove();
                    }, 300); // Fade-out animation
                }, 3000); // 3 seconds
            }
        });
    </script>
@endpush

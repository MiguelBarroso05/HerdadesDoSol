@if(session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show " role="alert">
        <strong>Success!</strong> {{ session('success') }}
    </div>
@endif
<script>
    <!-- Script to auto-hide the message -->
    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('success-alert') || document.getElementById('warning-alert');

        if (alert) {
            setTimeout(() => {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => {
                    alert.remove();
                }, 300); // Fade-out animation
            }, 3000); // 3 seconds
        }
    });
</script>

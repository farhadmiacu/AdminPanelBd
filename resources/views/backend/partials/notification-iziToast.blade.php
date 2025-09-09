<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ session('success') }}',
                position: 'topRight',
                timeout: 5000,
                backgroundColor: '#405189',
                color: '#ffffff',
                iconColor: '#ffffff',
                theme: 'dark'
            });
        @endif

        @if (session('error'))
            iziToast.error({
                title: 'Error',
                message: '{{ session('error') }}',
                position: 'topRight',
                timeout: 5000
            });
        @endif

        @if (session('warning'))
            iziToast.warning({
                title: 'Warning',
                message: '{{ session('warning') }}',
                position: 'topRight',
                timeout: 5000
            });
        @endif

        @if (session('info'))
            iziToast.info({
                title: 'Info',
                message: '{{ session('info') }}',
                position: 'topRight',
                timeout: 5000
            });
        @endif
    });
</script>

{{-- SweetAlert2 Notifications --}}
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            // title: 'Success',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            // title: 'Error',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    @endif

    @if (session('warning'))
        Swal.fire({
            icon: 'warning',
            // title: 'Warning',
            text: '{{ session('warning') }}',
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    @endif

    @if (session('info'))
        Swal.fire({
            icon: 'info',
            // title: 'Info',
            text: '{{ session('info') }}',
            timer: 3000,
            showConfirmButton: false,
            position: 'top-end',
            toast: true
        });
    @endif
</script>
{{-- SweetAlert2 Notifications --}}

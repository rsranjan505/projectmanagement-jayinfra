<script>
      $(function() {
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });

        @if(Session::has('success'))
            // toastr.success("{{ Session::get('success') }}");
            Toast.fire({
            icon: 'success',
            title: '{{ Session::get('success') }}'
        })
        @endif

        // info message popup notification
        @if(Session::has('info'))
            // toastr.info("{{ Session::get('info') }}");
            Toast.fire({
            icon: 'info',
            title: '{{ Session::get('info') }}'
        })
        @endif

        // warning message popup notification
        @if(Session::has('warning'))
            // toastr.warning("{{ Session::get('warning') }}");
            Toast.fire({
            icon: 'warning',
            title: '{{ Session::get('warning') }}'
        })
        @endif

        // error message popup notification
        @if(Session::has('error'))
            // toastr.error("{{ Session::get('error') }}");
            Toast.fire({
            icon: 'error',
            title: '{{ Session::get('error') }}'
        })
        @endif

    });
</script>

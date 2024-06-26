<!DOCTYPE html>
<html>
<head>
    <title>Unauthorized</title>
</head>
<style>
    body {
        text-align: center;
    }
    h1, a {
        display: block;
        margin: 20px 0;
    }
</style>
<body>
    <img src="assets/media/auth/warning.png" alt="Warning" style="display: block; margin: 0 auto; width: 10%;">
    <h1>Anda tidak mempunyai kebenaran untuk mengakses halaman ini</h1>
    <a href="{{ url('/') }}">Kembali ke halaman utama.</a>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // @if(session('error'))
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Ralat',
        //         text: ' {!! session('error') !!}',
        //         confirmButtonText: 'OK'
        //     });
        // @endif
    </script>
</body>
</html>
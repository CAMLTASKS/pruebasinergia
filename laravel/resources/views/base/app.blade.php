<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sinergia')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }
        main {
            min-height: calc(100vh - 120px);
            padding: 2rem 1rem;
        }
        footer {
            background-color: #0d6efd;
            color: #fff;
            text-align: center;
            padding: 1rem;
            margin-top: auto;
        }
    </style>
</head>
<body>

    @include('encabezado_pie.header')

    <main class="container-fluid fade-in">
        @yield('content')
    </main>

    @include('encabezado_pie.footer')

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const token = localStorage.getItem('token');
        if (!token) window.location.href = '/login';
    });
    </script>

    <script>
        // Animación suave
        document.addEventListener('DOMContentLoaded', () => {
            const main = document.querySelector('main');
            main.classList.add('fade-in');
        });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', () => {
  const token = localStorage.getItem('token');

  if (!token) {
    window.location.href = '/login';
    return;
  }

  const logoutBtn = document.getElementById('btnLogout');
  if (logoutBtn) {
    logoutBtn.addEventListener('click', () => {
      if (confirm('¿Seguro que deseas cerrar sesión?')) {
        localStorage.removeItem('token');
        window.location.href = '/login';
      }
    });
  }
});
</script>
</body>
</html>

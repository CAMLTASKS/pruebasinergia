<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - Sinergia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #007bff, #004aad);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card {
      width: 100%;
      max-width: 400px;
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    .logo {
      font-size: 1.8rem;
      font-weight: bold;
      color: #004aad;
    }
  </style>
</head>
<body>
  <div class="card p-4">
    <div class="text-center mb-4">
      <div class="logo mb-2">Tecnologias Sinergia</div>
      <h5 class="text-muted">Iniciar Sesión</h5>
    </div>

    <form id="loginForm">
      <div class="mb-3">
        <label class="form-label">Correo electrónico</label>
        <input type="email" id="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" id="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>

      <p class="text-center small">
        ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
      </p>

      <div id="msg" class="text-center small"></div>
    </form>
  </div>

  <script>
    const apiBase = 'http://localhost:8080/api/';
    document.addEventListener('DOMContentLoaded', () => {
      if (localStorage.getItem('token')) window.location.href = '/';
    });

    document.getElementById('loginForm').addEventListener('submit', async e => {
      e.preventDefault();
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      const msg = document.getElementById('msg');
      msg.textContent = 'Verificando credenciales...';
      try {
        const res = await fetch(`${apiBase}login`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ email, password })
        });
        const data = await res.json();
        if (res.ok && data.token) {
          localStorage.setItem('token', data.token);
          msg.textContent = '✅ Inicio de sesión exitoso. Redirigiendo...';
          setTimeout(() => window.location.href = '/', 1000);
        } else {
          msg.textContent = '❌ Credenciales inválidas.';
        }
      } catch (err) {
        msg.textContent = '⚠️ Error de conexión.';
      }
    });
  </script>
</body>
</html>

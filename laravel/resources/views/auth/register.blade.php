<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - Sinergia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #004aad, #007bff);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card {
      width: 100%;
      max-width: 420px;
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
      <div class="logo mb-2">tecnologias Sinergia</div>
      <h5 class="text-muted">Registro de Usuario</h5>
    </div>

    <form id="registerForm">
      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" id="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Correo electrónico</label>
        <input type="email" id="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" id="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success w-100 mb-3">Registrar</button>

      <p class="text-center small">
        ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
      </p>

      <div id="msg" class="text-center small"></div>
    </form>
  </div>

  <script>
    const apiBase = 'http://localhost:8080/api/';
    document.getElementById('registerForm').addEventListener('submit', async e => {
      e.preventDefault();
      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      const msg = document.getElementById('msg');
      msg.textContent = 'Creando usuario...';
      try {
        const res = await fetch(`${apiBase}register`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ name, email, password })
        });
        const data = await res.json();
        if (res.ok && data.token) {
          localStorage.setItem('token', data.token);
          msg.textContent = '✅ Registro exitoso. Redirigiendo...';
          setTimeout(() => window.location.href = '/', 1000);
        } else {
          msg.textContent = '❌ Error al registrar usuario.';
        }
      } catch (err) {
        msg.textContent = '⚠️ Error de conexión.';
      }
    });
  </script>
</body>
</html>

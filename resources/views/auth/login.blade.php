<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Diagnóstico</title>
    <link rel="icon" href="{{ asset('img/icono.PNG') }}" type="image/PNG">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url("{{ asset('img/fincav.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-container {
            width: 100%;
            max-width: 340px;
            padding: 30px 30px;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .brand-icon {
            font-size: 42px;
            color: #0ea5e9;
            margin-bottom: 15px;
        }

        .brand-image {
            max-width: 100px;
            height: auto;
            margin-bottom: 10px;
        }


        .main-title {
            font-family: 'Cinzel', serif;
            font-size: 24px;
            font-weight: 700;
            color: #16a34a; /* Verde un poco más oscuro al hacer hover */            
            margin-bottom: 5px;
        }

        .company-name {
            font-size: 18px;
            font-weight: 600;
            color: #475569;
        }

        .company-group {
            font-size: 16px;
            font-weight: 500;
            color: #64748b;
        }

        .form-label {
            color: #334155;
            font-weight: 600;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #64748b;
        }

        .input-with-icon {
            padding-left: 35px;
        }

        .btn-primary {
            background-color: #16a34a; /* Verde un poco más oscuro al hacer hover */ /* verde */
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.75rem;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color:rgb(57, 218, 116); /* Verde un poco más oscuro al hacer hover */ /* verde más oscuro */
            box-shadow: 0 4px 10px rgba(34, 197, 94, 0.3);
        }


        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #dcfce7;
            border-color: #86efac;
            color: #166534;
        }

        .alert-danger {
            background-color: #fee2e2;
            border-color: #fca5a5;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header text-center">
    <img src="{{ asset('img/logo.png') }}" alt="Logo de la empresa" class="brand-image mb-2" style="width: 80px; height: auto;">
    <h2 class="main-title">Sistema de Diagnóstico</h2>
    <h3 class="company-name">Clasificadora y Exportadora de Tabaco S.A</h3>
    <p class="company-group">Grupo Plasencia</p>
</div>


        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Usuario</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-user-circle"></i></span>
                    <input type="text" id="nombre" name="nombre" class="form-control input-with-icon" required placeholder="Ingrese su nombre de usuario">
                </div>
            </div>


            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="recordarUsuario">
                <label class="form-check-label" for="recordarUsuario" style="font-weight: bold;">Recuérdame</label>
            </div>



            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control input-with-icon" required placeholder="Ingrese su contraseña">
                    <span class="toggle-password" onclick="togglePassword()">
                        <i id="togglePasswordIcon" class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
    </div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.getElementById("togglePasswordIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }

    // Recordar usuario con localStorage
    document.addEventListener('DOMContentLoaded', function () {
        const usuarioInput = document.getElementById("nombre");
        const checkbox = document.getElementById("recordarUsuario");

        // Al cargar, verificar si ya hay un usuario guardado
        const savedUser = localStorage.getItem("usuarioRecordado");
        if (savedUser) {
            usuarioInput.value = savedUser;
            checkbox.checked = true;
        }

        // Cuando se cambia el estado del checkbox
        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                localStorage.setItem("usuarioRecordado", usuarioInput.value);
            } else {
                localStorage.removeItem("usuarioRecordado");
            }
        });

        // Actualiza el valor almacenado si se escribe uno nuevo
        usuarioInput.addEventListener('input', function () {
            if (checkbox.checked) {
                localStorage.setItem("usuarioRecordado", usuarioInput.value);
            }
        });
    });
</script>

</body>
</html>

@extends('layouts.app')

@section('titulo', 'Menú')

@section('contenido')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/icono.PNG') }}" type="image/PNG">

    <!-- Bootstrap y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>

            body {
                 background: url("{{ asset('img/Flogin.webp') }}") no-repeat center center fixed;
                 background-size: cover;
                 transition: background-image 1s ease-in-out;
   
            }

        /* Imagen con animación suave. */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('img/Flogin.webp') }}') no-repeat center center fixed;
            background-size: cover;
            transform: scale(1.05);
            filter: blur(8px);
            opacity: 0;
            animation: smoothBg 2s ease-out forwards;
            z-index: -2;
        }

        /* Capa de oscurecimiento encima. */
        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4); /* Cambia 0.4 por más o menos opacidad de la imagen del menú.*/
            z-index: -1;
        }

        @keyframes smoothBg {
            0% {
                opacity: 0;
                transform: scale(1.1);
                filter: blur(15px);
            }
            100% {
                opacity: 1;
                transform: scale(1);
                filter: blur(0);
            }
        }


        /* Estilo del sidebar. */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: rgba(52, 58, 64, 0.9);
            padding: 15px;
            color: white;
            transition: all 0.3s;
             animation: slideIn 0.5s ease-out;
        }

        .sidebar .nav-link {
            color: white;
            font-weight: bold;
            padding: 10px;
            display: block;
            border-radius: 5px;
        }

        .sidebar .nav-link:hover {
            background: #28a745;
            color: white;
        }

        .sidebar .nav-link.active {
            background: #1c7430;
            font-weight: 900;
        }

        /* Contenido principal */
        .content {
            margin-left: 260px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        /* Navbar */
        .navbar {
            background: rgba(0, 0, 0, 0.7) !important;
        }

        .navbar .navbar-brand {
            color: white !important;
        }

        /* Botón de ocultar */
        #toggleSidebar {
            position: fixed;
            top: 15px;
            left: 260px;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.8);
            border: none;
            padding: 10px 15px;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: left 0.3s;
        }

        /* Estilos cuando el menú está oculto. */
        .sidebar.hidden {
            left: -250px;
        }

        .content.full-width {
            margin-left: 0;
        }

        #toggleSidebar.hidden {
            left: 10px;
        }

        /* Estilos para el mensaje de bienvenida. */
        .welcome-footer h1 {
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            text-align: center;
            font-size: 40px;
            padding: 15px 0; /* Aumentar el espacio arriba y abajo */
            color: white;
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 2px; /* Espaciado entre letras */
            word-spacing: 5px; /* Espaciado entre palabras */
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        /* Ajuste para móviles. */
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .content {
                margin-left: 0;
            }

            #toggleSidebar {
                left: 10px;
            }
        }
    </style>
</head>
<body>

<!-- Mensaje de bienvenida en la parte inferior. -->
<footer class="welcome-footer">
    <h1 class="text-center">Bienvenid@, {{ Auth::user()->name }}</h1>
</footer>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Cambio de fondo automático cada 5 segundos
        let images = [
            "img/1-1.jpg",
            "img/2-2.jpg",
            "img/3-3.jpg",
            "img/4-4.jpg",
            "img/5-5.jpg",
            "img/6-6.jpg",
        ];
        
        let index = 0;
        function changeBackground() {
            document.body.style.backgroundImage = `url('${images[index]}')`;
            index = (index + 1) % images.length;
        }
        setInterval(changeBackground, 5000);

        // 👉 Toggle Sidebar con animación (menu desplegable con animación).
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const content = document.querySelector('.content');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                const isHidden = sidebar.classList.toggle('hidden');
                content.classList.toggle('full-width');
                toggleBtn.classList.toggle('hidden');

                if (!isHidden) {
                    // 💡 Reinicia animación cuando se vuelve a mostrar.
                    sidebar.classList.remove('slide-animation'); 
                    void sidebar.offsetWidth; 
                    sidebar.classList.add('slide-animation');
                }
            });
        }
    });
</script>

</body>
</html>

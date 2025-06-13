<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Diagnostico</title>
    <link rel="icon" href="{{ asset('img/icono.PNG') }}" type="image/PNG">
    
    <!-- Otros estilos y scripts que ya tenías en el head. -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    

    <!-- Agregado el meta CSRF. -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- CSS de SweetAlert2. -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <!-- JavaScript de SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    <!-- jQuery. -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- CSS de DataTables. -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- JavaScript de DataTables. -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- JavaScript de Bootstrap 5 (incluye Popper). -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> 
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
    @if(session('isPostLogin'))
        <script>
            sessionStorage.setItem('isPostLogin', 'true');
        </script>
    @endif

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color:rgb(248, 249, 250);
        }

        /* Estilo del sidebar. */
       /* Sidebar fijo y negro. */
    .sidebar {
        width: 280px; /* Ancho. */  
        height: 100vh; /* Altura. */
        position: fixed; /* Fijo. */
        left: 0; /* Izquierda. */
        top: 0; /* Arriba. */
        background: black; /* Color. */
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        padding: 0 0 20px 0;
        color: white;
    }

    .sidebar::-webkit-scrollbar-thumb { /* Scroll. */
            background-color: #16a34a; /* Color verde del scroll. */
            border-radius: 10px;
    }

    .sidebar::-webkit-scrollbar-track { /* Scroll. */
            background-color: transparent;
        }

    /* Marca o título. */
    .sidebar .brand-container {
        padding: 15px; /* Margen. */
        text-align: center; /* Alineacion. */
        border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Borde. */
    }

    .sidebar .brand { /* Marca. */
        color: white;
        font-weight: 900;
        font-size: 1.4rem;
        display: block;
        text-decoration: none;
    }

        .sidebar .brand.active {
            background: #0ea5e9;
            color: white;
            font-weight: 900;
            margin-left: -1px;
        }

        /* Estilos generales para todos los enlaces del menú (como estaban antes). */
        /* Botones del menú. */
    .sidebar .nav-link {
        color: white;
        background-color:rgb(0, 0, 0); /* tono gris oscuro por defecto. */
        padding: 12px 20px; /* Margen. */
        margin: 10px 15px; /* Margen. */
        border-radius: 8px; /* Radio de la curva. */
        display: flex;
        align-items: center; /* Alineacion. */
        text-decoration: none; /* Texto. */
        transition: all 0.3s ease; /* Transicion. */
        font-size: 0.95rem; /* Tamaño de la fuente. */
    }
        /* Solo para el enlace del menú principal. */
        .sidebar .nav-link.menu-principal {
            background: #0ea5e9;
            color: white;
        }

        /* Movimiento al pasar el mouse solo en el enlace del menú principal. */
        .sidebar .nav-link.menu-principal:hover {
            transform: translateX(5px); /* Movimiento. */
        }

        .sidebar .user-info {
            padding: 15px; /* Margen. */
            background-color:rgb(0, 0, 0); /* Color. */
            margin: 0 15px 20px 15px; /* Margen. */
            border-radius: 10px; /* Radio de la curva. */
            display: flex;
            align-items: center; /* Alineacion. */
            gap: 10px; /* Margen. */
            cursor: pointer; /* Cursor. */
            transition: all 0.3s ease; /* Transicion. */
        }

        .sidebar .user-info:hover {
            background-color: #e2e8f0; /* Color. */
        }

        .sidebar .user-info i.user-icon {
            background-color: #0ea5e9;
            color: white;
            padding: 10px; /* Margen. */
            border-radius: 8px; /* Radio de la curva. */
        }

        .sidebar .user-info .user-details {
            flex: 1; /* Flex. */
        }

        .sidebar .user-info h5 {
            margin: 0; /* Margen. */
            font-size: 0.95rem; /* Tamaño de la fuente. */
            font-weight: 600;
        }

        .sidebar .user-info .logout-icon {
            color: #ef4444; /* Color. */
            margin-left: auto; /* Margen. */
        }

        .sidebar .nav-link i {
        margin-right: 12px; /* Margen. */
        width: 20px; /* Ancho. */
        text-align: center; /* Alineacion. */
    }

    /* Hover: un poco más claro */
    .sidebar .nav-link:hover {
        background-color:rgb(141, 129, 129); /* Color. */
    }

    /* Solo el botón activo (seleccionado): blanco con texto negro. */
    .sidebar .nav-link.active { 
        background-color: white; /* Color. */
        color: black; /* Color. */
        font-weight: bold; /* Peso de la fuente. */
    }

        /* Contenido principal. */
        .content {
            margin-left: 280px; /* Margen. */
            padding: 30px; /* Margen. */
            transition: margin-left 0.3s; /* Transicion. */
        }

        /* Botón para toggle del sidebar */
        #toggleSidebar {
            cursor: pointer;
            font-size: 2.2rem; 
           color:rgb(0, 0, 0); /* Color. */ 
            font-weight: 700; /* Peso de la fuente. */
            background-color: #f8fafc; /* Color. */
            width: 50px; /* Ancho. */
            height: 50px; /* Alto. */
            border-radius: 50%; /* Radio de la curva. */
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 50px;
            right: -1px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 1001;
        }

        #toggleSidebar:hover {
            transform: scale(1.1); /* Transformacion. */
            color:rgb(25, 192, 226); /* Color. */
        }

        /* Estilos para el botón cuando el sidebar está oculto. */
        #toggleSidebar.hidden {
            right: auto;
            left: 20px;
            color: #16a34a; /* Color. */            
            color: white;
        }

        /* Estilos cuando el menú está oculto. */
        .sidebar.hidden {
            left: -380px;
        }

        .content.full-width {
            margin-left: 0; /* Margen. */
        }

        /* Divider */
        .sidebar-divider {
            border-top: 1px solid #e2e8f0; /* Color. */
            margin: 15px;
        }

        /* Estilos para secciones. */
        .sidebar-section-title {
            font-size: 0.75rem; /* Tamaño de la fuente. */
            text-transform: uppercase; /* Transformacion. */
            letter-spacing: 0.5px; /* Espacio entre letras. */
            color: #94a3b8; /* Color. */
            font-weight: 600;
            padding: 0 15px;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        /* Botón flotante para mostrar menú en móviles */
        .mobile-toggle {
            display: none;
            position: fixed; /* Posicionamiento. */
            bottom: 20px; /* Margen. */
            right: 300px; /* Margen. */
            z-index: 1002; /* Z-index. */
            color:rgb(0, 0, 0); /* Color. */
            color: white; /* Color. */
            width: 50px; /* Ancho. */
            height: 50px; /* Alto. */
            border-radius: 50%; /* Radio de la curva. */
            justify-content: center; /* Alineacion. */
            align-items: center; /* Alineacion. */
            box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);
            border: none;
        }

       

        /* Estilos adicionales para el botón flotante. */
        .floating-toggle {
            display: none;
            position: fixed; /* Posicionamiento. */
            top: 20px; /* Margen. */
            left: 20px; /* Margen. */
            background-color:rgb(0, 0, 0); /* Color. */
            color: white; /* Color. */
            width: 50px; /* Ancho. */
            height: 50px; /* Alto. */
            border-radius: 50%; /* Radio de la curva. */
            justify-content: center; /* Alineacion. */
            align-items: center; /* Alineacion. */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Sombra. */
            cursor: pointer; /* Cursor. */
            z-index: 1100; /* Z-index. */
            font-weight: 700; /* Peso de la fuente. */
            font-size: 2.2rem; /* Tamaño de la fuente. */
            transition: transform 0.3s ease; /* Transicion. */
        }
        
        .floating-toggle:hover {
            transform: scale(1.1); /* Transformacion. */
        }

        /* Sticky footer que permanece abajo aunque no haya contenido suficiente */
        html {
            height: 100%; /* Alto. */
        }

        body {
            min-height: 100%; /* Alto. */
            display: flex; /* Display. */
            flex-direction: column; /* Flex. */
        }

        .content-wrapper {
            flex: 1 0 auto; /* Flex. */
        }

        .footer {
            flex-shrink: 0; /* Flex. */
            background-color: #f8f9fa; /* Color. */
            text-align: center; /* Alineacion. */
            padding: 0.10rem 0; /* Margen. */
            border-top: 1px solid #e2e8f0; /* Sombra. */
            width: 100%; /* Ancho. */
        }

        .footer-content {
            font-family: 'Poppins', sans-serif; /* Tipo de fuente. */
            font-size: 0.8rem; /* Tamaño de la fuente. */
            color: #718096; /* Color. */
        }

        .modern-user-card {
    display: flex; /* Display. */
    align-items: center; /* Alineacion. */
    gap: 12px; /* Margen. */
    padding: 12px 16px; /* Margen. */
    background: rgba(255, 255, 255, 0.05); /* Color. */
    border-radius: 12px; /* Radio de la curva. */
    cursor: pointer; /* Cursor. */
    transition: background 0.3s ease, transform 0.2s; /* Transicion. */
    box-shadow: 0 2px 8px rgba(0,0,0,0.1); /* Sombra. */
}

.modern-user-card:hover {
    background: rgba(255, 255, 255, 0.1); /* Color. */
    transform: scale(1.02); /* Transformacion. */
}

.avatar-container {
    display: flex; /* Display. */
    align-items: center; /* Alineacion. */
    justify-content: center; /* Alineacion. */
}

.avatar-icon {
    font-size: 28px; /* Tamaño de la fuente. */
    color: #ffffff; /* Color. */
}

.user-details .username {
    margin: 0; /* Margen. */
    font-size: 16px; /* Tamaño de la fuente. */
    font-weight: 600; /* Peso de la fuente. */
    color: #ffffff; /* Color. */
}

.user-details .user-role {
    font-size: 13px; /* Tamaño de la fuente. */
    color: #a0aec0; /* Color. */
}

.arrow-icon {
    margin-left: auto; /* Margen. */
    color: #a0aec0; /* Color. */
    font-size: 16px; /* Tamaño de la fuente. */
    transition: transform 0.3s ease; /* Transicion. */
}

.modern-user-card:hover .arrow-icon {
    transform: translateX(4px); /* Transformacion. */
}


.modern-nav-link {
    display: flex; /* Display. */
    align-items: center; /* Alineacion. */
    gap: 12px; /* Margen. */
    padding: 12px 16px; /* Margen. */
    background: rgba(255, 255, 255, 0.05); /* Color. */
    border-radius: 12px; /* Radio de la curva. */
    color: rgb(126, 117, 117); /* texto por defecto */
    font-weight: 500; /* Peso de la fuente. */
    text-decoration: none; /* Texto. */
    transition: background 0.3s ease, transform 0.2s, color 0.2s ease; /* Transicion. */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* Sombra. */
    margin-bottom: 8px; /* Margen. */
    min-height: 44px; /* Alto. */
}

.modern-nav-link i {
    color: #22c55e; /* Color. */
    min-width: 20px; /* Ancho. */
    text-align: center; /* Alineacion. */
    transition: color 0.3s ease; /* Transicion. */
}

.modern-nav-link:hover {
    background: rgba(255, 255, 255, 0.1); /* Color. */
    transform: scale(1.02); /* Transformacion. */
    color: rgb(90, 90, 90); /* Color. */
}

.modern-nav-link.active {
    background: rgba(182, 163, 163, 0.2); /* Color. */
    color: rgb(70, 70, 70); /* Color. */
    font-weight: 600; /* Peso de la fuente. */
    border-left: 4px solid #22c55e; /* Borde. */
    padding-left: 12px; /* Margen. */
}

.modern-nav-link.active i {
    color: #22c55e; /* Color. */
}



.brand-modern-title {
    display: flex; /* Display. */
    flex-direction: column; /* Flex. */
    align-items: center; /* Alineacion. */
    padding: 16px; /* Margen. */
    background-color: rgba(183, 170, 170, 0.08); /* Color. */
    border-radius: 12px; /* Radio de la curva. */
    margin: 2px 0 2px 0; /* ↑ esto lo baja */
    color: white; /* Color. */
    box-shadow: 0 2px 8px rgba(255, 255, 255, 0.05); /* Sombra. */
    text-align: center; /* Alineacion. */
    transition: transform 0.2s ease; /* Transicion. */
}

.brand-modern-title:hover {
    transform: scale(1.02); /* Transformacion. */
}

.brand-modern-title #brandLink {
    font-size: 20px; /* Tamaño de la fuente. */
    font-weight: 700; /* Peso de la fuente. */
    margin-bottom: 6px; /* Margen. */
    color: rgb(249, 245, 245); /* Color. */
}

.brand-modern-title .icon-below {
    font-size: 24px; /* Tamaño de la fuente. */
    color: #ffffff; /* Color. */
}
.sidebar {
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    /* Eliminamos margin-right y position absolute que causaban el espacio. */
}

/* Scrollbar personalizada. */
.sidebar::-webkit-scrollbar {
    width: 6px; /* Ancho. */
    background: transparent; /* Color. */
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.3); /* Color. */
    border-radius: 3px;
}

/* Botón toggle - posición absoluta SIN afectar el flujo. */
#toggleSidebar {
    position: absolute;
    top: 50px;
    right: -1px;
    z-index: 1001;
    /* Mantiene todos tus estilos originales. */
    box-shadow: 0 0 0 2px rgba(0,0,0,0.1); /* Borde para mejor visibilidad */
}

/* Responsive ajustado. */
@media (max-width: 768px) {
    .sidebar {
        scrollbar-width: none;
    }
    
    .sidebar::-webkit-scrollbar {
        display: none;
    }
    
    .sidebar.active {
        scrollbar-width: thin;
    }
    
    #toggleSidebar {
        right: 20px;
    }
}
    </style>

    @yield('styles')
    </head>
    <body>
        <!-- Sidebar. -->
        <div class="sidebar">
            <!-- Botón para mostrar/ocultar el menú. -->
            <div id="toggleSidebar">≡</div>

            <div class="brand-modern-title">
                <span id="brandLink">Sistema de Diagnóstico</span>
                <i class="fas fa-laptop-code icon-below"></i>
            </div>



            <!-- Usuario con función de logout. -->
            @if(Auth::check())
            <div class="user-info modern-user-card" id="user-profile">
                <div class="avatar-container">
                    <i class="fas fa-user-circle avatar-icon"></i>
                </div>
                <div class="user-details">
                    <h5 class="username">{{ Auth::user()->name }}</h5>
                    <small class="user-role">{{ Auth::user()->role }}</small>
                </div>
            </div>


 <!-- Menú. -->
 <a href="{{ route('menu') }}" class="nav-link {{ (request()->is('menu') || request()->is('/') || request()->is('home')) ? 'active' : '' }}">
    <i class="fas fa-home"></i> Inicio
</a>

 <!-- Reportes. -->
  <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->routeIs('reportes.*') ? 'active' : '' }}">
    <i class="fas fa-chart-bar"></i> Reportes
  </a>

<!-- ADMINISTRACIÓN DE REGISTROS. -->
<div class="sidebar-section-title">ADMINISTRACIÓN DE REGISTROS</div>
<a href="{{ route('empresa.index') }}" class="nav-link {{ request()->routeIs('empresa.*') ? 'active' : '' }}">
   <i class="fa-solid fa-building"></i>Registro de Empresa
</a>
<a href="{{ route('registrodiagnostico.index') }}" class="nav-link {{ request()->routeIs('registrodiagnostico.*') ? 'active' : '' }}">
    <i class="fas fa-desktop"></i>Registro Diagnóstico
</a>

<!-- Bitácora. -->
@if(Auth::user()->role === 'Administrador')
<a href="{{ route('bitacora.index') }}" class="nav-link {{ request()->routeIs('bitacoras.*') ? 'active' : '' }}">
   <i class="fa-solid fa-file"></i>Bitácora
</a>

<!-- ADMINISTRACIÓN DE USUARIO. -->
<div class="sidebar-section-title">ADMINISTRACIÓN DE USUARIO</div>
<a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
    <i class="fas fa-user"></i> Registro de Usuario
</a>
<a href="{{ route('registrorol.table') }}" class="nav-link {{ request()->routeIs('registrorol.*') ? 'active' : '' }}">
    <i class="fas fa-users"></i> Gestor de Roles
</a>
@endif

<!-- Cerrar Sesión. -->
<a href="#" id="sidebarLogout" class="nav-link text-start">
    <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
</a>
            <!-- Formulario oculto para logout. -->
            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                @csrf
            </form>
            @else
            <!-- Mostrar opción de login para usuarios no autenticados. -->
            <div class="user-info" onclick="window.location.href='{{ route('login') }}'">
                <i class="fas fa-sign-in-alt user-icon"></i>
                <div class="user-details">
                    <h5>Iniciar Sesión</h5>
                </div>
            </div>
            @endif
        </div>

        <!-- Botón P flotante cuando el sidebar está oculto. -->
        <div id="floatingToggle" class="floating-toggle">≡</div>


        <!-- Contenido principal. -->
        <div class="content">
            <div class="container mt-4">
                @yield('contenido')
            </div>
        </div>

        <div class="content-wrapper">
            <!-- Todo el contenido de tus vistas irá aquí. -->
            @yield('content')
        </div>
        
        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    © 2025 Todos los derechos reservados. Grupo Plasencia (Sistema de Diagnóstico) - Clasificadora y Exportadora de Tabaco S.A. 
                </div>
            </div>
        </footer>

        <!-- Scripts. -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const sidebar = document.querySelector('.sidebar');
                const toggleBtn = document.getElementById('toggleSidebar');
                const floatingToggle = document.getElementById('floatingToggle');
                const mobileToggle = document.getElementById('mobileToggle');
                const content = document.querySelector('.content');
                const links = document.querySelectorAll('.nav-link');

                // Función para actualizar la visibilidad de los botones de toggle.
                function updateToggleVisibility(isSidebarHidden) {
                    if (isSidebarHidden) {
                        toggleBtn.classList.add('hidden');
                        floatingToggle.style.display = 'flex';
                    } else {
                        toggleBtn.classList.remove('hidden');
                        floatingToggle.style.display = 'none';
                    }
                }

                // Forzar menú oculto después de iniciar sesión.
                // Verificar si venimos directamente del login.
                const isPostLogin = sessionStorage.getItem('isPostLogin') === 'true';
                const pathname = window.location.pathname;
                
                // Si acabamos de iniciar sesión O estamos en la página principal después de iniciar sesión.
                if (isPostLogin || pathname === '/home' || pathname === '/' || pathname === '/menu') {
                    // Forzar menú oculto.
                    sidebar.classList.add('hidden');
                    content.classList.add('full-width');
                    localStorage.setItem('sidebarHidden', 'true');
                    updateToggleVisibility(true);
                    
                    // Limpiar bandera de post-login.
                    sessionStorage.removeItem('isPostLogin');
                } else {
                    // Para otras navegaciones, usar la preferencia guardada.
                    const shouldHideSidebar = localStorage.getItem('sidebarHidden') === 'true';
                    
                    if (shouldHideSidebar) {
                        sidebar.classList.add('hidden');
                        content.classList.add('full-width');
                        updateToggleVisibility(true);
                    } else {
                        sidebar.classList.remove('hidden');
                        content.classList.remove('full-width');
                        updateToggleVisibility(false);
                    }
                }

                // Mostrar u ocultar el menú lateral (y guardar el estado).
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.add('hidden');
                    content.classList.add('full-width');
                    
                    // Guardar el estado actual.
                    localStorage.setItem('sidebarHidden', 'true');
                    updateToggleVisibility(true);
                });
                
                // Botón flotante para mostrar el menú cuando está oculto.
                floatingToggle.addEventListener('click', function() {
                    sidebar.classList.remove('hidden');
                    content.classList.remove('full-width');
                    
                    localStorage.setItem('sidebarHidden', 'false');
                    updateToggleVisibility(false);
                });
                
                // Botón móvil para mostrar el menú.
                mobileToggle.addEventListener('click', function() {
                    sidebar.classList.remove('hidden');
                    content.classList.remove('full-width');
                    localStorage.setItem('sidebarHidden', 'false');
                    updateToggleVisibility(false);
                });
                
                // Cierra el sidebar en cualquier resolución.
                links.forEach(link => {
                    link.addEventListener('click', function () {
                        // Cierra el sidebar en cualquier resolución.
                        sidebar.classList.add('hidden');
                        content.classList.add('full-width');
                        localStorage.setItem('sidebarHidden', 'true');
                        updateToggleVisibility(true);
                    });
                });


                // Ajustes especiales para móviles.
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('hidden');
                    content.classList.add('full-width');
                    localStorage.setItem('sidebarHidden', 'true');
                    updateToggleVisibility(true);
                }
                
                // Marcar el enlace activo según la URL actual.
                if (typeof $ !== 'undefined') {
                    const currentUrl = window.location.href;
                    $('.nav-link').each(function() {
                        const linkUrl = $(this).attr('href');
                        if (currentUrl.includes(linkUrl) && linkUrl !== '{{ route("menu") }}') {
                            $(this).addClass('active');
                        }
                    });
                    
                    // Cerrar sesión y resetear preferencias.
                    // Cierre desde el botón del sidebar-}.

                }
            });

            $('#sidebarLogout').on('click', function(e) {
    e.preventDefault();

    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: '¿Estás seguro que deseas cerrar tu sesión?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#0ea5e9',
            confirmButtonText: 'Sí, cerrar sesión',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                localStorage.removeItem('sidebarHidden');
                document.getElementById('logout-form').submit();
            }
        });
    } else {
        if (confirm('¿Estás seguro que deseas cerrar tu sesión?')) {
            localStorage.removeItem('sidebarHidden');
            document.getElementById('logout-form').submit();
        }
    }
});
        </script>
    </body>
</html>
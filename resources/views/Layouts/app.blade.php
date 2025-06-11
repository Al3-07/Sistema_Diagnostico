<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Diagnostico</title>
    <link rel="icon" href="{{ asset('img/icono.PNG') }}" type="image/PNG">
    
    <!-- Otros estilos y scripts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Agregado el meta CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- CSS de SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <!-- JavaScript de SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- CSS de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- JavaScript de DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- JavaScript de Bootstrap 5 (incluye Popper) -->
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
            background-color: rgb(248, 249, 250);
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: -280px;
            top: 0;
            background: black;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
            padding: 0 0 20px 0;
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        /* Sidebar visible */
        .sidebar.active {
            left: 0;
        }

        /* Contenido principal */
        .content {
            flex: 1;
            width: 100%;
            padding: 30px;
            transition: padding-left 0.3s;
            position: relative;
            z-index: 1;
        }

        /* Contenido cuando sidebar está visible (solo en desktop) */
        @media (min-width: 769px) {
            .content.with-sidebar {
                padding-left: 300px;
            }
        }

        /* Botón flotante del menú */
        .floating-toggle {
            display: flex;
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: black;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1001;
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .floating-toggle:hover {
            transform: scale(1.1);
            background-color: #333;
        }

        /* Estilos para la marca/título */
        .brand-modern-title {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 16px;
            background-color: rgba(183, 170, 170, 0.08);
            border-radius: 12px;
            margin: 20px 15px 15px;
            color: white;
            box-shadow: 0 2px 8px rgba(255, 255, 255, 0.05);
            text-align: center;
        }

        .brand-modern-title #brandLink {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 6px;
            color: rgb(249, 245, 245);
        }

        .brand-modern-title .icon-below {
            font-size: 24px;
            color: #ffffff;
        }

        /* Estilos para el usuario */
        .modern-user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin: 0 15px 15px;
        }

        .modern-user-card:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .avatar-icon {
            font-size: 28px;
            color: #ffffff;
        }

        .user-details .username {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
        }

        .user-details .user-role {
            font-size: 13px;
            color: #a0aec0;
        }

        /* Estilos para los enlaces del menú */
        .modern-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            color: white;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 5px 15px;
        }

        .modern-nav-link i {
            color: #ffffff;
            min-width: 20px;
            text-align: center;
        }

        .modern-nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .modern-nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
        }

        /* Títulos de sección */
        .sidebar-section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #94a3b8;
            font-weight: 600;
            padding: 15px 15px 5px;
            margin-top: 10px;
        }

        /* Footer */
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 0.10rem 0;
            border-top: 1px solid #e2e8f0;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        .footer-content {
            font-family: 'Poppins', sans-serif;
            font-size: 0.8rem;
            color: #718096;
        }

        /* Overlay para móviles */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        /* Media queries para responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 280px;
            }
            
            .sidebar.active {
                left: 0;
            }
            
            .floating-toggle {
                display: flex;
            }
        }

        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none !important;
            }
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Overlay para móviles -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="brand-modern-title">
            <span id="brandLink">Sistema de Diagnósticos</span>
            <i class="fas fa-laptop-code icon-below"></i>
        </div>

        <!-- Usuario con función de logout -->
        @if(Auth::check())
        <div class="modern-user-card" id="user-profile">
            <div class="avatar-container">
                <i class="fas fa-user-circle avatar-icon"></i>
            </div>
            <div class="user-details">
                <h5 class="username">{{ Auth::user()->name }}</h5>
                <small class="user-role">{{ Auth::user()->role }}</small>
            </div>
        </div>

        <a href="{{ route('menu') }}" class="modern-nav-link {{ (request()->is('menu') || request()->is('/') || request()->is('home')) ? 'active' : '' }}">
            <i class="fas fa-home"></i> Inicio
        </a>

        <a href="{{ route('reportes.index') }}" class="modern-nav-link {{ request()->routeIs('reportes.*') ? 'active' : '' }}">
            <i class="fas fa-chart-bar"></i> Reportes
        </a>

        <div class="sidebar-section-title">ADMINISTRACIÓN DE REGISTROS</div>
        <a href="{{ route('empresa.index') }}" class="modern-nav-link {{ request()->routeIs('empresa.*') ? 'active' : '' }}">
            <i class="fa-solid fa-building"></i> Registro de Empresa
        </a>
        <a href="{{ route('registrodiagnostico.index') }}" class="modern-nav-link {{ request()->routeIs('registrodiagnostico.*') ? 'active' : '' }}">
            <i class="fas fa-desktop"></i> Registro Diagnóstico
        </a>
        <a href="{{ route('bitacora.index') }}" class="modern-nav-link {{ request()->routeIs('bitacoras.*') ? 'active' : '' }}">
            <i class="fa-solid fa-file"></i> Bitácora
        </a>

        @if(Auth::user()->role === 'Administrador')
        <div class="sidebar-section-title">ADMINISTRACIÓN DE USUARIO</div>
        <a href="{{ route('user.index') }}" class="modern-nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
            <i class="fas fa-user"></i> Registro de Usuario
        </a>
        <a href="{{ route('registrorol.table') }}" class="modern-nav-link {{ request()->routeIs('registrorol.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Gestor de Roles
        </a>
        @endif

        <a href="#" id="sidebarLogout" class="modern-nav-link">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>

        <!-- Formulario oculto para logout -->
        <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
            @csrf
        </form>
        @else
        <!-- Mostrar opción de login para usuarios no autenticados -->
        <div class="modern-user-card" onclick="window.location.href='{{ route('login') }}'">
            <i class="fas fa-sign-in-alt avatar-icon"></i>
            <div class="user-details">
                <h5 class="username">Iniciar Sesión</h5>
            </div>
        </div>
        @endif
    </div>

    <!-- Botón flotante para mostrar el menú -->
    <div class="floating-toggle" id="floatingToggle">≡</div>

    <!-- Contenido principal -->
    <div class="content" id="mainContent">
        <div class="container mt-4">
            @yield('contenido')
        </div>
    </div>

    <div class="content-wrapper">
        @yield('content')
    </div>
    
    <!-- Footer ahora está siempre al pie de página -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                © 2025 Todos los derechos reservados. Grupo Plasencia (Sistema de Diagnóstico) - Clasificadora y Exportadora de Tabaco S.A. 
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById('sidebar');
            const floatingToggle = document.getElementById('floatingToggle');
            const content = document.getElementById('mainContent');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const navLinks = document.querySelectorAll('.modern-nav-link');
            
            // Función para mostrar/ocultar el sidebar
            function toggleSidebar() {
                const isActive = sidebar.classList.toggle('active');
                
                if (isActive) {
                    if (window.innerWidth <= 768) {
                        sidebarOverlay.style.display = 'block';
                    } else {
                        content.classList.add('with-sidebar');
                    }
                } else {
                    sidebarOverlay.style.display = 'none';
                    content.classList.remove('with-sidebar');
                }
            }
            
            // Evento para el botón flotante
            floatingToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleSidebar();
            });
            
            // Evento para el overlay en móviles
            sidebarOverlay.addEventListener('click', function() {
                toggleSidebar();
            });
            
            // Evento para los enlaces del menú
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.id !== 'sidebarLogout' && window.innerWidth <= 768) {
                        toggleSidebar();
                    }
                });
            });
            
            // Evento para el logout
            document.getElementById('sidebarLogout')?.addEventListener('click', function(e) {
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
                            document.getElementById('logout-form').submit();
                        }
                    });
                } else {
                    if (confirm('¿Estás seguro que deseas cerrar tu sesión?')) {
                        document.getElementById('logout-form').submit();
                    }
                }
            });
            
            // Cerrar el menú al hacer clic fuera en móviles
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && sidebar.classList.contains('active') && 
                    !sidebar.contains(e.target) && e.target !== floatingToggle) {
                    toggleSidebar();
                }
            });
            
            // Ajustar en redimensionamiento de pantalla
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebarOverlay.style.display = 'none';
                    
                    if (sidebar.classList.contains('active')) {
                        content.classList.add('with-sidebar');
                    }
                } else {
                    if (sidebar.classList.contains('active')) {
                        sidebarOverlay.style.display = 'block';
                    }
                    content.classList.remove('with-sidebar');
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
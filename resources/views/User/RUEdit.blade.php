@extends('layouts.app')

@section('titulo', 'Editar Usuario')

@section('contenido')

<style>
    :root {
        --primary: #4361ee; /* Fin del primary. */
        --primary-light: #3f37c9; /* Fin del primary-light. */
        --secondary: #3a0ca3; /* Fin del secondary. */
        --accent: #f72585; /* Fin del accent. */
        --light: #f8f9fa; /* Fin del light. */
        --dark: #212529; /* Fin del dark. */
        --gray: #6c757d; /* Fin del gray. */
        --light-gray: #e9ecef; /* Fin del light-gray. */
        --success: #4cc9f0; /* Fin del success. */
        --warning: #f8961e; /* Fin del warning. */
        --danger: #ef233c; /* Fin del danger. */
        --border-radius: 12px; /* Fin del border-radius. */
        --box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08); /* Fin del box-shadow. */
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); /* Fin del transition. */
    }
    
    .edit-container {
        max-width: 900px; /* Fin del max-width. */
        margin: 1rem auto; /* Fin del margin. */
        background: white; /* Fin del background. */
        border-radius: var(--border-radius); /* Fin del border-radius. */
        box-shadow: var(--box-shadow); /* Fin del box-shadow. */
        padding: 1.5rem; /* Fin del padding. */
        border: none; /* Fin del border. */
        position: relative; /* Fin del position. */
        overflow: hidden; /* Fin del overflow. */
        transition: var(--transition); /* Fin del transition. */
    }

    .edit-container::before {
        content: '';
        position: absolute; /* Fin del position. */
        top: 0; /* Fin del top. */
        left: 0; /* Fin del left. */
        width: 5px; /* Fin del width. */
        height: 100%; /* Fin del height. */
        background:rgb(165, 165, 165); /* Fin del background. */
    }

    @media (min-width: 768px) {
        .edit-container {
            padding: 2rem; /* Fin del padding. */
            margin: 2rem auto; /* Fin del margin. */
        }
    }

    @media (min-width: 992px) {
        .edit-container {
            margin-top: 60px; /* Fin del margin-top. */
            margin-left: 220px; /* Fin del margin-left. */
            margin-right: 20px; /* Fin del margin-right. */
        }
    }

    .edit-container:hover {
        transform: translateY(-3px); /* Fin del transform. */
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1); /* Fin del box-shadow. */
    }

    .edit-header {
        display: flex; /* Fin del display. */
        flex-direction: column; /* Fin del flex-direction. */
        gap: 1rem; /* Fin del gap. */
        margin-bottom: 1.5rem; /* Fin del margin-bottom. */
    }

    @media (min-width: 576px) {
        .edit-header {
            flex-direction: row; /* Fin del flex-direction. */
            justify-content: space-between; /* Fin del justify-content. */
            align-items: center; /* Fin del align-items. */
        }
    }

    .edit-title {
        font-weight: 700; /* Fin del font-weight. */
        font-size: 1.5rem; /* Fin del font-size. */
        color: var(--dark); /* Fin del color. */
        position: relative; /* Fin del position. */
        display: flex; /* Fin del display. */
        align-items: center; /* Fin del align-items. */
        gap: 0.8rem;
        margin: 0;
    }

    @media (min-width: 768px) {
        .edit-title {
            font-size: 1.8rem; /* Fin del font-size. */
        }
    }

    .edit-title::after {
        content: '';
        position: absolute; /* Fin del position. */
        bottom: -8px; /* Fin del bottom. */
        left: 0; /* Fin del left. */
        width: 50px; /* Fin del width. */
        height: 3px; /* Fin del height. */
        background: var(--primary); /* Fin del background. */
        border-radius: 2px;
    }

    .form-section {
        margin-bottom: 1.5rem; /* Fin del margin-bottom. */
    }

    @media (min-width: 768px) {
        .form-section {
            margin-bottom: 2rem; /* Fin del margin-bottom. */
        }
    }

    .section-title {
        font-weight: 600; /* Fin del font-weight. */
        font-size: 1rem; /* Fin del font-size. */
        color: var(--primary); /* Fin del color. */
        margin-bottom: 1rem; /* Fin del margin-bottom. */
        display: flex; /* Fin del display. */
        align-items: center; /* Fin del align-items. */
        gap: 0.6rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--light-gray);
    }

    @media (min-width: 768px) {
        .section-title {
            font-size: 1.1rem; /* Fin del font-size. */
            margin-bottom: 1.2rem; /* Fin del margin-bottom. */
        }
    }

    label {
        font-weight: 600; /* Fin del font-weight. */
        font-size: 0.9rem; /* Fin del font-size. */
        margin-bottom: 0.4rem; /* Fin del margin-bottom. */
        color: var(--dark); /* Fin del color. */
        display: block; /* Fin del display. */
    }

    @media (min-width: 768px) {
        label {
            font-size: 0.95rem; /* Fin del font-size. */
            margin-bottom: 0.5rem; /* Fin del margin-bottom. */
        }
    }

    .form-control {
        border-radius: 8px; /* Fin del border-radius. */
        border: 1px solid var(--light-gray); /* Fin del border. */
        padding: 0.65rem 0.9rem; /* Fin del padding. */
        font-size: 0.95rem; /* Fin del font-size. */
        color: var(--dark); /* Fin del color. */
        transition: var(--transition); /* Fin del transition. */
        background-color: white;
        width: 100%;
    }

    @media (min-width: 768px) {
        .form-control {
            padding: 0.75rem 1rem; /* Fin del padding. */
            font-size: 1rem; /* Fin del font-size. */
        }
    }

    .form-control:focus {
        border-color: var(--primary); /* Fin del border-color. */
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15); /* Fin del box-shadow. */
        outline: none; /* Fin del outline. */
    }

    .form-control.is-invalid {
        border-color: var(--danger); /* Fin del border-color. */
    }

    .invalid-feedback {
        font-size: 0.8rem; /* Fin del font-size. */
        color: var(--danger); /* Fin del color. */
        margin-top: 0.3rem; /* Fin del margin-top. */
        display: flex; /* Fin del display. */
        align-items: center; /* Fin del align-items. */
        gap: 0.3rem; /* Fin del gap. */
    }

    .form-row {
        display: flex; /* Fin del display. */
        flex-direction: column; /* Fin del flex-direction. */
        gap: 1rem; /* Fin del gap. */
    }

    @media (min-width: 576px) {
        .form-row {
            display: grid; /* Fin del display. */
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Fin del grid-template-columns. */
            gap: 1.5rem; /* Fin del gap. */
        }
    }

    .form-group {
        margin-bottom: 1rem; /* Fin del margin-bottom. */
    }

    @media (min-width: 768px) {
        .form-group {
            margin-bottom: 1.2rem; /* Fin del margin-bottom. */
        }
    }

    .input-group {
        position: relative; /* Fin del position. */
        display: flex; /* Fin del display. */
        align-items: center; /* Fin del align-items. */
    }

    .input-group .form-control {
        padding-right: 2.5rem; /* Fin del padding-right. */
    }

    .input-group .btn {
        position: absolute; /* Fin del position. */
        right: 0; /* Fin del right. */
        background: transparent; /* Fin del background. */
        border: none; /* Fin del border. */
        color: var(--gray); /* Fin del color. */
        padding: 0 0.75rem; /* Fin del padding. */
        height: 100%; /* Fin del height. */
        display: flex; /* Fin del display. */
        align-items: center;
        justify-content: center;
    }

    .input-group .btn:hover {
        color: var(--primary); /* Fin del color. */
        background: transparent; /* Fin del background. */
    }

    .footer-actions {
        display: flex; /* Fin del display. */
        flex-direction: column-reverse; /* Fin del flex-direction. */
        gap: 1.5rem; /* Fin del gap. */
        margin-top: 2rem; /* Fin del margin-top. */
        padding-top: 1.5rem; /* Fin del padding-top. */
        border-top: 1px solid var(--light-gray); /* Fin del border-top. */
    }

    @media (min-width: 576px) {
        .footer-actions {
            flex-direction: row; /* Fin del flex-direction. */
            justify-content: space-between; /* Fin del justify-content. */
            align-items: center; /* Fin del align-items. */
            gap: 1rem; /* Fin del gap. */
        }
    }

    .action-buttons {
        display: flex; /* Fin del display. */
        flex-direction: column; /* Fin del flex-direction. */
        gap: 0.8rem; /* Fin del gap. */
        width: 100%; /* Fin del width. */
    }

    @media (min-width: 576px) {
        .action-buttons {
            flex-direction: row; /* Fin del flex-direction. */
            justify-content: flex-end; /* Fin del justify-content. */
            gap: 1rem; /* Fin del gap. */
            width: auto; /* Fin del width. */
        }
    }

    .btn-secondary, .btn-primary {
        padding: 0.4rem 0.8rem; /* Fin del padding. */
        font-size: 0.875rem; /* Fin del font-size. */
        border-radius: 0.375rem; /* Fin del border-radius. */
        border: none; /* Fin del border. */
        cursor: pointer; /* Fin del cursor. */
        font-weight: 500; /* Fin del font-weight. */
        transition: all 0.2s ease; /* Fin del transition. */
        display: inline-flex; /* Fin del display. */
        align-items: center; /* Fin del align-items. */
        justify-content: center; /* Fin del justify-content. */
        text-align: center; /* Fin del text-align. */
        white-space: nowrap; /* Fin del white-space. */
    }

    .btn-secondary {
        background-color: var(--light-gray); /* Fin del background-color. */
        color: var(--dark); /* Fin del color. */
    }

    .btn-secondary:hover {
        background-color: #d1d5db; /* Fin del background-color. */
        transform: translateY(-2px); /* Fin del transform. */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); /* Fin del box-shadow. */
    }

    .btn-primary {
        background-color: var(--primary); /* Fin del background-color. */
        color: white; /* Fin del color. */
    }

    .btn-primary:hover {
        background-color: var(--primary-light); /* Fin del background-color. */
        transform: translateY(-2px); /* Fin del transform. */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
</style>
<!-- Fin de los estilos -->
<div class="edit-container">
    <form id="formEditarUsuario" method="POST" action="{{ route('user.update', $usuario->id) }}">
        @csrf
        @method('PUT')
<!-- Fin del form -->
        <div class="edit-header">
            <h1 class="edit-title">Editar usuario</h1>
        </div>
<!-- Fin del edit-header -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-user-edit"></i> Información del usuario
            </h3>
            
            <div class="form-row">
                <!-- Campo Nombre -->
                <div class="form-group">
                    <label for="nombreUsuario">Nombre:</label>
                    <input type="text" id="nombreUsuario" name="nombre" class="form-control" value="{{ $usuario->name }}" required>
                </div>
                
                <!-- Campo Rol. -->
                <div class="form-group">
                    <label for="rolUsuario">Rol:</label>
                    <select id="rolUsuario" name="rol" class="form-control" required>
                        <option value="Administrador" {{ $usuario->role == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        <option value="Usuario" {{ $usuario->role == 'Usuario' ? 'selected' : '' }}>Usuario</option>
                        <option value="Visualizador" {{ $usuario->role == 'Visualizador' ? 'selected' : '' }}>Visualizador</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <!-- Campo Nueva Contraseña. -->
                <div class="form-group">
                    <label for="passwordUsuario">Nueva contraseña (opcional):</label>
                    <div class="input-group">
                        <input type="password" id="passwordUsuario" name="password" class="form-control">
                        <button type="button" class="btn toggle-password" data-target="passwordUsuario">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Campo Confirmar Contraseña. -->
                <div class="form-group">
                    <label for="passwordConfirmUsuario">Confirmar contraseña:</label>
                    <div class="input-group">
                        <input type="password" id="passwordConfirmUsuario" name="password_confirmation" class="form-control">
                        <button type="button" class="btn toggle-password" data-target="passwordConfirmUsuario">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
<!-- Fin del form-section. -->
        <div class="footer-actions">
            <div class="action-buttons">
                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Regresar
                </a>
                <button type="submit" id="btnActualizarUsuario" class="btn btn-primary">
                    <i class="fas fa-sync-alt me-1"></i> Actualizar
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // Deshabilitar de actualizar.
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("formEditarUsuario");
        const submitButton = document.querySelector("button[type='submit']"); 

        // Deshabilitar el botón al inicio.
        submitButton.disabled = true;

        // Guardar valores originales.
        const initialFormData = new FormData(form);

        form.addEventListener("input", function () {
            const currentFormData = new FormData(form);
            let hasChanges = false;

            // Comparar los valores actuales con los originales.
            for (let [key, value] of currentFormData.entries()) {
                if (value !== initialFormData.get(key)) {
                    hasChanges = true;
                    break;
                }
            }

            // Habilitar o deshabilitar el botón según haya cambios
            submitButton.disabled = !hasChanges;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar/ocultar contraseña.
        document.querySelectorAll(".toggle-password").forEach(button => {
            button.addEventListener("click", function() {
                let target = document.getElementById(this.getAttribute("data-target"));
                let icon = this.querySelector("i");
                
                if (target.type === "password") {
                    target.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    target.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            });
        });

        // Mantiene el script original de edición de usuario.
        document.getElementById("btnActualizarUsuario").addEventListener("click", function(event) {
            event.preventDefault(); // Evita que el formulario se envíe automáticamente

            Swal.fire({
                title: "¿Actualizar usuario?",
                text: "¿Estás seguro de que deseas actualizar este usuario?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, actualizar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    enviarFormulario();
                }
            });
        });

        function enviarFormulario() {
            let form = document.getElementById("formEditarUsuario");
            let formData = new FormData(form);
            formData.append("_method", "PUT"); // Laravel requiere este método para actualizar.

            fetch(form.action, {
                method: "POST", // Laravel espera POST con _method para PUT
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    "Accept": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Verificar si hubo cambios o no.
                    if (data.noChanges) {
                        // No se detectaron cambios.
                        Swal.fire({
                            title: "Sin cambios",
                            text: data.message || "No se detectaron modificaciones",
                            icon: "info",
                            confirmButtonText: "Aceptar"
                        }).then(() => {
                            window.location.href = "{{ route('user.index') }}";
                        });
                    } else {
                        // Hubo cambios y se actualizó correctamente.
                        Swal.fire({
                            title: "Éxito",
                            text: data.message || "Usuario actualizado correctamente",
                            icon: "success",
                            confirmButtonText: "Aceptar"
                        }).then(() => {
                            window.location.href = "{{ route('user.index') }}";
                        });
                    }
                } else {
                    let mensaje = "No se pudo actualizar el usuario";
                    if (data.errors) {
                        mensaje = Object.values(data.errors).flat().join("\n");
                    } else if (data.message) {
                        mensaje = data.message;
                    }
                    Swal.fire("Error", mensaje, "error");
                }
            })// Mensaje de error.
            .catch(error => {
                console.error("Error:", error);
                Swal.fire("Error", "Ocurrió un error inesperado", "error");
            });
        }
    });
</script>

@endsection
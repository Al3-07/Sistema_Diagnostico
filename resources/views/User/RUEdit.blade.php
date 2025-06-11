@extends('layouts.app')

@section('titulo', 'Editar Usuario')

@section('contenido')

<style>
    :root {
        --primary: #4361ee;
        --primary-light: #3f37c9;
        --secondary: #3a0ca3;
        --accent: #f72585;
        --light: #f8f9fa;
        --dark: #212529;
        --gray: #6c757d;
        --light-gray: #e9ecef;
        --success: #4cc9f0;
        --warning: #f8961e;
        --danger: #ef233c;
        --border-radius: 12px;
        --box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .edit-container {
        max-width: 900px;
        margin: 1rem auto;
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 1.5rem;
        border: none;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
    }

    .edit-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background:rgb(165, 165, 165);
    }

    @media (min-width: 768px) {
        .edit-container {
            padding: 2rem;
            margin: 2rem auto;
        }
    }

    @media (min-width: 992px) {
        .edit-container {
            margin-top: 60px;
            margin-left: 220px;
            margin-right: 20px;
        }
    }

    .edit-container:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
    }

    .edit-header {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    @media (min-width: 576px) {
        .edit-header {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    .edit-title {
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--dark);
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin: 0;
    }

    @media (min-width: 768px) {
        .edit-title {
            font-size: 1.8rem;
        }
    }

    .edit-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--primary);
        border-radius: 2px;
    }

    .form-section {
        margin-bottom: 1.5rem;
    }

    @media (min-width: 768px) {
        .form-section {
            margin-bottom: 2rem;
        }
    }

    .section-title {
        font-weight: 600;
        font-size: 1rem;
        color: var(--primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--light-gray);
    }

    @media (min-width: 768px) {
        .section-title {
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
        }
    }

    label {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: var(--dark);
        display: block;
    }

    @media (min-width: 768px) {
        label {
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid var(--light-gray);
        padding: 0.65rem 0.9rem;
        font-size: 0.95rem;
        color: var(--dark);
        transition: var(--transition);
        background-color: white;
        width: 100%;
    }

    @media (min-width: 768px) {
        .form-control {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        outline: none;
    }

    .form-control.is-invalid {
        border-color: var(--danger);
    }

    .invalid-feedback {
        font-size: 0.8rem;
        color: var(--danger);
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-row {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    @media (min-width: 576px) {
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
    }

    .form-group {
        margin-bottom: 1rem;
    }

    @media (min-width: 768px) {
        .form-group {
            margin-bottom: 1.2rem;
        }
    }

    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-group .form-control {
        padding-right: 2.5rem;
    }

    .input-group .btn {
        position: absolute;
        right: 0;
        background: transparent;
        border: none;
        color: var(--gray);
        padding: 0 0.75rem;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .input-group .btn:hover {
        color: var(--primary);
        background: transparent;
    }

    .footer-actions {
        display: flex;
        flex-direction: column-reverse;
        gap: 1.5rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--light-gray);
    }

    @media (min-width: 576px) {
        .footer-actions {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        width: 100%;
    }

    @media (min-width: 576px) {
        .action-buttons {
            flex-direction: row;
            justify-content: flex-end;
            gap: 1rem;
            width: auto;
        }
    }

    .btn-secondary, .btn-primary {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        white-space: nowrap;
    }

    .btn-secondary {
        background-color: var(--light-gray);
        color: var(--dark);
    }

    .btn-secondary:hover {
        background-color: #d1d5db;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
</style>

<div class="edit-container">
    <form id="formEditarUsuario" method="POST" action="{{ route('user.update', $usuario->id) }}">
        @csrf
        @method('PUT')

        <div class="edit-header">
            <h1 class="edit-title">Editar usuario</h1>
        </div>

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
                
                <!-- Campo Rol -->
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
                <!-- Campo Nueva Contraseña -->
                <div class="form-group">
                    <label for="passwordUsuario">Nueva contraseña (opcional):</label>
                    <div class="input-group">
                        <input type="password" id="passwordUsuario" name="password" class="form-control">
                        <button type="button" class="btn toggle-password" data-target="passwordUsuario">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Campo Confirmar Contraseña -->
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
    // Deshabilitar de actualizar
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("formEditarUsuario");
        const submitButton = document.querySelector("button[type='submit']"); 

        // Deshabilitar el botón al inicio
        submitButton.disabled = true;

        // Guardar valores originales
        const initialFormData = new FormData(form);

        form.addEventListener("input", function () {
            const currentFormData = new FormData(form);
            let hasChanges = false;

            // Comparar los valores actuales con los originales
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
        // Mostrar/ocultar contraseña
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

        // Mantiene el script original de edición de usuario
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
            formData.append("_method", "PUT"); // Laravel requiere este método para actualizar

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
                    // Verificar si hubo cambios o no
                    if (data.noChanges) {
                        // No se detectaron cambios
                        Swal.fire({
                            title: "Sin cambios",
                            text: data.message || "No se detectaron modificaciones",
                            icon: "info",
                            confirmButtonText: "Aceptar"
                        }).then(() => {
                            window.location.href = "{{ route('user.index') }}";
                        });
                    } else {
                        // Hubo cambios y se actualizó correctamente
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
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire("Error", "Ocurrió un error inesperado", "error");
            });
        }
    });
</script>

@endsection
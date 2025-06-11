@extends('layouts.app')

@section('titulo', 'Crear Usuario')

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
    
    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--light);
        color: var(--dark);
        font-size: 15px;
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
        background: rgb(165, 165, 165);
    }

    .edit-header {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1.5rem;
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

    .form-row {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    label {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: var(--dark);
        display: block;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid var(--light-gray);
        padding: 0.65rem 0.9rem;
        font-size: 0.95rem;
        color: var(--dark);
        transition: var(--transition);
        background-color: white;
        width: 100%;
    }

    .form-control:focus, .form-select:focus {
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

    .text-danger {
        color: var(--danger);
        font-size: 0.75rem;
        margin-top: 2px;
        display: block;
    }

    /* Password toggle */
    .input-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
    }
    
    .input-group .form-control {
        position: relative;
        flex: 1 1 auto;
        width: 1%;
        min-width: 0;
    }
    
    .input-group .btn {
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: 4;
        padding: 0 0.75rem;
        background-color: transparent;
        border: none;
        color: var(--gray);
    }

    /* Buttons */
.btn {
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    border: none;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    min-width: 120px;
    text-align: center;
}

.btn-secondary {
    background-color: var(--light-gray);
    color: var(--dark);
    border: 1px solid #d1d5db;
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

.btn-success {
    background-color:var(--primary);
    color: white;
}

.btn-success:hover {
    background-color:rgb(74, 141, 236);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

/* Footer Actions */
.footer-actions {
    display: flex;
    flex-direction: column-reverse;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--light-gray);
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    width: 100%;
}

/* Utility Classes */
.d-flex {
    display: flex;
}

.justify-content-end {
    justify-content: flex-end;
}

.gap-3 {
    gap: 1rem;
}

/* Responsive adjustments */
@media (min-width: 576px) {
    .footer-actions {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem;
    }

    .action-buttons {
        flex-direction: row;
        justify-content: flex-end;
        gap: 1.5rem;
        width: auto;
    }

    .btn {
        padding: 0.6rem 1.25rem;
        font-size: 0.9rem;
    }
}

@media (min-width: 768px) {
    .footer-actions {
        gap: 2rem;
    }

    .action-buttons {
        gap: 1.5rem;
    }

    .btn {
        padding: 0.7rem 1.5rem;
        font-size: 0.95rem;
        min-width: 140px;
    }
}
</style>

<div class="edit-container">
    <div class="edit-header">
        <h3 class="edit-title">
            <i class="fas fa-user-plus"></i>
            Registro de Usuario
        </h3>
    </div>

    <form id="formCrearUsuario">
        @csrf

        <div class="form-section">
            <h4 class="section-title">
                <i class="fas fa-info-circle"></i>
                Información Básica
            </h4>

            <div class="form-row">
                <!-- Campo Nombre. -->
                <div class="form-group">
                    <label class="form-label" for="nombreUsuario">Nombre:</label>
                    <input type="text" id="nombreUsuario" name="nombre" class="form-control" 
                    pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" 
                    title="Solo se permiten letras y espacios"
                    maxlength="15">
                </div>

                <!-- Campo Rol. -->
                <div class="form-group">
                    <label class="form-label" for="rolUsuario">Rol:</label>
                    <select id="rolUsuario" name="rol" class="form-select" required>
                        <option value="">Seleccione un rol</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Usuario">Usuario</option>
                        <option value="Visualizador">Visualizador</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h4 class="section-title">
                <i class="fas fa-lock"></i>
                Credenciales de Acceso
            </h4>

            <div class="form-row">
                <!-- Campo Contraseña. -->
                <div class="form-group">
                    <label class="form-label" for="passwordUsuario">Contraseña:</label>
                    <div class="input-group">
                        <input type="password" id="passwordUsuario" name="password" class="form-control" required>
                        <button type="button" class="btn toggle-password" data-target="passwordUsuario">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Campo Confirmar Contraseña. -->
                <div class="form-group">
                    <label class="form-label" for="passwordConfirmUsuario">Confirmar contraseña:</label>
                    <div class="input-group">
                        <input type="password" id="passwordConfirmUsuario" name="password_confirmation" class="form-control" required>
                        <button type="button" class="btn toggle-password" data-target="passwordConfirmUsuario">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones para guardar y regresar -->
        <div class="footer-actions">
            <div class="action-buttons">
                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Regresar
                </a>
                <button type="button" id="btnGuardarUsuario" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Guardar
                </button>
            </div>
        </div>
    </form>
</div>

<script>
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

    // Guardar usuario con confirmación de SweetAlert.
    document.getElementById("btnGuardarUsuario").addEventListener("click", function() {
        Swal.fire({
            title: "¿Guardar usuario?",
            text: "¿Estás seguro de que deseas crear este usuario?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, guardar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                enviarFormulario();
            }
        });
    });
    
    //Funcion para enviar el formulario.
    function enviarFormulario() {
        let formData = new FormData(document.getElementById("formCrearUsuario"));

        fetch("{{ route('user.store') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        })// mensaje de confirmacion y exito.
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: "Éxito",
                    text: data.message || "Usuario creado correctamente",
                    icon: "success",
                    confirmButtonText: "Aceptar"
                }).then(() => {
                    window.location.href = "{{ route('user.index') }}"; // Redirige a la lista de usuarios
                });
            } else {
                let mensaje = "No se pudo crear el usuario";
                if (data.errors) {
                    mensaje = Object.values(data.errors).flat().join("\n"); // Muestra errores correctamente
                }
                Swal.fire("Error", mensaje, "error");
            }
        })//Mensaje de error.
        .catch(error => {
            console.error("Error:", error);
            Swal.fire("Error", "Ocurrió un error al procesar la solicitud", "error");
        });
    }
});
</script>

@endsection
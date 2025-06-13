@extends('layouts.app')

@section('titulo', 'Crear Usuario')

@section('contenido')

<style>  
    :root { /* Fin del root. */
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
    
    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--light);
        color: var(--dark);
        font-size: 15px;
    } /* Fin del body. */

    .edit-container {
        max-width: 900px; /* Fin del max-width. */
        margin: 1rem auto; /* Fin del margin. */
        background: white; /* Fin del background. */
        border-radius: var(--border-radius); /* Fin del border-radius. */
        box-shadow: var(--box-shadow); /* Fin del box-shadow. */
        padding: 1.5rem; /* Fin del padding. */
        border: none;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
    } /* Fin del edit-container. */

    .edit-container::before {
        content: '';
        position: absolute; /* Fin del position. */
        top: 0; /* Fin del top. */
        left: 0; /* Fin del left. */
        width: 5px; /* Fin del width. */
        height: 100%; /* Fin del height. */
        background: rgb(165, 165, 165); /* Fin del background. */
    } /* Fin del edit-container::before. */

    .edit-header {
        display: flex; /* Fin del display. */
        flex-direction: column; /* Fin del flex-direction. */
        gap: 1rem; /* Fin del gap. */
        margin-bottom: 1.5rem; /* Fin del margin-bottom. */
    } /* Fin del edit-header. */

    .edit-title {
        font-weight: 700; /* Fin del font-weight. */
        font-size: 1.5rem; /* Fin del font-size. */
        color: var(--dark); /* Fin del color. */
        position: relative; /* Fin del position. */
        display: flex; /* Fin del display. */
        align-items: center; /* Fin del align-items. */
        gap: 0.8rem;
        margin: 0;
    } /* Fin del edit-title. */

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
    } /* Fin del form-section. */

    .section-title {
        font-weight: 600; /* Fin del font-weight. */
        font-size: 1rem; /* Fin del font-size. */
        color: var(--primary); /* Fin del color. */
        margin-bottom: 1rem; /* Fin del margin-bottom. */
        display: flex; /* Fin del display. */
        align-items: center; /* Fin del align-items. */
        gap: 0.6rem; /* Fin del gap. */
        padding-bottom: 0.5rem; /* Fin del padding-bottom. */
        border-bottom: 1px solid var(--light-gray); /* Fin del border-bottom. */
    } /* Fin del section-title. */

    .form-row {
        display: flex; /* Fin del display. */
        flex-direction: column; /* Fin del flex-direction. */
        gap: 1rem; /* Fin del gap. */
    } /* Fin del form-row. */

    .form-group {
        margin-bottom: 1rem; /* Fin del margin-bottom. */
    } /* Fin del form-group. */

    label {
        font-weight: 600; /* Fin del font-weight. */
        font-size: 0.9rem; /* Fin del font-size. */
        margin-bottom: 0.4rem;
        color: var(--dark);
        display: block;
    } /* Fin del label. */

    .form-control, .form-select {
        border-radius: 8px; /* Fin del border-radius. */
        border: 1px solid var(--light-gray); /* Fin del border. */
        padding: 0.65rem 0.9rem; /* Fin del padding. */
        font-size: 0.95rem; /* Fin del font-size. */
        color: var(--dark); /* Fin del color. */
        transition: var(--transition); /* Fin del transition. */
        background-color: white;
        width: 100%;
    } /* Fin del form-control, .form-select. */

    .form-control:focus, .form-select:focus { /* Fin del form-control:focus, .form-select:focus. */
        border-color: var(--primary); /* Fin del border-color. */
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15); /* Fin del box-shadow. */
        outline: none; /* Fin del outline. */
    }

    .form-control.is-invalid {
        border-color: var(--danger);
    }

    .invalid-feedback {
        font-size: 0.8rem; /* Fin del font-size. */
        color: var(--danger); /* Fin del color. */
        margin-top: 0.3rem; /* Fin del margin-top. */
        display: flex; /* Fin del display. */
        align-items: center; /* Fin del align-items. */
        gap: 0.3rem; /* Fin del gap. */
    }

    .text-danger {
        color: var(--danger); /* Fin del color. */
        font-size: 0.75rem; /* Fin del font-size. */
        margin-top: 2px; /* Fin del margin-top. */
        display: block; /* Fin del display. */
    }

    /* Password toggle */
    .input-group {
        position: relative;
        display: flex; /* Fin del display. */
        flex-wrap: wrap; /* Fin del flex-wrap. */
        align-items: stretch; /* Fin del align-items. */
        width: 100%; /* Fin del width. */
    } /* Fin del input-group. */
    
    .input-group .form-control { /* Fin del input-group .form-control. */
        position: relative; /* Fin del position. */
        flex: 1 1 auto; /* Fin del flex. */
        width: 1%; /* Fin del width. */
        min-width: 0; /* Fin del min-width. */
    } /* Fin del input-group .form-control. */
    
    .input-group .btn {
        position: absolute; /* Fin del position. */
        right: 0; /* Fin del right. */
        top: 0; /* Fin del top. */
        bottom: 0; /* Fin del bottom. */
        z-index: 4; /* Fin del z-index. */
        padding: 0 0.75rem; /* Fin del padding. */
        background-color: transparent; /* Fin del background-color. */
        border: none; /* Fin del border. */
        color: var(--gray); /* Fin del color. */
    } /* Fin del input-group .btn. */

    /* Buttons */
.btn {
    font-weight: 600; /* Fin del font-weight. */
    padding: 0.5rem 1rem; /* Fin del padding. */
    border-radius: 8px; /* Fin del border-radius. */
    font-size: 0.875rem; /* Fin del font-size. */
    transition: var(--transition); /* Fin del transition. */
    display: inline-flex; /* Fin del display. */
    align-items: center; /* Fin del align-items. */
    justify-content: center; /* Fin del justify-content. */
    gap: 0.5rem; /* Fin del gap. */
    border: none; /* Fin del border. */
    cursor: pointer; /* Fin del cursor. */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Fin del box-shadow. */
    min-width: 120px;
    text-align: center;
}

.btn-secondary {
    background-color: var(--light-gray); /* Fin del background-color. */
    color: var(--dark); /* Fin del color. */
    border: 1px solid #d1d5db; /* Fin del border. */
} /* Fin del btn-secondary. */

.btn-secondary:hover {
    background-color: #d1d5db; /* Fin del background-color. */
    transform: translateY(-2px); /* Fin del transform. */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); /* Fin del box-shadow. */
}

.btn-primary {
    background-color: var(--primary); /* Fin del background-color. */
    color: white;
} /* Fin del btn-primary. */

.btn-primary:hover {
    background-color: var(--primary-light); /* Fin del background-color. */
    transform: translateY(-2px); /* Fin del transform. */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); /* Fin del box-shadow. */
}

.btn-success {
    background-color:var(--primary); /* Fin del background-color. */
    color: white;
} /* Fin del btn-success. */

.btn-success:hover {
    background-color:rgb(74, 141, 236); /* Fin del background-color. */
    transform: translateY(-2px); /* Fin del transform. */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); /* Fin del box-shadow. */
}

/* Footer Actions. */
.footer-actions {
    display: flex; /* Fin del display. */
    flex-direction: column-reverse; /* Fin del flex-direction. */
    gap: 1rem; /* Fin del gap. */
    margin-top: 2rem; /* Fin del margin-top. */
    padding-top: 1.5rem; /* Fin del padding-top. */
    border-top: 1px solid var(--light-gray); /* Fin del border-top. */
}

.action-buttons {
    display: flex; /* Fin del display. */
    flex-direction: column; /* Fin del flex-direction. */
    gap: 1rem; /* Fin del gap. */
    width: 100%; /* Fin del width. */
}

/* Utility Classes. */
.d-flex {
    display: flex; /* Fin del display. */
} /* Fin del d-flex. */

.justify-content-end {
    justify-content: flex-end; /* Fin del justify-content. */
} /* Fin del justify-content-end. */

.gap-3 {
    gap: 1rem; /* Fin del gap. */
} /* Fin del gap-3. */

/* Responsive adjustments. */
@media (min-width: 576px) {
    .footer-actions {
        flex-direction: row; /* Fin del flex-direction. */
        justify-content: space-between; /* Fin del justify-content. */
        align-items: center; /* Fin del align-items. */
        gap: 1.5rem; /* Fin del gap. */
    } /* Fin del footer-actions. */

    .action-buttons {
        flex-direction: row; /* Fin del flex-direction. */
        justify-content: flex-end; /* Fin del justify-content. */
        gap: 1.5rem; /* Fin del gap. */
        width: auto; /* Fin del width. */
    } /* Fin del action-buttons. */

    .btn {
        padding: 0.6rem 1.25rem; /* Fin del padding. */
        font-size: 0.9rem; /* Fin del font-size. */
    } /* Fin del btn. */
} /* Fin del @media (min-width: 576px). */

@media (min-width: 768px) {
    .footer-actions {
        gap: 2rem; /* Fin del gap. */
    } /* Fin del footer-actions. */

    .action-buttons {
        gap: 1.5rem; /* Fin del gap. */
    }

    .btn {
        padding: 0.7rem 1.5rem; /* Fin del padding. */
        font-size: 0.95rem; /* Fin del font-size. */
        min-width: 140px; /* Fin del min-width. */
    } /* Fin del btn. */
}
</style>

<!-- Fin del style. -->
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

        <!-- Botones para guardar y regresar. -->
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
/* Fin del script. */
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
                    window.location.href = "{{ route('user.index') }}"; // Redirige a la lista de usuarios.
                });
            } else {
                let mensaje = "No se pudo crear el usuario";
                if (data.errors) {
                    mensaje = Object.values(data.errors).flat().join("\n"); // Muestra errores correctamente.
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
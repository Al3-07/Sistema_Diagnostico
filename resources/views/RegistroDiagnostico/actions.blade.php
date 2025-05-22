<div class="d-flex gap-2">
    <a href="{{ route('registrodiagnostico.show', $equipo->id) }}" class="btn btn-info btn-sm" title="Ver diagnóstico">
        <i class="fas fa-eye"></i>
    </a>

    @if(Auth::user()->role !== 'Visualizador')
        <!-- Botón de editar -->
        <a href="{{ route('registrodiagnostico.edit', $equipo->id) }}" class="btn btn-warning btn-sm" title="Editar diagnóstico">
            <i class="fas fa-edit"></i>
        </a>

        <!-- Botón de eliminación -->
        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $equipo->id }}" title="Eliminar diagnóstico">
            <i class="fas fa-trash"></i>
        </button>
    @endif
</div>

<!-- Importar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.delete-btn', function () {
        var equipoId = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Este diagnóstico será eliminado permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("registrodiagnostico.destroy", ":id") }}'.replace(':id', equipoId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Eliminado!', response.message, 'success');
                            $('#equipo-' + equipoId).remove();

                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        Swal.fire('Error!', 'Hubo un problema al eliminar el diagnóstico.', 'error');
                    }
                });
            }
        });
    });
</script>

@extends('Layouts.app')

@section('titulo', 'Detalles del Diagnóstico del Equipo')

@section('contenido')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>


<style>
    .img-mismo-tamano {
        width: 300px;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
        margin-bottom: 15px;
    }
    .btn-secondary {
        background-color: #f1f5f9;
        color: #000;
        border: none;
    }
    
    .btn-secondary:hover {
        background-color: #e2e8f0;
    }

    .foto-detalle {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
        margin-bottom: 15px;
    }

    .foto-container {
        margin-top: 15px;
    }

    .foto-label {
        font-weight: 600;
        color: #344767;
        margin-bottom: 5px;
        display: block;
    }
</style>

<div class="container mt-5">        
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #e2e8f0; color: #344767;">
            <h3 class="card-title mb-0">
                <i class="fas fa-tools me-2"></i><b>Detalles del Diagnóstico del Equipo</b>
            </h3>
            <a href="javascript:window.history.back();" class="btn btn-secondary btn-icon">
                <i class="fas fa-arrow-left"></i> 
            </a>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-md-6">
                     <p style="color: #334155;"><strong>Empresa:</strong> {{ $registro->empresa }}</p>
                    <p style="color: #334155;"><strong>Equipo:</strong> {{ $registro->equipo }}</p>
                    <p style="color: #334155;"><strong>Marca:</strong> {{ $registro->marca }}</p>
                    <p style="color: #334155;"><strong>Modelo:</strong> {{ $registro->modelo }}</p>
                    <p style="color: #334155;"><strong>Serie:</strong> {{ $registro->serie }}</p>
                </div>
                <div class="col-md-6">
                    <p style="color: #334155;"><strong>Descripción:</strong> {{ $registro->descripcion }}</p>
                    <p style="color: #334155;"><strong>Estado:</strong> {{ $registro->estado }}</p>

                    <div class="foto-container">
                     <span class="foto-label">Imagen Inicial:</span>
                     @if($registro->foto_antes)
                    <img src="{{ asset('img/post/' . $registro->foto_antes) }}" alt="Foto Antes" class="img-mismo-tamano">
                     @else
                    <p>No hay foto antes disponible.</p>
                    @endif
                    </div>

                    <div class="foto-container">
                        <span class="foto-label">Imagen Final:</span>
                        @if($registro->foto_despues)
                            <img src="{{ asset('img/post/' . $registro->foto_despues) }}" alt="Foto Después" class="img-mismo-tamano">
                        @else
                            <p>No hay foto después disponible.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session('success') }}'
        });
    </script>
@endif
<!-- Modal para la firma -->
<div class="modal fade" id="firmaModal" tabindex="-1" aria-labelledby="firmaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="firmaModalLabel">Firmar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <canvas id="firmaCanvas" width="500" height="200" style="border:1px solid #ccc;"></canvas>
        <div class="mt-3">
            <button class="btn btn-sm btn-secondary" id="limpiarFirma">Limpiar</button>
        </div>

        <form id="firmaForm" method="POST" action="{{ route('guardar.firma', $registro->id) }}">
            @csrf
            <input type="hidden" name="tipo_firma" id="tipoFirmaInput">
            <input type="hidden" name="firma" id="firmaInput">
            <button type="submit" class="btn btn-success mt-3">Guardar Firma</button>
        </form>

        @if(session('success'))
         <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @if(session('error'))
         <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif
      </div>
    </div>
  </div>
</div>
<script>
    const canvas = document.getElementById('firmaCanvas');
    const signaturePad = new SignaturePad(canvas);

    document.getElementById('limpiarFirma').addEventListener('click', function () {
        signaturePad.clear();
    });

    document.getElementById('firmaForm').addEventListener('submit', function (e) {
        if (signaturePad.isEmpty()) {
            e.preventDefault();
            alert("Por favor dibuja una firma.");
            return;
        }

        const firmaData = signaturePad.toDataURL();
        document.getElementById('firmaInput').value = firmaData;
    });

    // Cuando abres el modal, le pasas el tipo de firma
    function abrirModalFirma(tipo) {
        signaturePad.clear();
        document.getElementById('tipoFirmaInput').value = tipo;
        const modal = new bootstrap.Modal(document.getElementById('firmaModal'));
        modal.show();
    }
</script>
<!-- Firma de realizado -->
<button onclick="abrirModalFirma('realizado')" class="btn btn-primary btn-sm">Firmar Realizado</button>

<!-- Firma de supervisado -->
<button onclick="abrirModalFirma('supervisado')" class="btn btn-warning btn-sm">Firmar Supervisado</button>

<!-- Firma de recibido -->
<button onclick="abrirModalFirma('recibido')" class="btn btn-success btn-sm">Firmar Recibido</button>

<script>
    const canvas = document.getElementById('firmaCanvas');
    const ctx = canvas.getContext('2d');
    let dibujando = false;

    canvas.addEventListener('mousedown', () => dibujando = true);
    canvas.addEventListener('mouseup', () => dibujando = false);
    canvas.addEventListener('mousemove', dibujar);

    function dibujar(event) {
        if (!dibujando) return;
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.strokeStyle = '#000';

        ctx.lineTo(event.offsetX, event.offsetY);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(event.offsetX, event.offsetY);
    }

    // Limpiar firma
    document.getElementById('limpiarFirma').addEventListener('click', () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.beginPath();
    });

    // Antes de enviar el formulario, guardar la imagen en el input oculto
    document.getElementById('firmaForm').addEventListener('submit', function(e) {
        const dataUrl = canvas.toDataURL(); // Base64 de la imagen
        document.getElementById('firmaInput').value = dataUrl;
    });
</script>


<a href="{{ route('diagnostico.descargar', $registro->id) }}" class="btn btn-sm btn-primary" target="_blank">Descargar PDF</a>



</div>

@endsection

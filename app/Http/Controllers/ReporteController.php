<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroDiagnostico;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index(Request $request)
{
    $query = RegistroDiagnostico::with('empresa');

    // Si se ingresó fecha de inicio
    if ($request->filled('fecha_inicio')) {
        $query->whereDate('fecha', '>=', $request->fecha_inicio);
    }

    // Si se ingresó fecha de fin
    if ($request->filled('fecha_fin')) {
        $query->whereDate('fecha', '<=', $request->fecha_fin);
    }

    // Obtener los reportes (sin fechas se mostrarán todos)
    $reportes = $query->get()->sortBy([
        fn($r) => optional($r->empresa)->nombre,
        fn($r) => $r->created_at->timestamp * -1,
    ])->values();

    // Pasar fechas reales del request (no por defecto)
    return view('reportes.index', [
        'reportes' => $reportes,
        'ini' => $request->input('fecha_inicio'),
        'fin' => $request->input('fecha_fin')
    ]);
}


// PDF individual
    public function descargarPDFIndividual($id)
    {
        $reporte = RegistroDiagnostico::with('empresa')->findOrFail($id);

        $pdf = Pdf::loadView('reportes.pdf_individual', compact('reporte'));
        return $pdf->stream("reporte_{$reporte->id}.pdf");
    }

    // PDF por empresa
    public function descargarPDFPorEmpresa($empresa)
    {
        $reportes = RegistroDiagnostico::with('empresa')
->whereHas('empresa', fn($q) => $q->where('empresa', $empresa))
            ->get();

        $nombreEmpresa = $empresa;

        $pdf = Pdf::loadView('reportes.pdf_empresa', compact('reportes', 'nombreEmpresa'));
        return $pdf->stream("reporte_empresa_{$nombreEmpresa}.pdf");
    }

}

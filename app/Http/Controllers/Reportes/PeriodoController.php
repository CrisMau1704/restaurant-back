<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  // <-- Esta línea es necesar
  use App\Models\Pedido;


class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */


public function index(Request $request)
{
    $limit = $request->input('limit', 10);

    $query = Pedido::with(['cliente', 'user'])
        ->whereNotNull('fecha');

    if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
        $fecha_inicio = $request->fecha_inicio . ' 00:00:00';
        $fecha_fin = $request->fecha_fin . ' 23:59:59';
        $query->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
    }

    if ($request->filled('vendedor_id')) {
        $query->where('user_id', $request->vendedor_id);
    }

    // Total general antes de paginar
    $totalMonto = (clone $query)->sum('monto_total');

    // Paginar correctamente
    $ventas = $query->orderBy('fecha', 'desc')->paginate($limit);

    return response()->json([
        'data' => $ventas->items(),           // Datos de esta página
        'totalRecords' => $ventas->total(),   // Total de registros (para el paginador)
        'cantidad' => $ventas->total(),       // También lo puedes usar como cantidad total
        'total' => $totalMonto,               // Suma de los montos totales
        'perPage' => $ventas->perPage(),
        'currentPage' => $ventas->currentPage(),
        'lastPage' => $ventas->lastPage(),
    ]);
}




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

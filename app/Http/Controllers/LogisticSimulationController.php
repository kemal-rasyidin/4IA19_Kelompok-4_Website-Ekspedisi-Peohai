<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LogisticCalculatorService;
use App\Models\LogisticRate;

class LogisticSimulationController extends Controller
{
    protected $calculator;

    public function __construct(LogisticCalculatorService $calculator)
    {
        $this->calculator = $calculator;
    }

    public function index()
    {
        $ports = LogisticRate::select('origin_port', 'destination_port')
            ->distinct()
            ->get();

        return view('logistic.simulation', compact('ports'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'origin_port' => 'required|string',
            'destination_port' => 'required|string',
            'container_type' => 'required|in:20ft,40ft',
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            $result = $this->calculator->calculate(
                $request->origin_port,
                $request->destination_port,
                $request->container_type,
                $request->quantity
            );

            return response()->json([
                'success' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}

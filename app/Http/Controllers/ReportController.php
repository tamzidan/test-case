<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan keuangan sederhana.
     */
    public function index(Request $request)
    {
        // 1. Cek Otorisasi (Hanya Manager & Finance yang boleh lihat)
        // Kita pakai Gate manual karena ReportController bukan Resource Controller standar
        if (!Gate::allows('view-reports')) {
            abort(403, 'Anda tidak memiliki akses ke laporan.');
        }

        // 2. Setup Filter Tanggal (Default: Bulan Ini)
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // 3. Query Data Finance
        $query = Finance::whereBetween('date', [$startDate, $endDate]);

        // 4. Hitung Total Income & Expense
        // Kita clone query agar tidak merusak query utama saat sum()
        $totalIncome = (clone $query)->where('type', 'income')->sum('amount');
        $totalExpense = (clone $query)->where('type', 'expense')->sum('amount');

        // Hitung Saldo Bersih
        $netProfit = $totalIncome - $totalExpense;

        // Ambil detail data untuk ditampilkan di tabel (opsional tapi berguna)
        $details = $query->orderBy('date', 'desc')->get();

        return view('reports.index', compact(
            'totalIncome',
            'totalExpense',
            'netProfit',
            'details',
            'startDate',
            'endDate'
        ));
    }
}

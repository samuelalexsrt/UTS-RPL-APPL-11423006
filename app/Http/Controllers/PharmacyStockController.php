<?php

namespace App\Http\Controllers;

use App\Models\PharmacyStock;
use Illuminate\Http\Request;

class PharmacyStockController extends Controller
{
    public function index()
    {
        return view('pharmacy.stocks.index', [
            'stocks' => PharmacyStock::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('pharmacy.stocks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'drug_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:0'],
            'supplier' => ['nullable', 'string', 'max:255'],
            'last_updated_at' => ['nullable', 'date'],
        ]);

        PharmacyStock::create($data);

        return redirect()->route('pharmacy.index')->with('success', 'Stok farmasi berhasil ditambahkan.');
    }

    public function edit(PharmacyStock $stock)
    {
        return view('pharmacy.stocks.edit', [
            'stock' => $stock,
        ]);
    }

    public function update(Request $request, PharmacyStock $stock)
    {
        $data = $request->validate([
            'drug_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:0'],
            'supplier' => ['nullable', 'string', 'max:255'],
            'last_updated_at' => ['nullable', 'date'],
        ]);

        $stock->update($data);

        return redirect()->route('pharmacy.index')->with('success', 'Stok farmasi berhasil diperbarui.');
    }

    public function destroy(PharmacyStock $stock)
    {
        $stock->delete();

        return redirect()->route('pharmacy.index')->with('success', 'Stok farmasi berhasil dihapus.');
    }
}

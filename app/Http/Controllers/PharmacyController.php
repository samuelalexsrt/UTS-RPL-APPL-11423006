<?php

namespace App\Http\Controllers;

use App\Models\PharmacyStock;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index()
    {
        $items = PharmacyStock::orderBy('name')->get();

        return view('pharmacy', compact('items'));
    }

    public function create()
    {
        $this->authorizeRole(['admin', 'pharmacist']);

        return view('pharmacy-form');
    }

    public function store(Request $request)
    {
        $this->authorizeRole(['admin', 'pharmacist']);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        PharmacyStock::create($data);

        return redirect()->route('pharmacy.index')->with('success', 'Stok obat berhasil ditambahkan.');
    }

    public function edit(PharmacyStock $pharmacy)
    {
        $this->authorizeRole(['admin', 'pharmacist']);

        return view('pharmacy-form', ['item' => $pharmacy]);
    }

    public function update(Request $request, PharmacyStock $pharmacy)
    {
        $this->authorizeRole(['admin', 'pharmacist']);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $pharmacy->update($data);

        return redirect()->route('pharmacy.index')->with('success', 'Stok obat diperbarui.');
    }

    public function destroy(PharmacyStock $pharmacy)
    {
        $this->authorizeRole(['admin', 'pharmacist']);

        $pharmacy->delete();

        return redirect()->route('pharmacy.index')->with('success', 'Stok obat dihapus.');
    }

    protected function authorizeRole(array $roles)
    {
        if (! in_array(auth()->user()->role, $roles, true)) {
            abort(403);
        }
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Pesanan;

class PesananExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pesanan::with('meja', 'detail_pesanan')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'User', 
            'Nomer meja',
            'Menu yang dipesan',
            'Created at',
            'Updated at'
        ];   
    }

    public function map($pesanan): array
    {
        return [
            $pesanan->id,
            $pesanan->user->username,
            $pesanan->meja->nomer,
            $pesanan->detail_pesanan->map(function ($detail) {
                return $detail->menu->nama.' ('.$detail->jumlah.')';
            }),
            $pesanan->created_at,
            $pesanan->updated_at,
        ];
    }
}

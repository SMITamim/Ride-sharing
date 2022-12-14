<?php

namespace App\Exports;
use App\Models\Ride;
use Maatwebsite\Excel\Concerns\FromCollection;

class RideExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ride::all();
    }
}

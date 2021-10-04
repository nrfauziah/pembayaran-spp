<?php

namespace App\Exports\Siswa;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\Siswa;

class MultiExport implements WithMultipleSheets
{
    private $siswa;
    private $headings;
    public function __construct($siswa)
    {
        $this->siswa = $siswa;
    }
    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->siswa as $key => $value) {
            $getData = Siswa::where('kelas_id', $value->kelas_id)->has('kelas')->get(); // get all kelas;
            $sheets[] = new SiswaExport($this->siswa, $value->kelas, $getData); // save kelas shhets to array
        }
        return $sheets; // return sheets and go siswaExport
}
}

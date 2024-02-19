<?php

namespace Database\Seeders;

use App\Models\Server;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // need to fetch data from a xlsx and insert it into the database

        $sheet = new Spreadsheet();
        $sheet->getActiveSheet()->fromArray(IOFactory::load(storage_path('app/public/servers.xlsx'))->getActiveSheet()->toArray());
        $data = $sheet->getActiveSheet()->toArray();

        // remove the first row
        array_shift($data);

        foreach ($data as $row) {
            Server::create([
                'model' => $row[0],
                'ram' => $row[1],
                'hdd' => $row[2],
                'location' => $row[3],
                'price' => $row[4],
            ]);
        }
    }
}

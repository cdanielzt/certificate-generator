<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row = 1;
        if (($handle = fopen(base_path("public/import/asistenciaCursos.csv"), "r")) !== false) {
            while (($data = fgetcsv($handle, 0, ",")) !== false) {
  
                $row++;
                
                $dbData = [
                    'id' => '"'.$data[0].'"', 
                    'nombre' => '"'.$data[1].'"', 
                    'email' => '"'.$data[2].'"' 
              
                ];

                $colNames = array_keys($dbData);

                $createQuery = 'INSERT INTO clientes ('.implode(',', $colNames).') VALUES ('.implode(',', $dbData).')';

                DB::statement($createQuery, $data);
                $this->command->info($row);
            }
            fclose($handle);
        }
    }
}

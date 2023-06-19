<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class composanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

           
        DB::table("composantes")->insert([
            'code_composante' => 'AC',
            'designation_composante' => 'Administration Centrale',
            

        ]);

        DB::table("composantes")->insert([
            'code_composante' => 'FDSE',
            'designation_composante' => 'Faculté de Droit et Sciences Economiques',
            

        ]);

        DB::table("composantes")->insert([
            'code_composante' => 'FLSH',
            'designation_composante' => 'Faculté des Lettres et Sciences Humaines',
        

        ]);

        DB::table("composantes")->insert([

            'code_composante' => 'FIC',
            'designation_composante' => 'Faculté Imam Chafiou des Lettres Arabes et Sciences Islamiques',
          

        ]);

        DB::table("composantes")->insert([

            'code_composante' => 'FST',
            'designation_composante' => 'Faculté des Sciences et Techniques ',
            

        ]);

        DB::table("composantes")->insert([
            'code_composante' => 'IUT',
            'designation_composante' => 'Institut Universitaire de Technologie ',
       

        ]);



        DB::table("composantes")->insert([
            'code_composante' => 'IFERE',
            'designation_composante' => 'Institut de Formation des Enseignants et de Recherche en Education',
     

        ]);

        DB::table("composantes")->insert([
            
            'code_composante' => 'EMSP',
            'designation_composante' => 'Ecole de Médecine et de Santé Publique',
           
            
        ]);

        DB::table("composantes")->insert([
            'code_composante' => 'CUP',
            'designation_composante' => 'Centre Universitaire de Patsy ',
   
            
        ]);
        DB::table("composantes")->insert([
            'code_composante' => 'CUM',
            'designation_composante' => 'Centre Universitaire de Mohéli',
       
            

        ]);

        DB::table("composantes")->insert([
            'code_composante' => 'SUFOP',
            'designation_composante' => 'Site Universitaire de Formation Permanente',
          
            

        ]);
    }
}

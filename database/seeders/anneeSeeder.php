<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class anneeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('annee')->insert([
            'designation_annee' => '2003-2004',
        ]);

        DB::table('annee')->insert([
            'designation_annee' => '2004-2005',
        ]);

        DB::table('annee')->insert([
            'designation_annee' => '2005-2006',
        ]);

        DB::table('annee')->insert([
            'designation_annee' => '2006-2007',
        ]);

        DB::table('annee')->insert([
            'designation_annee' => '2007-2008',
        ]);

        DB::table('annee')->insert([
            'designation_annee' => '2008-2009',
        ]);

        DB::table('annee')->insert([
            'designation_annee' => '2009-2010',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2010-2011',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2011-2012',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2012-2013',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2013-2014',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2014-2015',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2015-2016',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2016-2017',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2017-2018',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2018-2019',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2019-2020',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2020-2021',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2021-2022',
        ]);
        DB::table('annee')->insert([
            'designation_annee' => '2022-2023',
        ]);
    }
}

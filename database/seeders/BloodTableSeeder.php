<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Type_Blood;


class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()//seedكل ماتتنفذ ال
    {
        DB::table('type__bloods')->delete(); //tableامسح ال

        $bgs = ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];

        foreach ($bgs as  $bg) {
            Type_Blood::create(['Name' => $bg]);  //ونزله تاني
        }
    }
}

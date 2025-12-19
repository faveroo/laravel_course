<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["name" => "Brasil", "flag" => "br.svg", "capital" => "Brasília"],
            ["name" => "Argentina", "flag" => "ar.svg", "capital" => "Buenos Aires"],
            ["name" => "Colombia", "flag" => "co.svg", "capital" => "Bogota"],
            ["name" => "Peru", "flag" => "pe.svg", "capital" => "Lima"],
            ["name" => "Chile", "flag" => "cl.svg", "capital" => "Santiago"],
            ["name" => "Bolivia", "flag" => "bo.svg", "capital" => "La Paz"],
            ["name" => "Paraguay", "flag" => "py.svg", "capital" => "Asuncion"],
            ["name" => "Uruguai", "flag" => "uy.svg", "capital" => "Montevideo"],
            ["name" => "Equador", "flag" => "ec.svg", "capital" => "Quito"],
            ["name" => "Venezuela", "flag" => "ve.svg", "capital" => "Caracas"],
            ["name" => "Guiana", "flag" => "gy.svg", "capital" => "Georgetown"],
            ["name" => "Suriname", "flag" => "sr.svg", "capital" => "Paramaribo"],
        ];

        Country::insert($data);
    }
}

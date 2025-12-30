<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $clients = DB::table('client')->pluck('Nome')->count();
        $this->showRawData($clients);
    }

    private function showRawData($data): void
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    private function showDataTable($data): void
    {
        echo '<table border="1">';
        echo "<tr>";
        foreach ($data->first()->getAttributes() as $column => $value) {
            echo "<th>{$column}</th>";
        }
        echo "</tr>";
        foreach ($data as $client) {
            echo '<tr>';
            foreach ($client->getAttributes() as $value) {
                echo "<td>{$value}</td>";
            }
            echo '</tr>';
        }
        echo "</table>";
    }
}

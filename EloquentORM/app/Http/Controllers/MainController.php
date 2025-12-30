<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $clients = Client::all(['name'])->toArray();

        foreach ($clients as $client) {
            echo $client['name'];
            echo "<br>";
        }
    }
}

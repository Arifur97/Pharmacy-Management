<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Customer;
use App\Product_Warehouse;
use DB;
use Auth;
use Printing;
use Rawilk\Printing\Contracts\Printer;
use Spatie\Permission\Models\Role;
/*use vendor\autoload;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;*/

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('home');
    }

    public function index()
    {
        
        return view('index');
    }

}

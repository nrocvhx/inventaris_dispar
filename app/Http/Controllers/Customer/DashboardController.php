<?php

namespace App\Http\Controllers\Customer;

use App\Models\Vehicle;
use App\Models\Pegawai;
use App\Models\Inventaris;
use App\Models\Supplier;
use App\Models\Rent;
use App\Models\Order;
use App\Enums\OrderStatus;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $pegawai = Pegawai::all();
        $kendaraan = Vehicle::all();
        $inventaris = Inventaris::with('pegawai', 'kendaraan')->paginate(10);

        // Uncomment to debug the data
        // dd($inventaris);


        return view('customer.dashboard', compact('pegawai', 'kendaraan', 'inventaris'));
    }
}

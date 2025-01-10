<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use App\Helpers\DataTablesColumnsBuilder;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        validate_permission('dashboard.read');

        $user = auth()->user();

        $driver = DB::getDriverName();
        $dateFormat = $driver === 'sqlite'
            ? "strftime('%Y-%m', created_at)" // SQLite format
            : "DATE_FORMAT(created_at, '%Y-%m')"; // MySQL format


        $uniqueMonths = Tracking::select(DB::raw("$dateFormat as month"))
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->pluck('month');


        if ($request->ajax()) {
            $rows = Tracking::with(['shipment', 'receiver'])->offset($request->start)->limit($request->length);
            $totalRecords = Tracking::with(['shipment', 'receiver'])->count();

            return DataTables::of($rows)
                ->setTotalRecords($totalRecords)
                ->setFilteredRecords($totalRecords)
                ->addColumn('actions', function ($row) {
                    return Blade::render('
                    <div class="btn-group">
                        <div>
                            <a href="{{ route(\'admin.label.edit\', $row) }}" class="btn btn-default">Print Label</a>
                        </div>
                    </div>
                ', ['row' => $row->id]);
                })
                ->addColumn('created_at', function ($row) {
                    return Blade::render('
                    {{ $row->created_at->format(\'M d, Y\') }}
                ', ['row' => $row]);
                })
                ->addColumn('location', function ($row) {
                    return Blade::render('
                    {{ $row->receiver->name }}
                ', ['row' => $row]);
                })
                ->addColumn('updated_at', function ($row) {
                    return Blade::render('
                    {{ $row->shipment->package_description }}
                ', ['row' => $row]);
                })
                ->rawColumns(['actions', 'created_at', 'location'])
                ->make(true);
        }

        $tableConfigs = (new DataTablesColumnsBuilder(Tracking::class))
            ->setSearchable('awb_number')
            ->setOrderable('awb_number')
            ->setName('created_at', 'Created at')
            ->setName('location', 'Receiver')
            ->setName('updated_at', 'Package description')
            ->withActions()
            ->make();

        return view('admin.dashboard.index', compact('user', 'tableConfigs', 'uniqueMonths'));
    }

    public function filterIndex(Request $request, string $month)
    {
        $tableConfigs = Shipment::where('created_at', 'LIKE', "%$month%")
            ->orderByDesc('created_at')
            ->simplePaginate();

        return view('admin.filter.index', compact('tableConfigs', 'month'));
    }

    public function filterProcess()
    {
        $request = request()->validate([
            'created_at' => 'required'
        ]);

        $month = $request['created_at'];

        return redirect()->route('filter.index', $month);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\DataTablesColumnsBuilder;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Blade;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        validate_permission('trackings.read');

        if ($request->ajax()) {
            $rows = Tracking::offset($request->start)->limit($request->length);
            $totalRecords = Tracking::count();

            return DataTables::of($rows)
                ->setTotalRecords($totalRecords)
                ->setFilteredRecords($totalRecords)
                ->addColumn('actions', function ($row) {
                    return Blade::render('
                        <div class="btn-group">
                            @permission(\'trackings.update\')
                                <div>
                                    <a href="{{ route(\'admin.tracking.edit\', $row) }}" class="btn btn-default">Update Tracking</a>
                                </div>
                            @endpermission
                            @permission(\'trackings.delete\')
                                <div class="container-delete-btn">
                                    <button type="button" class="btn btn-danger delete-btn" data-destroy="{{ route(\'admin.tracking.destroy\', $row) }}">Delete</button>
                                </div>
                            @endpermission
                        </div>
                    ', ['row' => $row->id]);
                })
                ->addColumn('updated_at', function ($row) {
                    return Blade::render('
                        {{ $row->updated_at->format(\'M d, Y\') }}
                    ', ['row' => $row]);
                })
                ->rawColumns(['actions', 'updated_at', 'shipment_id', 'location'])
                ->make(true);
        }

        $tableConfigs = (new DataTablesColumnsBuilder(Tracking::class))
            ->setSearchable('awb_number')
            ->setOrderable('awb_number')
            ->setName('updated_at', 'Updated at')
            ->removeColumns(['created_at', 'shipment_id', 'location'])
            ->withActions()
            ->make();

        return view('admin.tracking.index', compact('tableConfigs'));
    }

    /**
     * Display the specified resource.
     */
    public function edit(Tracking $tracking)
    {
        validate_permission('trackings.create');

        return view('admin.tracking.edit', compact('tracking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        validate_permission('trackings.update');

        $tracking = Tracking::findOrFail($id);

        // Update status (overwrite)
        $tracking->status = $request->input('status');

        // Update location (append to existing data)
        $newLocation = $request->input('location');
        $existingLocations = $tracking->location ? explode(',', $tracking->location) : [];
        $updatedLocations = array_merge($existingLocations, [$newLocation]);
        $tracking->location = implode(',', $updatedLocations);

        $tracking->save();

        return redirect()->route('admin.tracking.index')->with('success', 'Tracking updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tracking $tracking): RedirectResponse
    {
        validate_permission('trackings.delete');

        $tracking->delete();

        return redirect()
            ->route('admin.tracking.index')
            ->with('success', 'Shipment label deleted successfully!');
    }

    public function search(Request $request)
    {
        $request->validate([
            'awb_number' => 'required|string|exists:trackings,awb_number',
        ]);

        $tracking = Tracking::where('awb_number', $request->awb_number)->first();

        if ($tracking) {
            $locations = explode(',', $tracking->location);
            return view('tracking.index', compact('tracking', 'locations'));
        }

        return redirect()->route('tracking.index')->with('error', 'Nomor resi tidak ditemukan.');
    }
}

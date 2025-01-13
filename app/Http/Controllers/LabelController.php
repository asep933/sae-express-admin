<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use Illuminate\Support\Facades\App;
use App\Helpers\TemplateHTML;

class LabelController extends Controller
{
    public function editLabel(Shipment $shipment)
    {
        return view('admin.label.edit', compact('shipment'));
    }

    public function printLabel(Shipment $shipment)
    {
        $data = request()->validate([
            'sender_name' => 'required|string',
            'sender_street_address' => 'required|string',
            'sender_city' => 'required|string',
            'sender_postal_code' => 'required|string',
            'sender_country' => 'required|string',
            'sender_no_handphone' => 'required|string',
            'receiver_name' => 'required|string',
            'receiver_street_address' => 'required|string',
            'receiver_city' => 'required|string',
            'receiver_state' => 'required|string',
            'receiver_postal_code' => 'required|string',
            'receiver_country' => 'required|string',
            'receiver_no_handphone' => 'required|string',
            'type' => 'required|string',
            'package_description' => 'required|string',
            'weight' => 'required|numeric|min:0.1',
            'chargeable_weight' => 'required|numeric|min:0.1',
            'volumetric' => 'required|numeric|min:0.1',
            'quantity' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:0.1',
            'width' => 'required|numeric|min:0.1',
            'length' => 'required|numeric|min:0.1',
        ]);

        $awbNumber = $shipment->tracking->awb_number;

        // Generate PDF label pengiriman
        $html = TemplateHTML::generateShippingLabelHTML($data, $shipment, $awbNumber);

        // Buat dan stream PDF
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->stream('shipping_label.pdf');
    }
}

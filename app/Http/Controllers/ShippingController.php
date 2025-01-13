<?php

namespace App\Http\Controllers;

use App\Models\Sender;
use App\Models\Receiver;
use App\Models\Shipment;
use App\Models\Tracking;
use Illuminate\Support\Facades\App;
use App\Helpers\TemplateHTML;
use App\Helpers\AWBNumber;

class ShippingController extends Controller
{
    public function index()
    {
        validate_permission('shipment.read');
        return view('admin.shipment.index');
    }

    public function store()
    {
        validate_permission('shipment.create');

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

        // Generate nomor AWB
        $awbNumber = AWBNumber::generateAWBNumber();

        // Simpan data pelacakan
        $tracking = Tracking::create([
            'user_id' => auth()->id(),
            'awb_number' => $awbNumber,
            'status' => 'Barang dikemas',
        ]);

        // Buat atau cari pengirim
        $sender = Sender::firstOrCreate(
            [
                'tracking_id' => $tracking->id,
                'name' => $data['sender_name'],
            ],
            [
                'street_address' => $data['sender_street_address'],
                'city' => $data['sender_city'],
                'postal_code' => $data['sender_postal_code'],
                'country' => $data['sender_country'],
                'no_handphone' => $data['sender_no_handphone'],
            ]
        );

        // Buat atau cari penerima
        $receiver = Receiver::firstOrCreate(
            [
                'tracking_id' => $tracking->id,
                'name' => $data['receiver_name'],
            ],
            [
                'street_address' => $data['receiver_street_address'],
                'city' => $data['receiver_city'],
                'state' => $data['receiver_state'],
                'postal_code' => $data['receiver_postal_code'],
                'country' => $data['receiver_country'],
                'no_handphone' => $data['receiver_no_handphone'],
            ]
        );

        // Simpan pengiriman
        $shipment = Shipment::create([
            'user_id' => auth()->id(),
            'tracking_id' => $tracking->id,
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'type' => $data['type'],
            'package_description' => $data['package_description'],
            'weight' => $data['weight'] > $data['chargeable_weight'] ? $data['weight'] : $data['chargeable_weight'],
            'quantity' => $data['quantity'],
            'height' => $data['height'],
            'width' => $data['width'],
            'length' => $data['length'],
        ]);

        // Generate PDF label pengiriman
        $html = TemplateHTML::generateShippingLabelHTML($data, $shipment, $awbNumber);

        // Buat dan stream PDF
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->stream('shipping_label.pdf');
    }

    public function edit(Shipment $shipment)
    {
        validate_permission('shipment.update');

        return view('admin.shipment.edit', compact('shipment'));
    }

    public function update(Shipment $shipment)
    {
        validate_permission('shipment.update');

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



        // Buat atau cari pengirim
        $sender = Sender::find($shipment->sender_id);
        $sender->update(
            [
                'tracking_id' => $shipment->tracking_id,
                'name' => $data['sender_name'],
            ],
            [
                'street_address' => $data['sender_street_address'],
                'city' => $data['sender_city'],
                'postal_code' => $data['sender_postal_code'],
                'country' => $data['sender_country'],
                'no_handphone' => $data['sender_no_handphone'],
            ]
        );

        // Buat atau cari penerima
        $receiver = Receiver::find($shipment->receiver_id);
        $receiver->update(
            [
                'tracking_id' => $shipment->tracking_id,
                'name' => $data['receiver_name'],
            ],
            [
                'street_address' => $data['receiver_street_address'],
                'city' => $data['receiver_city'],
                'state' => $data['receiver_state'],
                'postal_code' => $data['receiver_postal_code'],
                'country' => $data['receiver_country'],
                'no_handphone' => $data['receiver_no_handphone'],
            ]
        );

        // Simpan pengiriman
        $shipment->update([
            'user_id' => auth()->id(),
            'tracking_id' => $shipment->tracking_id,
            'sender_id' => $shipment->sender_id,
            'receiver_id' => $shipment->receiver_id,
            'type' => $data['type'],
            'package_description' => $data['package_description'],
            'weight' => $data['weight'] > $data['chargeable_weight'] ? $data['weight'] : $data['chargeable_weight'],
            'quantity' => $data['quantity'],
            'height' => $data['height'],
            'width' => $data['width'],
            'length' => $data['length'],
        ]);

        return redirect()->route('admin.dashboard.index')->with('status', 'Data Succcessfully updated');
    }
}

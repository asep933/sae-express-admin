<?php

namespace App\Http\Controllers;

use App\Models\Sender;
use App\Models\Receiver;
use App\Models\Shipment;
use App\Models\Tracking;
use Illuminate\Support\Facades\App;
use Picqer\Barcode\Types\TypeCode128;
use Picqer\Barcode\Renderers\HtmlRenderer;

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
        $awbNumber = $this->generateAWBNumber();

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
        $html = $this->generateShippingLabelHTML($data, $shipment, $awbNumber);

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

    private function generateAWBNumber()
    {
        return str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
    }


    private function generateShippingLabelHTML($data, $shipment, $awbNumber)
    {
        $invoiceData = [
            'origin' => [
                'type' => 'Sender',
                'name' => $shipment->sender->name ?? 'N/A',
                'street_address' => $shipment->sender->street_address ?? 'N/A',
                'city' => $shipment->sender->city ?? 'N/A',
                'postal_code' => $shipment->sender->postal_code ?? 'N/A',
                'country' => $shipment->sender->country ?? 'N/A',
                'no_handphone' => $shipment->sender->no_handphone ?? 'N/A',
            ],
            'destination' => [
                'type' => 'Receiver',
                'name' => $shipment->receiver->name ?? 'N/A',
                'street_address' => $shipment->receiver->street_address ?? 'N/A',
                'city_name' => $shipment->receiver->city ?? 'N/A',
                'province' => $shipment->receiver->state ?? 'N/A',
                'postal_code' => $shipment->receiver->postal_code ?? 'N/A',
                'country' => $shipment->receiver->country ?? 'N/A',
                'no_handphone' => $shipment->receiver->no_handphone ?? 'N/A',
            ],
            'shipment_details' => [
                'awb_number' => $awbNumber,
                'type' => $shipment->type ?? 'N/A',
                'package_description' => $shipment->package_description ?? 'N/A',
                'weight' => $data['weight'] ?? 'N/A',
                'chargeable_weight' => $shipment->weight ?? 'N/A',
                'volumetric' => $data['volumetric'] ?? 'N/A',
                'quantity' => $shipment->quantity ?? 'N/A',
                'dimensions' => [
                    'height' => $shipment->height ?? 'N/A',
                    'width' => $shipment->width ?? 'N/A',
                    'length' => $shipment->length ?? 'N/A',
                ],
            ],
        ];

        $barcode = (new TypeCode128())->getBarcode($invoiceData['shipment_details']['awb_number']);
        $renderer = new HtmlRenderer();


        ob_start();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Shipping Label</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #ffffff;
                    width: 160mm;
                    height: 297mm;
                    border: 1px solid white;
                    padding: 10mm;
                    box-sizing: border-box;
                }

                p,
                pre,
                small,
                span {
                    margin: 0;
                    padding: 0;
                    font-size: 10px;
                    word-wrap: break-word;
                    white-space: normal;
                }

                pre {
                    font-family: Arial, Helvetica, sans-serif;
                }

                span {
                    text-transform: uppercase;
                }

                .weight-title {
                    font-weight: bold;
                }

                .title {
                    font-weight: bold;
                    font-size: 12px;
                }

                .label-container {
                    width: 160mm;
                    margin: 0 auto;
                    background: #ffffff;
                    padding: 10px;
                    border: 2px dashed #ddd;
                }

                .label-header {
                    display: table;
                    width: 100%;
                    margin-bottom: 10px;
                    border-spacing: 0;
                }

                .label-header>div {
                    display: table-cell;
                    vertical-align: top;
                    width: 33%;
                }

                .logo {
                    text-align: left;
                }

                .barcode {
                    text-align: center;
                }

                .company-info {
                    display: table-cell;
                    vertical-align: top;
                    text-align: right;
                    font-size: 8px;
                    color: #555;
                    padding: 0 0 0 32px;
                }

                .logo img {
                    height: 78px;
                    margin-bottom: 5px;
                }

                .awb {
                    font-size: 16px;
                    letter-spacing: 6px;
                }

                .shipment-info {
                    margin-top: 10px;
                    border: 1px solid black;
                    padding: 10px;
                }

                .sender-receiver {
                    display: table;
                    width: 100%;
                }

                .sender,
                .receiver {
                    display: table-cell;
                    width: 50%;
                    padding: 5px;
                }

                .receiver {
                    border-right: none;
                }

                .sender h2,
                .receiver h2 {
                    background-color: #bebebe;
                    color: white;
                    padding: 5px;
                    font-size: medium;
                    margin-bottom: 5px;
                }

                .weight {
                    display: table;
                    width: 100%;
                    border-spacing: 0 4px;
                    margin-top: 10px;
                }

                .row {
                    display: table-row;
                }

                .row div {
                    display: table-cell;
                    padding: 4px;
                    vertical-align: middle;
                }

                .container-head-table {
                    display: table;
                    width: 100%;
                    vertical-align: middle;
                }

                .head-table {
                    width: 50%;
                    display: table-cell;
                }

                .item-info>.container-head-table>.container-date {
                    width: 100%;
                    display: table;
                    border-spacing: 10px 15px;
                }

                .item-info>.container-head-table>.container-date>div {
                    display: table-cell;
                    margin-bottom: 5px;
                    padding: 10px;
                    margin-left: 1em;
                }

                .item-info>.container-head-table>.head-table>h2 {
                    font-size: medium;
                }

                .item-info {
                    margin-top: 10px;
                    border-top: 2px dashed #ddd;
                }

                .item-info h2 {
                    background-color: #bebebe;
                    color: white;
                    padding: 5px;
                    font-size: 10px;
                    margin-bottom: 5px;
                }

                .item-info table {
                    width: 100%;
                    border-collapse: collapse;
                    font-size: 10px;
                }

                .item-info th,
                .item-info td {
                    border: 1px solid #ddd;
                    padding: 5px;
                    text-align: left;
                }

                .label-footer {
                    margin-top: 10px;
                    text-align: right;
                }

                .qr-code img {
                    width: 60px;
                    height: 60px;
                }
            </style>


        </head>

        <body>
            <div class="label-container">
                <header class="label-header">
                    <div class="logo">
                        <img src="logo.png" alt="SAE Express Logo" />
                    </div>

                    <div class="barcode">
                        <?= $renderer->render($barcode) ?>
                        <p class="awb"><?= $invoiceData['shipment_details']['awb_number'] ?? 'N/A' ?></p>
                    </div>

                    <div class="company-info">
                        <p>
                            Dusun Wanguk Lor Timur, RT 020 RW 009 <br />
                            Desa.Kadungwungu, Kec.Anjatan, Kab.Indramayu<br />
                            Prov. Jawa Barat - Indonesia 45256<br />
                        </p>
                    </div>
                </header>

                <section class="shipment-info">
                    <div class="sender-receiver">
                        <div class="sender">
                            <h2>PENGIRIM (From/Shipper)</h2>
                            <div>
                                <pre>Name          :   <span><?= $invoiceData['origin']['name'] ?></span></pre>
                                <small>(Name)</small>
                            </div>
                            <div class="adress">
                                <pre>Alamat        : <span><?= $invoiceData['origin']['street_address'] ?></span></pre>
                                <small>(Address)</small>
                            </div>
                            <div>
                                <pre>Kab/Kota      :   <?= $invoiceData['origin']['city'] ?></pre>
                                <small>(City)</small>
                            </div>
                            <div>
                                <pre>Kode Pos      :   <?= $invoiceData['origin']['postal_code'] ?? 'N/A' ?></pre>
                                <small>(Postal Code)</small>
                            </div>
                        </div>

                        <div class="receiver">
                            <h2>PENERIMA (To/Receiver)</h2>
                            <div>
                                <pre>Name          :   <span><?= $invoiceData['destination']['name'] ?></span></pre>
                                <small>(Name)</small>
                            </div>
                            <div class="adress">
                                <pre>Alamat        :  <span><?= $invoiceData['destination']['street_address'] ?></span></pre>
                                <small>(Address)</small>
                            </div>
                            <div>
                                <pre>Kab/Kota      :   <?= $invoiceData['destination']['city_name'] ?></pre>
                                <small>(City)</small>
                            </div>
                            <div>
                                <pre>Kode Pos      :   <?= $invoiceData['destination']['postal_code'] ?></pre>
                                <small>(Postal Code)</small>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="weight">
                    <div class="row">
                        <div>
                            <p><span class="weight-title">Berat Aktual</span> : <?= $invoiceData['shipment_details']['weight'] ?> kg</p>
                            <small>(Actual Weight)</small>
                        </div>
                        <div>
                            <p><span class="weight-title">Komoditas</span> : <?= $invoiceData['shipment_details']['type'] ?></p>
                            <small>(Commodity)</small>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <p><span class="weight-title">Volumetrik</span> : <?= $invoiceData['shipment_details']['volumetric'] ?> kg</p>
                            <small>(Volumetric)</small>
                        </div>
                        <div>
                            <p><span class="weight-title">Berat Dihitung</span> : <?= $invoiceData['shipment_details']['chargeable_weight'] ?> kg</p>
                            <small>(Chargeable Weight)</small>
                        </div>
                    </div>
                </section>


                <section class="item-info">
                    <div class="container-head-table">
                        <div class="head-table">
                            <h2>DAFTAR BARANG (List of Items)</h2>
                        </div>

                        <div class="container-date">
                            <div>
                                <p><span class="weight-title">Tanggal Pengiriman</span> : <?= date('d/m/Y H:i', strtotime($shipment->shipping_date ?? 'now')) ?></p>
                                <small>(Shipping of Date)</small>
                            </div>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Nama Barang<br><small>(Name Goods)</small></th>
                                <th>Kuantitas<br><small>(Quantity)</small></th>
                                <th>Tinggi (cm)<br><small>(Height)</small></th>
                                <th>Lebar (cm)<br><small>(Width)</small></th>
                                <th>Panjang (cm)<br><small>(Length)</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $invoiceData['shipment_details']['package_description'] ?></td>
                                <td><?= $invoiceData['shipment_details']['quantity'] ?></td>
                                <td><?= $invoiceData['shipment_details']['dimensions']['height'] ?> cm</td>
                                <td><?= $invoiceData['shipment_details']['dimensions']['width'] ?> cm</td>
                                <td><?= $invoiceData['shipment_details']['dimensions']['length'] ?> cm</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <footer class="label-footer">
                    <div class="qr-code">
                        <img src="qr-code.png" alt="QR Code" />
                    </div>
                </footer>
            </div>
        </body>


        </html>


<?php
        return ob_get_clean();
    }
}

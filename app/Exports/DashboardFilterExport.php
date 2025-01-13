<?php

namespace App\Exports;

use App\Models\Shipment;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DashboardFilterExport implements FromArray, WithHeadings, WithEvents, Responsable
{
    private $month;
    private $userID;
    private $shipmentUserID;
    private $fileName;

    public function __construct($month)
    {
        $this->month = $month;
        $this->fileName = 'dashboard-table-' . $month . '.xlsx';
        $this->userID = auth()->id();
        $this->shipmentUserID = Shipment::where('user_id', 'LIKE', "%$this->userID%")->pluck('user_id');
    }

    /**
     * Implementasi method toResponse untuk memenuhi interface Responsable.
     */
    public function toResponse($request): BinaryFileResponse
    {
        return Excel::download($this, $this->fileName);
    }

    public function array(): array
    {
        return Shipment::where('created_at', 'LIKE', "%$this->month%")
            ->whereIn('user_id', $this->shipmentUserID)
            ->get()
            ->map(function ($shipment) {
                return [
                    'AWB Number' => $shipment->tracking->awb_number ?? 'N/A',
                    'Status' => $shipment->tracking->status ?? 'N/A',
                    'Location' => $shipment->tracking->location ?? 'N/A',
                    'Sender Name' => $shipment->sender->name ?? 'N/A',
                    'Sender Address' => $shipment->sender->street_address ?? 'N/A',
                    'Sender City' => $shipment->sender->city ?? 'N/A',
                    'Sender Country' => $shipment->sender->country ?? 'N/A',
                    'Sender Phone' => $shipment->sender->no_handphone ?? 'N/A',
                    'Receiver Name' => $shipment->receiver->name ?? 'N/A',
                    'Receiver Address' => $shipment->receiver->street_address ?? 'N/A',
                    'Receiver City' => $shipment->receiver->city ?? 'N/A',
                    'Receiver Country' => $shipment->receiver->country ?? 'N/A',
                    'Receiver Phone' => $shipment->receiver->no_handphone ?? 'N/A',
                    'Package Description' => $shipment->package_description,
                    'Type' => $shipment->type,
                    'Weight' => $shipment->weight,
                    'Dimensions (LxWxH)' => $shipment->length . 'x' . $shipment->width . 'x' . $shipment->height,
                    'Quantity' => $shipment->quantity,
                    'Created At' => $shipment->created_at->format('Y-m-d H:i:s'),
                ];
            })
            ->toArray();
    }

    public function headings(): array
    {
        return [
            'AWB Number',
            'Status',
            'Location',
            'Sender Name',
            'Sender Address',
            'Sender City',
            'Sender Country',
            'Sender Phone',
            'Receiver Name',
            'Receiver Address',
            'Receiver City',
            'Receiver Country',
            'Receiver Phone',
            'Package Description',
            'Type',
            'Weight',
            'Dimensions (LxWxH)',
            'Quantity',
            'Created At',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $cellRange = 'A1:S' . ($sheet->getHighestRow());
                $sheet->getDelegate()->setAutoFilter($cellRange);
                $sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setHorizontal('center');
                $sheet->getDelegate()->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle('thin');

                foreach (range('A', $sheet->getHighestColumn()) as $col) {
                    $sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}

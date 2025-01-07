<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = ['awb_number', 'status', 'location'];

    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'tracking_id', 'id');
    }
    public function sender()
    {
        return $this->hasOne(Sender::class, 'tracking_id', 'id');
    }
    public function receiver()
    {
        return $this->hasOne(Receiver::class, 'tracking_id', 'id');
    }
}

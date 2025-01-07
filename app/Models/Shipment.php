<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_id',
        'sender_id',
        'receiver_id',
        'type',
        'package_description',
        'weight',
        'quantity',
        'height',
        'width',
        'length',
    ];

    protected $with = ['tracking', 'sender', 'receiver'];

    public function tracking()
    {
        return $this->belongsTo(Tracking::class, 'tracking_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(Sender::class, 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(Receiver::class, 'receiver_id', 'id');
    }
}

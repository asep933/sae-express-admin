<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;

    protected $fillable = ['tracking_id', 'name', 'street_address', 'city', 'state', 'postal_code', 'country', 'no_handphone'];

    public function tracking()
    {
        return $this->belongsTo(Tracking::class, 'tracking_id', 'id');
    }
    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'receiver_id', 'id');
    }
}

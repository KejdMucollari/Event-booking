<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'starts_at',
        'location',
        'ticket_price',
        'available_seats',
        'image'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'starts_at' => 'datetime',
    ];

    //vendosja e realtionship me booking

    public function bookings()
    {
        $this->hasMany(Booking::class);
    }
        
}

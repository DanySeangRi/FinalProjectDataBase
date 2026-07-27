<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'seat_id',
        'first_name',
        'last_name',
        'dob',
        'gender',
        'nationality',
        'id_passport',
        'phone',
        'email',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'dob' => 'date',
            'price' => 'decimal:2',
        ];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }

    public function getPassengerNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function getSeatNumberAttribute(): ?string
    {
        return $this->seat?->seat_number;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'route_schedule_id',
        'booking_code',
        'total_price',
        'status',
        'cancel_reason',
        'cancelled_at',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Booking $booking): void {
            $lastBooking = Booking::latest('id')->first();

            $number = $lastBooking
                ? $lastBooking->id + 1
                : 1;

            $booking->booking_code = 'MN'.str_pad(
                (string) $number,
                6,
                '0',
                STR_PAD_LEFT
            );
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function routeSchedule(): BelongsTo
    {
        return $this->belongsTo(RouteSchedule::class, 'route_schedule_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function bookingDetails(): HasMany
    {
        return $this->details();
    }

    public function seats(): BelongsToMany
    {
        return $this->belongsToMany(
            Seat::class,
            'booking_seats'
        );
    }

    public function bookingSeats(): HasMany
    {
        return $this->hasMany(BookingSeat::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function statusLabel(): string
    {
        return ucfirst($this->status);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'random_id',
        'name',
        'father_name',
        'mother_name',
        'passport_number',
        'cnic_number',
        'age',
        'city',
        'applied_country',
        'applied_company',
        'applied_position',
        'test_status',
        'payment_status',
        'cv_status',
        'visa_status',
        'remarks',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($candidate) {
            $candidate->random_id = self::generateRandomId();
        });
    }

    private static function generateRandomId()
    {
        $randomId = mt_rand(100000, 999999); // Generate a 6-digit random number
        while (self::where('random_id', $randomId)->exists()) {
            $randomId = mt_rand(100000, 999999); // Ensure uniqueness
        }
        return $randomId;
    }
}
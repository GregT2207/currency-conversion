<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Money;

class User extends Model
{
    use HasFactory;

    public function convertCurrency($newCurrency)
    {
        $hourlyRate = new Money($this->hourly_rate, $this->currency);

        $this->hourly_rate = $hourlyRate->convertCurrency($newCurrency);
        $this->currency = $newCurrency;
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Money;

class ConvertCurrencyTest extends TestCase
{
    public function test_convert_currency_with_external_exchange_rates()
    {
        config(['user.exchange_rates' => 'external']);

        $money = new Money(50, 'GBP');
        $newValue = $money->convertCurrency('USD');

        $this->assertTrue($newValue > 0);
    }

    public function test_convert_currency_with_local_exchange_rates()
    {
        config(['user.exchange_rates' => 'local']);

        $money = new Money(24.56, 'EUR');
        $newValue = $money->convertCurrency('GBP');

        $this->assertTrue($newValue > 0);
    }

    public function test_convert_to_invalid_currency()
    {
        $money = new Money(1, 'USD');
        $newValue = $money->convertCurrency('notacurrency');

        $this->assertFalse($newValue);
    }
}

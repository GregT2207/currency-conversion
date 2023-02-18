<?php

namespace App;

use Illuminate\Support\Facades\Http;

class Money
{
    private $value;
    private $currency;

    public function __construct($value, $currency) {
        $this->value = $value;
        $this->currency = strtoupper($currency);
    }

    public function getExchangeRates()
    {
        // Get up to date rates from "Exchange Rates API"
        $apiSuccess = false;
        if (config('user.exchange_rates') == 'external') {
            $response = Http::withHeaders([
                'apikey' => env('EXCHANGE_RATES_KEY')
            ])->get("https://api.apilayer.com/exchangerates_data/latest?base={$this->currency}&symbols=GBP,EUR,USD");

            if ($response->ok()) {
                return $response->json('rates');

                $apiSuccess = true;
            }
        }

        // Get hard-coded approximate rates
        if (config('user.exchange_rates') == 'local' || !$apiSuccess) {
            switch ($this->currency) {
                case 'GBP':
                    return [
                        'GBP' => 1.0,
                        'USD' => 1.3,
                        'EUR' => 1.1,
                    ];

                case 'EUR':
                    return [
                        'EUR' => 1.0,
                        'GBP' => 0.9,
                        'USD' => 1.2,
                    ];

                case 'USD':
                    return [
                        'USD' => 1.0,
                        'GBP' => 0.7,
                        'EUR' => 0.8,
                    ];
            }
        }
    }

    public function convertCurrency($newCurrency)
    {
        $exchangeRates = $this->getExchangeRates();

        return round($this->value * $exchangeRates[strtoupper($newCurrency)], 2);
    }
}
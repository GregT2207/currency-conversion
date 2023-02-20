<?php

namespace App;

use Illuminate\Support\Facades\Http;

class Money
{
    public $value;
    public $currency;
    
    protected $currencies = [
        'GBP',
        'EUR',
        'USD',
    ];

    public function __construct($value, $currency) {
        $this->value = $value;
        $this->currency = strtoupper($currency);
    }

    public function getExchangeRates()
    {
        // Get up to date rates from "Exchange Rates API"
        if (config('user.exchange_rates') == 'external') {
            return $this->getExternalExchangeRates();
        }

        // Get hard-coded approximate rates
        if (config('user.exchange_rates') == 'local') {
            return $this->getLocalExchangeRates();
        }
    }

    public function getExternalExchangeRates()
    {
        $currenciesStr = implode(',', $this->currencies);

        try {
            $response = Http::withHeaders([
                'apikey' => env('EXCHANGE_RATES_KEY')
            ])->get("https://api.apilayer.com/exchangerates_data/latest?base={$this->currency}&symbols={$currenciesStr}");

            return $response->json('rates');
        } catch (Exception $e) {
            // Fall back to local rates if api call fails
            return $this->getLocalExchangeRates();
        }
    }

    public function getLocalExchangeRates()
    {
        // Make sure to add a case for any new entries in $this->currencies
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

    public function convertCurrency($newCurrency)
    {
        if (!in_array($newCurrency, $this->currencies)) {
            return false;
        }

        $exchangeRates = $this->getExchangeRates();

        return round($this->value * $exchangeRates[strtoupper($newCurrency)], 2);
    }
}
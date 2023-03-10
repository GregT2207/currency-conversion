<?php

namespace App;

use Illuminate\Support\Facades\Http;
use Exception;

class Money
{
    public $value;
    public $currency;
    public $exchangeRates;
    
    protected $currencies = [
        'GBP',
        'EUR',
        'USD',
    ];

    public function __construct($value, $currency)
    {
        $this->value = $value;
        $this->currency = strtoupper($currency);

        $this->setExchangeRates();
    }

    public function setExchangeRates()
    {
        // Get up to date rates from "Exchange Rates API"
        if (config('user.exchange_rates') == 'external') {
            $this->exchangeRates = $this->getExternalExchangeRates();
            return true;
        }

        // Get hard-coded approximate rates
        if (config('user.exchange_rates') == 'local') {
            $this->exchangeRates = $this->getLocalExchangeRates();
            return true;
        }
    }

    public function getExternalExchangeRates()
    {
        $currenciesStr = implode(',', $this->currencies);

        try {
            $response = Http::withHeaders([
                'apikey' => env('EXCHANGE_RATES_KEY')
            ])->get("https://api.apilayer.com/exchangerates_data/latest?base={$this->currency}&symbols={$currenciesStr}");

            if (!$response->json('rates')) {
                throw new Exception('Invalid response data');
            }

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
        $newCurrency = strtoupper($newCurrency);

        if (!in_array($newCurrency, $this->currencies)) {
            return false;
        }

        return round($this->value * $this->exchangeRates[$newCurrency], 2);
    }
}
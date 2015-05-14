<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Commands\ValidateTransaction;
use App\Validator\CurrencyTransactionValidator;

class CurrencyFairController extends Controller
{
	public function store(Request $request)
	{
	
		$rules = array(
				'userId' => 'required',
				'currencyFrom' => 'required|currency',	
				'currencyTo' => 'required|currency',
				'amountSell' => 'required',
				'amountBuy' => 'required',
				'rate' => 'required|rate:amountSell,amountBuy',
				'timePlaced' => 'required',
				'originatingCountry' => 'required|country'
				);
		$validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);

		if($validator->fails()) {
			return $validator->messages()->toJson();
		} else {
			\Illuminate\Support\Facades\Queue::push('App\Commands\ValidateTransaction', $request->all());
			echo 'Transaction accepted for processing';
		}
	}
	
	public function countryList(Request $request) {
		return json_encode(\App\Validators\CurrencyTransactionValidator::$countries);
	}

	public function currencyList(Request $request) {
		return json_encode(\App\Validators\CurrencyTransactionValidator::$currencies);
	}	
	
}

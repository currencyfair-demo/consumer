<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Commands\ValidateTransaction;

class CurrencyFairController extends Controller
{
	public function store(Request $request)
	{
		\Illuminate\Support\Facades\Queue::push('App\Commands\ValidateTransaction', $request->all());
//		$this->dispatch(new ValidateTransaction($request->all()));
	}
}

<?php

namespace App\Validators;

class CurrencyTransactionValidator extends \Illuminate\Validation\Validator {
      	public static $currencies = array('AED', 'AUD', 'CAD', 'CHF', 'CZK', 'DKK', 'EUR', 'GBP', 'HKD', 'HUF', 'NOK', 'NZD', 'PLN', 'SEK', 'USD', 'ZAR');
	public static $countries = array(
'AE', 'AF', 'AL', 'AM', 'AO', 'AQ', 'AR', 'AT', 'AU', 'AZ', 'BA', 'BB', 'BD', 'BE', 'BF', 'BG', 'BI', 'BJ', 'BN', 'BO', 'BR', 'BS', 'BT', 'BW', 'BY', 'BZ', 'CA', 'CC', 'CD', 'CF', 'CG', 'CH', 'CI', 'CL', 'CM', 'CN', 'CO', 'CR', 'CU', 'CY', 'CZ', 'DE', 'DJ', 'DK', 'DO', 'DZ', 'EC', 'EE', 'EG', 'EH', 'ER', 'ES', 'ET', 'FI', 'FJ', 'FK', 'FR', 'GA', 'GB', 'GE', 'GF', 'GH', 'GL', 'GM', 'GN', 'GQ', 'GR', 'GT', 'GW', 'GY', 'HN', 'HR', 'HT', 'HU', 'ID', 'IE', 'IL', 'IN', 'IQ', 'IR', 'IS', 'IT', 'JM', 'JO', 'JP', 'KE', 'KG', 'KH', 'KP', 'KR', 'KW', 'KZ', 'LA', 'LB', 'LK', 'LR', 'LS', 'LT', 'LU', 'LV', 'LY', 'MA', 'MD', 'ME', 'MG', 'MK', 'ML', 'MM', 'MN', 'MR', 'MW', 'MX', 'MY', 'MZ', 'NA', 'NC', 'NE', 'NG', 'NI', 'NL', 'NO', 'NP', 'NZ', 'OM', 'PA', 'PE', 'PG', 'PH', 'PK', 'PL', 'PR', 'PT', 'PY', 'QA', 'RO', 'RS', 'RU', 'RW', 'SA', 'SB', 'SD', 'SE', 'SI', 'SK', 'SL', 'SN', 'SO', 'SR', 'SV', 'SY', 'SZ', 'TD', 'TG', 'TH', 'TJ', 'TL', 'TM', 'TN', 'TR', 'TT', 'TW', 'TZ', 'UA', 'UG', 'US', 'UY', 'UZ', 'VE', 'VN', 'VU', 'ZA', 'ZM', 'ZW');		
	
	public function validateCurrency($attribute, $value, $parameters) {
		return in_array($value, self::$currencies);
	}
		
	public function validateCountry($attribute, $value, $parameters) {
		return in_array($value, self::$countries);	
	}
	
	public function validateRate($attribute, $value, $parameters) {
		$amountSell = array_get($this->data, $parameters[0]);
		$amountBuy = array_get($this->data, $parameters[1]);
		
		return $amountBuy == ($amountSell * $value);
	}
}

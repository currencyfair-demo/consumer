<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class ValidateTransaction extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	private static $LIST_LEN = 10;
	private $redis;

	private $transaction;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
		$this->redis = \Illuminate\Support\Facades\Redis::connection();
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle($transaction)
	{
	}

	public function fire($job, $data)
	{
		$this->broadcast_trnx($data);
		$this->store($data);
		$job->delete();
	}
	
	private function broadcast_trnx($data)
	{
		$this->redis->publish('trnx', json_encode($data));
	}

	/**
	 * Remember only last LIST_LEN transactions
	 *
	 */
	private function store($data)
	{
		$this->redis->lpush('transactions', json_encode($data));
		$this->redis->ltrim('transactions', 0, self::$LIST_LEN);
	}	

}

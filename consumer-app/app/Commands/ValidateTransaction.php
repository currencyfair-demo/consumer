<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class ValidateTransaction extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;
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
		$this->redis->publish('trnx', json_encode($data));
		$job->delete();
	}

}

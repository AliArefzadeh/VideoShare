<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class RemoveExpiredTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    /*protected $signature = 'command:name';*/
    protected $signature = 'tokens:remove_all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all expired token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiration = config('sanctum.expiration');
        if($expiration){
            $tokens = PersonalAccessToken::where('created_at', '<',now()->subMinute($expiration+(7*24*60)));
            $tokens->delete();
            return 0;
        }
        $this->warn('Expire time is not set.');
    }
}

<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ImportJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $data = json_decode(file_get_contents(base_path('media_m4/users.json')), true);

        foreach ($data as $row) {
            User::query()->create($row);
        }

        $this->info('OK!');
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;

class GeneratePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:permission {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Crud Permission';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $permission   = $this->argument('name');
        $actions = ['index', 'create', 'view', 'edit', 'delete'];
        foreach ($actions as $action) {
            $data = ['name' => $permission . '-' . $action];
            Permission::firstOrCreate($data);
        }
        return 0;
    }
}
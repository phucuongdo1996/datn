<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\User\UserRepositoryInterface;

class DestroySubUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sub-user:destroy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete sub-user every minute';


    /**
     * Execute the console command.
     *
     * @param \App\Repositories\User\UserEloquentRepository $userRepository
     *
     * @return mixed
     */
    public function handle(UserRepositoryInterface $userRepository)
    {
        $userRepository->destroySubUsers();
    }
}

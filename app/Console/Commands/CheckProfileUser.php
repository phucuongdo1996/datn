<?php

namespace App\Console\Commands;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Console\Command;

class CheckProfileUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-profile:destroy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete user dont have profile';

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
     *  Execute the console command.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function handle(UserRepositoryInterface $userRepository)
    {
        $userRepository->deleteUserDontHaveProfile();
    }
}

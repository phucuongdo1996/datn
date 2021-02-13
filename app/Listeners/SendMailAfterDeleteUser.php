<?php

namespace App\Listeners;

use App\Events\SendMailDeleteUser;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeleteUser;

class SendMailAfterDeleteUser implements ShouldQueue
{
    /**
     * @var UserRepositoryInterface|\App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * SendMailAfterDeleteUser constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the event.
     *
     * @param  SendMailDeleteUser  $event
     * @return void
     */
    public function handle(SendMailDeleteUser $event)
    {
        Mail::to($event->user['email'])->send(new DeleteUser($event->user));
    }
}

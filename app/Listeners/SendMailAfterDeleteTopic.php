<?php

namespace App\Listeners;

use App\Events\SendMailTopic;
use App\Mail\SendMailDeleteTopic;
use App\Repositories\Topic\TopicRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailAfterDeleteTopic implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * @var \App\Repositories\Topic\TopicEloquentRepository
     */
    private $topicRepository;

    /**
     * @var UserRepositoryInterface|\App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        TopicRepositoryInterface $topicRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
        $this->topicRepository = $topicRepository;
    }

    /**
     * Handle the event.
     *
     * @param  SendMailTopic  $event
     * @return void
     */
    public function handle(SendMailTopic $event)
    {
        Mail::to($event->topic->user->email)->send(new SendMailDeleteTopic($event->topic));
    }
}

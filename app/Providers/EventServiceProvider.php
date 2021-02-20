<?php

namespace App\Providers;

use App\Events\DeleteSubUser;
use App\Events\EditPhoto;
use App\Events\MoveProperty;
use App\Events\EditProperty;
use App\Events\MoveSubUser;
use App\Events\SendMailDeletePhoto;
use App\Events\SendMailDeleteUser;
use App\Events\SendMailTopic;
use App\Events\UpdateTopic;
use App\Events\Pay;
use App\Listeners\SendMailAfterDeletePhoto;
use App\Listeners\SendMailAfterDeleteSubUser;
use App\Listeners\SendMailAfterDeleteTopic;
use App\Listeners\SendMailAfterDeleteUser;
use App\Listeners\SendMailAfterEditPhoto;
use App\Listeners\SendMailAfterMoveProperty;
use App\Listeners\SendMailAfterEditProperty;
use App\Listeners\SendMailAfterMoveSubUser;
use App\Listeners\SendMailAfterUpdateTopic;
use App\Listeners\SendMailPay;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendMailTopic::class => [
            SendMailAfterDeleteTopic::class,
        ],
        SendMailDeleteUser::class => [
            SendMailAfterDeleteUser::class
        ],
        EditPhoto::class => [
            SendMailAfterEditPhoto::class
        ],
        SendMailDeletePhoto::class => [
            SendMailAfterDeletePhoto::class
        ],
        UpdateTopic::class => [
            SendMailAfterUpdateTopic::class
        ],
        EditProperty::class => [
            SendMailAfterEditProperty::class
        ],
        MoveProperty::class => [
            SendMailAfterMoveProperty::class
        ],
        MoveSubUser::class => [
            SendMailAfterMoveSubUser::class
        ],
        DeleteSubUser::class => [
            SendMailAfterDeleteSubUser::class
        ],
        Pay::class => [
            SendMailPay::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

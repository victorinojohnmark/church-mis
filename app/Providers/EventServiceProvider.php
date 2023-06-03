<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;


#Models
use App\Models\Baptism;
use App\Models\DocumentRequest;
use App\Models\DocumentRequest\DocumentRequestBaptism;
use App\Models\DocumentRequest\DocumentRequestConfirmation;
use App\Models\DocumentRequest\DocumentRequestCommunion;
use App\Models\DocumentRequest\DocumentRequestMatrimony;
use App\Models\DocumentRequest\DocumentRequestBlessing;
use App\Models\DocumentRequest\DocumentRequestDeath;




#Observers
use App\Observers\BaptismObserver;
use App\Observers\DocumentRequestObserver;
use App\Observers\DocumentRequestBaptismObserver;
use App\Observers\DocumentRequestConfirmationObserver;
use App\Observers\DocumentRequestCommunionObserver;
use App\Observers\DocumentRequestMatrimonyObserver;
use App\Observers\DocumentRequestBlessingObserver;
use App\Observers\DocumentRequestDeathObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        DocumentRequest::observe(DocumentRequestObserver::class);
        Baptism::observe(BaptismObserver::class);
        DocumentRequestBaptism::observe(DocumentRequestBaptismObserver::class);
        DocumentRequestConfirmation::observe(DocumentRequestConfirmationObserver::class);
        DocumentRequestCommunion::observe(DocumentRequestCommunionObserver::class);
        DocumentRequestMatrimony::observe(DocumentRequestMatrimonyObserver::class);
        DocumentRequestBlessing::observe(DocumentRequestBlessingObserver::class);
        DocumentRequestDeath::observe(DocumentRequestDeathObserver::class);

    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

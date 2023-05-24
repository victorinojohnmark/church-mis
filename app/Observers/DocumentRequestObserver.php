<?php

namespace App\Observers;

use App\Models\DocumentRequest;

class DocumentRequestObserver
{
    /**
     * Handle the DocumentRequest "created" event.
     */
    public function created(DocumentRequest $documentRequest): void
    {
        $documentRequest->request_code = now()->format('y') . now()->format('m') . str_pad($documentRequest->id, 6, '0', STR_PAD_LEFT);
        $documentRequest->update();
    }

    /**
     * Handle the DocumentRequest "updated" event.
     */
    public function updated(DocumentRequest $documentRequest): void
    {
        //
    }

    /**
     * Handle the DocumentRequest "deleted" event.
     */
    public function deleted(DocumentRequest $documentRequest): void
    {
        //
    }

    /**
     * Handle the DocumentRequest "restored" event.
     */
    public function restored(DocumentRequest $documentRequest): void
    {
        //
    }

    /**
     * Handle the DocumentRequest "force deleted" event.
     */
    public function forceDeleted(DocumentRequest $documentRequest): void
    {
        //
    }
}

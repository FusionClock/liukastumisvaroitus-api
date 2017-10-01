<?php

namespace App\Jobs;

use App\Repositories\Interfaces\WarningRepositoryInterface;
use App\Warning;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Collection;

class WarningUpdater implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var WarningRepositoryInterface
     */
    private $warningRepository;

    /**
     * Create a new job instance.
     *
     * @param WarningRepositoryInterface $warningRepository
     */
    public function __construct(WarningRepositoryInterface $warningRepository)
    {
        $this->warningRepository = $warningRepository;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Collection::make($this->warningRepository->getWarnings())->each(function ($message) {
            tap(str_replace(["\r", "\n"], '', quoted_printable_decode($message)), function ($city) {
                Warning::query()->create(['city' => $city]);
            });
        });
    }
}

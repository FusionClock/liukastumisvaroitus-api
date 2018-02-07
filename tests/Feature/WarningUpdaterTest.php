<?php

namespace Tests\Feature;

use App\Jobs\WarningUpdater;
use App\Repositories\Interfaces\WarningRepositoryInterface;
use App\Warning;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WarningUpdaterTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdater()
    {
        $repository = Mockery::mock(WarningRepositoryInterface::class);
        $repository->shouldReceive('getWarnings')->andReturn(['Lahti', 'Lipat']);

        /** @var WarningRepositoryInterface $repository */
        $updater = new WarningUpdater($repository);

        $updater->handle();

        /** @var Collection $warning */
        $warnings = Warning::query()->orderBy('created_at', 'desc')->get();

        $this->assertEquals('Lahti', $warnings->first()->city);
        $this->assertEquals(1, $warnings->count());
    }
}

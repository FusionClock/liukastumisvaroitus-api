<?php

namespace Tests\Feature;

use App\Warning;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WarningApiTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        factory(Warning::class, 5)->create();

        $request = $this->get('/api/v1/warnings');
        $data = $request->json();

        $this->assertCount(5, $data);
    }

    public function testFilter()
    {
        $warning = factory(Warning::class, 5)->create()->first();

        $request = $this->get("/api/v1/warnings?filter=city:{$warning->city}");
        $data = $request->json();

        $this->assertEquals($warning->city, Arr::get($data, '0.city'));
    }

    public function testOrder()
    {
        /** @var Collection $warnings */
        $warnings = factory(Warning::class, 5)->create();

        $request = $this->get("/api/v1/warnings?order=city:asc");
        $data = $request->json();

        $this->assertEquals(
            $warnings->pluck('city')->sort()->values()->toArray(),
            Arr::pluck($data, 'city')
        );
    }
  
    public function testShow()
    {
        $warning = factory(Warning::class, 5)->create()->first();

        $request = $this->get("/api/v1/warnings/{$warning->id}");
        $data = $request->json();

        $this->assertEquals($warning->city, Arr::get($data, 'city'));
    }
}

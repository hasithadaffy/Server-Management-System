<?php

namespace Tests\Unit;

use App\Models\Server;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServerTest extends TestCase
{
    use RefreshDatabase;

    //Test filtering by model.
    public function test_filter_by_model(): void
    {
        $server = Server::factory()->create(['model' => 'TestModel']);
        $servers = Server::filter(['model' => 'TestModel'])->get();

        $this->assertCount(1, $servers);
        $this->assertEquals($server->id, $servers->first()->id);
    }

    //Test filtering by ram.
    public function test_filter_by_ram(): void
    {
        $server = Server::factory()->create(['ram' => '8GB']);
        $servers = Server::filter(['ram' => ['8']])->get();

        $this->assertCount(1, $servers);
        $this->assertEquals($server->id, $servers->first()->id);
    }

    //Test filtering by storage.
    public function test_filter_by_storage(): void
    {
        $server = Server::factory()->create(['hdd' => '2x500GBSSD']);
        $servers = Server::filter(['storage' => 1000])->get();

        $this->assertCount(1, $servers);
        $this->assertEquals($server->id, $servers->first()->id);
    }

    //Test filtering by hdd.
    public function test_filter_by_hdd(): void
    {
        $server = Server::factory()->create(['hdd' => '2x500GBSSD']);
        $servers = Server::filter(['type' => '2x500GBSSD'])->get();

        $this->assertCount(1, $servers);
        $this->assertEquals($server->id, $servers->first()->id);
    }

    //Test filtering by location.
    public function test_filter_by_location(): void
    {
        $server = Server::factory()->create(['location' => 'TestLocation']);
        $servers = Server::filter(['location' => 'TestLocation'])->get();

        $this->assertCount(1, $servers);
        $this->assertEquals($server->id, $servers->first()->id);
    }
}

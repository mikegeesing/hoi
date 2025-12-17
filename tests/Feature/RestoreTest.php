<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\RestoreToken;
use App\Models\RestoreJob;
use Illuminate\Support\Str;

class RestoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_start_restore_creates_job_and_increments_token()
    {
        // Create a raw token and store hashed in DB
        $raw = 'secret-token-123';
        $token = RestoreToken::create([
            'token' => hash('sha256', $raw),
            'borg_user' => 'onlineh',
            'expires_at' => now()->addHour(),
            'max_uses' => 5,
            'used' => 0,
        ]);

        // Bind a fake BorgService that returns an archive list containing 'test-archive'
        $this->app->bind(\App\Services\BorgService::class, function() {
            return new class {
                public function listArchives() {
                    return ['archives' => [['name' => 'test-archive', 'time' => now()->toIso8601String()]]];
                }
            };
        });

        $response = $this->postJson('/restore/start', [
            'token' => $raw,
            'archive' => 'test-archive',
            'files' => ['/home/onlineh/file.txt'],
        ]);

        $response->assertStatus(200);
        $data = $response->json();
        $this->assertArrayHasKey('job_id', $data);

        $job = RestoreJob::find($data['job_id']);
        $this->assertNotNull($job);
        $this->assertEquals('test-archive', $job->archive_name);

        $token->refresh();
        $this->assertEquals(1, $token->used);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Applied_Job;
use App\Models\Job;

class UserModelTest extends TestCase
{
    public function test_can_create_a_user()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('secret'),
            'id' => 1,
        ];

        $user = User::create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['email'], $user->email);
        $this->assertEquals($userData['id'], $user->id);
        $this->assertEquals($userData['password'], $user->password);
    }

    public function test_can_have_an_applied_job()
    {
        $user = User::factory()->create();
        $job = Job::factory()->create();
        $appliedJob = Applied_Job::create([
            'id' => 1,
            'user_id' => $user->id ,
            'job_id' => $job->id,
            'status' => 'waiting',]);

        $this->assertInstanceOf(Applied_Job::class, $user->user_apply);
        $this->assertEquals($appliedJob->id, $user->user_apply->id);
    }

    /** @test */
    public function test_can_hide_sensitive_information()
    {
        $user = User::factory()->create();

        $hiddenAttributes = ['password', 'remember_token'];

        foreach ($hiddenAttributes as $attribute) {
            $this->assertArrayNotHasKey($attribute, $user->toArray());
        }
    }
}

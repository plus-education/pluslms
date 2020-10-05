<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use  RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    /** @test */
    public function a_group_can_get_user_students()
    {
        $user = User::factory()->make();
        $user->assignRole('student');

        $group = \App\Models\Group::factory()->make();

        dd($group->users);
    }
}

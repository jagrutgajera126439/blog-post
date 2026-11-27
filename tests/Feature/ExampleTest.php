<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_guest_is_sent_to_login_from_the_admin_root(): void
    {
        $this->get('/')->assertRedirect(route('login'));
    }
}
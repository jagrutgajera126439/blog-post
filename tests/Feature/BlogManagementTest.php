<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class BlogManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_blogs_is_read_only_and_manage_blogs_has_admin_actions(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $blog = $this->createBlog($admin, 'Read-only sample');

        $this->actingAs($admin)
            ->get(route('blogs.index'))
            ->assertOk()
            ->assertSee('Read-only sample')
            ->assertDontSee('href="'.route('blogs.edit', $blog).'"')
            ->assertDontSee('action="'.route('blogs.destroy', $blog).'"');

        $this->get(route('blogs.manage'))
            ->assertOk()
            ->assertSee('href="'.route('blogs.edit', $blog).'"', false)
            ->assertSee('action="'.route('blogs.destroy', $blog).'"', false);
    }

    public function test_manage_blogs_search_matches_registered_user_name(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $writer = User::factory()->create(['name' => 'Asha Writer']);
        $otherWriter = User::factory()->create(['name' => 'Ravi Writer']);
        $this->createBlog($writer, 'A unique post');
        $this->createBlog($otherWriter, 'Another unique post');

        $this->actingAs($admin)
            ->get(route('blogs.manage', ['search' => 'Asha']))
            ->assertOk()
            ->assertSee('A unique post')
            ->assertDontSee('Another unique post');
    }

    public function test_regular_users_cannot_open_admin_pages_but_can_open_their_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get(route('dashboard'))->assertForbidden();
        $this->get(route('blogs.manage'))->assertForbidden();
        $this->get(route('user.dashboard'))->assertOk();
    }

    public function test_blog_validation_rejects_a_nonexistent_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->post(route('blogs.store'), [
            'title' => 'Invalid category post',
            'author' => 'Admin Writer',
            'category_id' => 999999,
            'content' => 'Content',
            'status' => 'published',
        ])->assertSessionHasErrors('category_id');

        $this->assertDatabaseMissing('blogs', ['title' => 'Invalid category post']);
    }

    public function test_categories_page_shows_blog_count_without_server_error(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $blog = $this->createBlog($admin, 'Category count post');

        $this->actingAs($admin)
            ->get(route('categories.index'))
            ->assertOk()
            ->assertSee('Testing')
            ->assertSee('1 blog post');
    }

    public function test_registration_always_creates_a_regular_user(): void
    {
        $this->post(route('register.submit'), [
            'name' => 'New Writer',
            'email' => 'writer@example.test',
            'password' => 'strong-password-123',
            'password_confirmation' => 'strong-password-123',
            'role' => 'admin',
        ])->assertRedirect(route('user.dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => 'writer@example.test',
            'role' => 'user',
        ]);
    }

    public function test_forgot_password_sends_a_reset_notification(): void
    {
        Notification::fake();
        $user = User::factory()->create();

        $this->post(route('password.email'), ['email' => $user->email])
            ->assertSessionHas('status');

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_password_reset_updates_the_account_password(): void
    {
        $user = User::factory()->create();
        $token = Password::broker()->createToken($user);

        $this->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'a-new-strong-password',
            'password_confirmation' => 'a-new-strong-password',
        ])->assertRedirect(route('login'));

        $this->assertTrue(Hash::check('a-new-strong-password', $user->fresh()->password));
    }

    public function test_admin_command_can_promote_an_existing_account(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->artisan('app:create-admin', ['--email' => $user->email])
            ->expectsConfirmation('Promote this existing account to admin?', 'yes')
            ->assertExitCode(0);

        $this->assertSame('admin', $user->fresh()->role);
    }

    private function createBlog(User $owner, string $title): Blog
    {
        $category = Category::firstOrCreate(['name' => 'Testing']);

        return Blog::create([
            'title' => $title,
            'author' => $owner->name,
            'content' => 'Sample blog content.',
            'category_id' => $category->id,
            'status' => 'published',
            'user_id' => $owner->id,
        ]);
    }
}

<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    protected $signature = 'app:create-admin {--email= : Email address for the administrator account} {--name= : Name for a new administrator account}';

    protected $description = 'Create an administrator account or promote an existing user';

    public function handle(): int
    {
        $email = $this->option('email') ?: $this->ask('Admin email');

        $emailErrors = Validator::make(['email' => $email], [
            'email' => ['required', 'email', 'max:255'],
        ]);

        if ($emailErrors->fails()) {
            $this->error($emailErrors->errors()->first('email'));
            return self::FAILURE;
        }

        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            if ($existingUser->role === 'admin') {
                $this->info('This account is already an administrator.');
                return self::SUCCESS;
            }

            if (! $this->confirm('Promote this existing account to admin?')) {
                $this->comment('No changes were made.');
                return self::SUCCESS;
            }

            $existingUser->forceFill(['role' => 'admin'])->save();
            $this->info('Existing account promoted to administrator.');

            return self::SUCCESS;
        }

        $name = $this->option('name') ?: $this->ask('Admin name');
        $password = $this->secret('Admin password (at least 8 characters)');
        $passwordConfirmation = $this->secret('Confirm admin password');

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        if ($password !== $passwordConfirmation) {
            $this->error('The password confirmation does not match.');
            return self::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info('Administrator account created successfully.');

        return self::SUCCESS;
    }
}
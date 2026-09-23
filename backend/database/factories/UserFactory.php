<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class UserFactory extends Factory { public function definition(): array { return ['name'=>fake()->name(),'email'=>fake()->unique()->safeEmail(),'email_verified_at'=>now(),'password'=>'$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC7g7M1fE9M1E0VQ7Oe','mobile'=>fake()->unique()->numerify('050#######'),'remember_token'=>Str::random(10)]; } }

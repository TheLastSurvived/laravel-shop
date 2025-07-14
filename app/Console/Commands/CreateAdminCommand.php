<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    protected $signature = 'make:admin 
                            {--name= : Имя администратора}
                            {--surname= : Фамилия администратора}
                            {--email= : Email администратора}
                            {--password= : Пароль администратора}';

    protected $description = 'Создать нового администратора';

    public function handle()
    {
        $name = $this->option('name') ?? $this->ask('Введите имя администратора');
        $surname = $this->option('surname') ?? $this->ask('Введите фамилию администратора');
        $email = $this->option('email') ?? $this->ask('Введите email администратора');
        $password = $this->option('password') ?? $this->secret('Введите пароль администратора');

        // Валидация
        $validator = Validator::make([
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            $this->error('Ошибка валидации:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        // Создание администратора
        $admin = User::create([
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true, // Убедитесь, что в вашей модели User есть это поле
        ]);

        $this->info("Администратор {$admin->name} {$admin->surname} успешно создан!");
        $this->info("Email: {$admin->email}");

        return 0;
    }
}

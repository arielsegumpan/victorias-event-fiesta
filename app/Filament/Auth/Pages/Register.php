<?php

namespace App\Filament\Auth\Pages;
use App\Models\User;
use App\Models\UserProfile;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Support\Str;
class Register extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    TextInput::make('first_name')
                    ->label('First Name')
                    ->maxLength(255)
                    ->required(),

                    TextInput::make('last_name')
                    ->label('Last Name')
                    ->maxLength(255)
                    ->required(),
                ])
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2
                ]),

                // Default Filament Fields
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),

            ]);
    }

    protected function handleRegistration(array $data): Model
    {
        $sanitizedData = $this->sanitizeInputData($data);

         $user = $this->createUser($sanitizedData);
         $this->createUserProfile($user, $sanitizedData);
         $this->assignUserProfileRole($user);

        return $user;
    }


    protected function sanitizeInputData(array $data): array
    {
        return [
            'first_name' => trim(strip_tags($data['first_name'])),
            'last_name' => trim(strip_tags($data['last_name'])),
            'email' => filter_var($data['email'], FILTER_SANITIZE_EMAIL),
            'password' => $data['password'],
        ];
    }

    protected function createUser(array $data): User
    {
        return User::create([
            'name' => Str::title($data['first_name'] . ' ' . $data['last_name']),
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    protected function createUserProfile(User $user, array $data): UserProfile
    {
        return UserProfile::create([
            'user_id' => $user->id,
            'first_name' => Str::title($data['first_name']),
            'last_name' => Str::title($data['last_name']),
        ]);
    }

    protected function assignUserProfileRole(User $user): void
    {
        $userRole = Role::firstOrCreate(['name' => 'fiesta']);
        $user->assignRole($userRole);
    }

}

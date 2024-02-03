<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->label('First name')
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),
                TextInput::make('middle_name')
                    ->label('Middle name')
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->label('Last name')
                    ->required()
                    ->maxLength(255),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}

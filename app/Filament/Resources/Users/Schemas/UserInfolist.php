<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nama Lengkap'),

                TextEntry::make('email')
                    ->label('Email'),

                TextEntry::make('role')
                    ->label('Role')
                    ->badge()
                    ->formatStateUsing(
                        fn (string $state): string => match ($state) {
                            'admin' => 'Administrator',
                            'student' => 'Student',
                            default => ucfirst($state),
                        }
                    ),

                TextEntry::make('email_verified_at')
                    ->label('Email Terverifikasi')
                    ->dateTime('d M Y H:i')
                    ->placeholder('Belum diverifikasi'),

                TextEntry::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),

                TextEntry::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y H:i'),
            ]);
    }
}
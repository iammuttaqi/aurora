<?php

namespace App\Http\Livewire\Auth\Pages\Partners;

use App\Models\Profile;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use URL;

class Index extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Profile::query())
            ->columns([
                ImageColumn::make('logo'),
                TextColumn::make('name')->searchable(),
                TextColumn::make('user.role.title'),
                TextColumn::make('address')->visibleFrom('md'),
                IconColumn::make('approved')->boolean(),
            ])
            ->filters([
                SelectFilter::make('Role')->relationship('user.role', 'title', function ($query) {
                    $query->where('type', 'user');
                }),
                TernaryFilter::make('status')->attribute('approved'),
            ])
            ->actions([
                Action::make('approve')
                    ->label(false)
                    ->icon('heroicon-o-check-badge')
                    ->iconSize('lg')
                    ->color('success')
                    ->tooltip('Approve')
                    ->modalHeading('Are you sure?')
                    ->modalSubmitActionLabel('Approve')
                    ->requiresConfirmation()
                    ->action(function (Profile $profile) {
                        dd($profile);
                    })
                    ->visible(function (Profile $profile) {
                        return Gate::allows('approvalbe', $profile);
                    }),
                Action::make('check-identity')
                    ->url(fn(Profile $profile): string => URL::signedRoute('verify_identity', $profile->username))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-shield-exclamation')
                    ->iconSize('lg')
                    ->color('info')
                    ->label(false)
                    ->tooltip('Check Identity'),
                Action::make('qr-code')
                    ->url(fn(Profile $profile): string => route('partners.qr_code', $profile->username))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-qr-code')
                    ->iconSize('lg')
                    ->color('info')
                    ->label(false)
                    ->tooltip('QR Code'),
                Action::make('edit')
                    ->url(fn(Profile $profile): string => route('partners.show', $profile->username))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-pencil-square')
                    ->iconSize('lg')
                    ->color('warning')
                    ->label(false)
                    ->tooltip('Edit'),
            ])
            ->bulkActions([
                // ...
            ])
            ->defaultSort('created_at', 'desc');
    }

    public function render(): View
    {
        return view('livewire.auth.pages.partners.index');
    }
}

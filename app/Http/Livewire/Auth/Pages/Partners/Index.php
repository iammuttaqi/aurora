<?php

namespace App\Http\Livewire\Auth\Pages\Partners;

use App\Models\Profile;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
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
                TextColumn::make('address'),
            ])
            ->filters([
                SelectFilter::make('Role')->relationship('user.role', 'title', function ($query) {
                    $query->where('type', 'user');
                }),
            ])
            ->actions([
                Action::make('check-identity')
                    ->url(fn(Profile $profile): string => URL::signedRoute('verify_identity', $profile->username))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-shield-exclamation')
                    ->iconSize('lg')
                    ->color('success')
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
        // $partners = Profile::query()
        //     ->where('name', 'like', '%' . $this->search . '%')
        //     ->orWhere('username', 'like', '%' . $this->search . '%')
        //     ->has('user')
        //     ->with('user.role')
        //     ->latest()
        //     ->paginate(100);

        return view('livewire.auth.pages.partners.index');
    }
}

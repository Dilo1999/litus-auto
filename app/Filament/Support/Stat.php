<?php

namespace App\Filament\Support;

use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Contracts\View\View;

class Stat extends Card
{
    protected ?int $progress = null;

    protected ?string $status = null;

    protected ?string $tone = null;

    public function progress(?int $percent): static
    {
        $this->progress = $percent === null ? null : max(0, min(100, $percent));

        return $this;
    }

    public function status(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function tone(?string $tone): static
    {
        $this->tone = $tone;

        return $this;
    }

    public function getProgress(): ?int
    {
        return $this->progress;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getTone(): string
    {
        return $this->tone ?? $this->getColor() ?? 'neutral';
    }

    public function render(): View
    {
        return view('filament.widgets.stat-card', $this->data());
    }
}

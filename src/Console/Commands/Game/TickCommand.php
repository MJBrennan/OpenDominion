<?php

namespace OpenDominion\Console\Commands\Game;

use Exception;
use Illuminate\Console\Command;
use OpenDominion\Services\Dominion\TickService;
use Throwable;

class TickCommand extends Command
{
    /** @var string The name and signature of the console command. */
    protected $signature = 'game:tick';

    /** @var string The console command description. */
    protected $description = 'Ticks the game';

    /** @var TickService */
    protected $tickService;

    /**
     * GameTickCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->tickService = app(TickService::class);
    }

    /**
     * Execute the console command.
     *
     * @throws Exception|Throwable
     */
    public function handle(): void
    {
        $this->tickService->tickHourly();

        if (now()->hour === 0) {
            $this->tickService->tickDaily();
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Models\StockLog;
use Illuminate\Console\Command;

class FillAuditableStockLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill-auditable-stock-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        StockLog::orderBy('item_id')
            ->orderBy('moved_at')
            ->get()
            ->groupBy('item_id')
            ->each(function ($logs) {
                $prevStock = 0;
                $logs->each(function (StockLog $log) use (&$prevStock) {
                    $log->last = $prevStock;
                    $log->current = $log->last + ($log->type === 'in' ? $log->amount : -$log->amount);
                    $log->save();
                    $prevStock = $log->current;
                });
            });
    }
}
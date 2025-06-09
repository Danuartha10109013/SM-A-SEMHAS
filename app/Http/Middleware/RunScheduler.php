<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class RunScheduler
{
    // public function handle($request, Closure $next)
    // {
    //     $task = DB::table('scheduled_tasks')->where('task_name', 'db_backup')->first();

    //     if ($task && $task->status === 'active') {
    //         $nextRun = strtotime($task->last_run) + ($task->interval_minutes * 60);
    //         $now = time();

    //         if (is_null($task->last_run) || $now >= $nextRun) {
    //             Artisan::call('db:backup');

    //             DB::table('scheduled_tasks')
    //                 ->where('task_name', 'db_backup')
    //                 ->update(['last_run' => now()]);
    //         }
    //     }

    //     return $next($request);
    // }
// }



    public function handle($request, Closure $next)
    {
        $task = DB::table('scheduled_tasks')->where('task_name', 'db_backup')->first();

        if ($task && $task->status === 'active') {
            $now = time();
            $lastRun = $task->last_run ? strtotime($task->last_run) : 0;
            $nextRun = $lastRun + (7 * 24 * 60 * 60); // 1 minggu dalam detik

            if ($now >= $nextRun) {
                // Jalankan backup
                Artisan::call('db:backup');

                // Update waktu terakhir dijalankan
                DB::table('scheduled_tasks')
                    ->where('task_name', 'db_backup')
                    ->update(['last_run' => now()]);

                // Optional: log informasi (aktifkan jika perlu)
                Log::info('Backup mingguan berhasil dijalankan.');
            }
        }

        return $next($request);
    }

}


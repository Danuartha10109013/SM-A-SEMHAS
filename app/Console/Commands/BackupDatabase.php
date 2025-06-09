<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Backup the database weekly';

    public function handle()
    {
        $filename = 'backup-' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
        $storagePath = storage_path('app/backups');

        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        // Konfigurasi koneksi manual sesuai permintaan:
        $dbHost = '127.0.0.1';      // bisa diganti sesuai config mysql
        $dbUser = 'root';
        $dbPassword = '';           // kosong
        $dbName = config('database.connections.mysql.database');

        // Path mysqldump di Windows (pastikan tanda kutip " sudah benar)
        $mysqldumpPath = '"C:\\laragon1\\bin\\mysql\\mysql-5.7.39-winx64\\bin\\mysqldump.exe"';

        // Bangun command mysqldump
        $command = sprintf(
            '%s --user=%s %s --host=%s %s > "%s/%s"',
            $mysqldumpPath,
            escapeshellarg($dbUser),
            $dbPassword === '' ? '' : '--password=' . escapeshellarg($dbPassword),
            escapeshellarg($dbHost),
            escapeshellarg($dbName),
            $storagePath,
            $filename
        );

        $returnVar = null;
        $output = null;

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info("Database backup saved to: backups/$filename");
            Log::info("Database backup success: backups/$filename");
        } else {
            $this->error("Database backup failed.");
            Log::error('Database backup failed', [
                'command' => $command,
                'output' => $output,
                'return_code' => $returnVar,
            ]);
        }
    }
}

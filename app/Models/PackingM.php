<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingM extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'packing';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Specify the primary key type if it's not 'int'

    // Allow mass assignment for the following fields
    protected $fillable = [
        'gm',
        'created_at',
        'updated_at',
        'jenis',
        'shift_leader',
        'shift',
        'operator',
    ];

    // Disable auto-incrementing if necessary (optional)
    public $incrementing = true;

    // Disable timestamps if you don't want to automatically manage them
    public $timestamps = true;

    // If timestamps are stored as `timestamp`, you can keep `$dates` or remove it if unnecessary
    protected $dates = ['created_at', 'updated_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $table = 'servers';
    protected $fillable = [
        'model',
        'ram',
        'hdd',
        'location',
        'price',
    ];

    protected $visible = [
        'id',
        'model',
        'ram',
        'hdd',
        'location',
        'price',
        'created_at',
        'updated_at',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['model'] ?? false, fn($query, $model) => $query->where('model', 'like', "%$model%"))
        ->when($filters['ram'] ?? false, function ($query) use ($filters) {
            foreach ($filters['ram'] as $ram) {
                $query->orWhere('ram', 'LIKE', "%{$ram}GB%");
            }
        })
        ->when($filters['storage'] ?? false, function ($query) use ($filters) {
            $totalStorage = $filters['storage'];
            $query->whereRaw('
                CASE
                    WHEN hdd LIKE "%GBSSD" THEN CONVERT(SUBSTRING_INDEX(hdd, "x", 1), UNSIGNED INTEGER) * CONVERT(SUBSTRING_INDEX(SUBSTRING_INDEX(hdd, "x", -1), "GBSSD", 1), UNSIGNED INTEGER)
                    WHEN hdd LIKE "%TBSATA2" THEN CONVERT(SUBSTRING_INDEX(hdd, "x", 1), UNSIGNED INTEGER) * CONVERT(SUBSTRING_INDEX(SUBSTRING_INDEX(hdd, "x", -1), "TBSATA2", 1), UNSIGNED INTEGER) * 1024
                    WHEN hdd LIKE "%GBSAS" THEN CONVERT(SUBSTRING_INDEX(hdd, "x", 1), UNSIGNED INTEGER) * CONVERT(SUBSTRING_INDEX(SUBSTRING_INDEX(hdd, "x", -1), "GBSAS", 1), UNSIGNED INTEGER)
                END = ?', [$totalStorage]);
        })
        ->when($filters['harddisk_type'] ?? false, fn($query, $type) => $query->where('hdd', 'like', "%$type%"))
        ->when($filters['location'] ?? false, fn($query, $location) => $query->where('location', 'like', "%$location%"));
    }

}

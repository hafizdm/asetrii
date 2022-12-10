<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Item extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function kind()
    {
        return $this->belongsTo(Category::class);
    }

    public function merk()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Category::class);
    }

    public function loanRecords()
    {
        return $this->hasMany(LoanRecord::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function stockLog()
    {
        return $this->hasMany(StockLog::class);
    }

    public function countStock()
    {
        $in = $this->stockLog()->where('type', 'in')->sum('amount');
        $out = $this->stockLog()->where('type', 'out')->sum('amount');

        return $in - $out;
    }
}

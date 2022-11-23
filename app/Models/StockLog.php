<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class StockLog extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Stock extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function responsible()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function division()
    {
        return $this->belongsTo(Category::class, 'division_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}

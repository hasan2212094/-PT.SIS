<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checking extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_unit',
        'category_id',
        'note',
        'date_finding',
        'image',
        'status'];
        public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

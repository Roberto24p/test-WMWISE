<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Order extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActiveScope);
    }
    protected $fillable = [
        'reference',
        'status',
        'comments',
        'person_id',
        'date_to_complete_order'
    ];
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}

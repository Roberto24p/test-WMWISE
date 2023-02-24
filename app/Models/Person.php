<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Person extends Model
{
    use HasFactory;

    protected $table = "persons";


    protected $fillable = [
        'name',
        'address',
        'email'
    ];

    protected $hidden = [
        'is_delete'
    ];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActiveScope);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

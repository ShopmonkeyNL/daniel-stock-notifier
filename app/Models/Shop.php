<?php

namespace App\Models;

use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';

    protected $fillable = [
        'shop_id',
        'shop_title',
        'shop_id',
        'cluster',
        'api_key',
        'api_secret', 
        'main_language',
    ];
}

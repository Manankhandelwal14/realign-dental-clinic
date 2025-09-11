<?php

namespace App\Models\MediManage;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasUuids;

    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'primary_color',
        'secondary_color',
        'maintenance_mode',
        'maintenance_message',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    const TYPE_MANGER = 'manager';
    const TYPE_SUPER_MANGER = 'supermanager';
    const TYPE_ADMIN = 'admin';
    const TYPE_SUPER_ADMIN = 'superadmin';

    protected $guarded = [];
}

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
    const ADMIN_TYPE = ['manager', 'supermanager', 'admin', 'superadmin'];

    private $managerRoute = 'manager';
    private $adminRoute = 'admin';

    protected $guarded = [];

    public function getRouteName()
    {
        if ($this->type == self::TYPE_SUPER_ADMIN || $this->type == self::TYPE_ADMIN) {
            return 'admin';
        } else {
            return 'manager';
        }

    }

    public function redirectIfAuthintecatedToDashboard()
    {
        if ($this->type == self::TYPE_MANGER || $this->type == self::TYPE_SUPER_MANGER) {
            return redirect($this->managerRoute);
        } else {
            return redirect($this->adminRoute);
        }
    }
}

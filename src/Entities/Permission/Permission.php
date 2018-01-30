<?php

namespace basuregami\UserModule\Entities\Permission;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Permission extends Authenticatable
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','display_name','description'
    ];

    public function OperationPermission()
    {
        return $this->hasMany('basuregami\UserModule\Entities\OperationPermission\OperationPermission','permission_id');
    }
}

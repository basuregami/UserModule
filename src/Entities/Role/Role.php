<?php

namespace basuregami\UserModule\Entities\Role;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Role extends Authenticatable
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

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
        return $this->hasMany('basuregami\UserModule\Entities\OperationPermission\OperationPermission','role_id');
    }

    public function users()
    {
        return $this->hasMany('basuregami\UserModule\Entities\User\User');
    }

  
}

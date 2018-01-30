<?php

namespace basuregami\UserModule\Entities\OperationPermission;

use Illuminate\Foundation\Auth\User as Authenticatable;

class OperationPermission extends Authenticatable
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'operation_permission';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','permission_id','operation'
    ];

    public function Role()
    {
        return $this->belongsTo('basuregami\UserModule\Entities\Role\Role','role_id');
    }

    public function Permission()
    {
        return $this->belongsTo('basuregami\UserModule\Entities\Permission\Permission','permission_id');
    }
}

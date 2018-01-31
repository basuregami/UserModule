<?php
/**
 * Created by PhpStorm.
 * User: basu
 * Date: 1/10/18
 * Time: 4:59 PM
 */

namespace basuregami\UserModule\Persistence\Repositories;

use basuregami\UserModule\Persistence\Repositories\Contract\iRoleInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class RoleRepository extends EloquentRepository implements iRoleInterface
{
    protected $modelClassName = 'basuregami\UserModule\Entities\Role\Role';

    public function getListDataTable($request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'display_name',
            3 =>'description',
            4 =>'action',
        );

        $totalData = DB::table('roles')
            ->select(DB::raw('count(*) as rowCount'))
            ->get();
        $totalData = $totalData[0]->rowCount;

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $roles = $this->modelClassName::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $roles =  $this->modelClassName::where('id', 'LIKE', "%{$search}%")
               ->orWhere('name', 'LIKE', "%{$search}%")
               ->offset($start)
               ->limit($limit)
               ->orderBy($order, $dir)
               ->get();

            $totalFiltered = $roles->count();
        }

        $data = array();
        if (!empty($roles)) {
            $i = 1;
            foreach ($roles as $role) {
                $nestedData['id'] = "<input type='checkbox'  class='deleteRow' value='".$role->id."'  /> ".$i ;
                $nestedData['name'] = $role->name;
                $nestedData['display_name'] = $role->display_name;
                $nestedData['description'] = $role->description;
                $nestedData['action'] = '
                        <a href="'.url("/console/role/edit/").'/'.Crypt::encrypt($role->id).'" title="Edit" class="roleUpdate"><i class="fa fa-pencil-square-o fa-fw edit-icons edit"></i> </a>

						<a href="'.url("/console/role/delete").'/'.Crypt::encrypt($role->id).'" title="Delete" class="roleRemove" role_name="'.$role->name.'"  roleId="'.Crypt::encrypt($role->id).'" "><i class="fa fa-trash edit-icons del"></i> </a>
                ';

                ++$i;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
}

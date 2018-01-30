<?php
/**
 * Created by PhpStorm.
 * User: basu
 * Date: 1/10/18
 * Time: 4:59 PM
 */

namespace basuregami\UserModule\Persistence\Repositories;

use basuregami\UserModule\Persistence\Repositories\Contract\iPermissionInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class PermissionRepository extends EloquentRepository implements iPermissionInterface
{
    protected $modelClassName = 'basuregami\UserModule\Entities\Permission\Permission';

   public function getListDataTable($request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'display_name',
            3 =>'description',
            4 =>'action',
        );

        $totalData = DB::table('permissions')
            ->select(DB::raw('count(*) as rowCount'))
            ->get();
        $totalData = $totalData[0]->rowCount;

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $permissions = $this->modelClassName::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        }
        else {
            $search = $request->input('search.value');

            $permissions =  $this->modelClassName::where('id','LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = $permissions->count();
        }

        $data = array();
        if(!empty($permissions))
        {
            $i = 1;
            foreach ($permissions as $permission)
            {
                $nestedData['id'] = "<input type='checkbox'  class='deleteRow' value='".$permission->id."'  /> ".$i ;
                $nestedData['name'] = $permission->name;
                $nestedData['display_name'] = $permission->display_name;
                $nestedData['description'] = $permission->description;
                $nestedData['action'] = '
                        <a href="'.url("/console/permission/edit/").'/'.Crypt::encrypt($permission->id).'" title="Edit" class="permissionUpdate"><i class="fa fa-pencil-square-o fa-fw edit-icons edit"></i> </a>

						<a href="'.url("/console/permission/delete").'/'.Crypt::encrypt($permission->id).'" title="Delete" class="permissionRemove" permission_name="'.$permission->name.'"  permissionId="'.Crypt::encrypt($permission->id).'" "><i class="fa fa-trash edit-icons del"></i> </a>
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

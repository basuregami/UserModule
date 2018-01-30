<?php
/**
 * Created by PhpStorm.
 * User: basu
 * Date: 1/10/18
 * Time: 4:59 PM
 */

namespace basuregami\UserModule\Persistence\Repositories;

use basuregami\UserModule\Persistence\Repositories\Contract\iUserInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class UserRepository extends EloquentRepository implements iUserInterface
{
    protected $modelClassName = 'basuregami\UserModule\Entities\User\User';

    public function getListDataTable($request)
    {
        $columns = array(
            0 =>'id',
            1 =>'name',
            2 =>'email',
            3 => 'role',
            4 =>'action',
        );

        $totalData = DB::table('users')
            ->select(DB::raw('count(*) as rowCount'))
            ->get();
        $totalData = $totalData[0]->rowCount;

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = $this->modelClassName::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $users =  $this->modelClassName::where('id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $users->count();
        }

        $data = array();
        if (!empty($users)) {
            $i = 1;
            foreach ($users as $user) {
                $nestedData['id'] = "<input type='checkbox'  class='deleteRow' value='".$user->id."'  /> ".$i ;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                foreach ($user->roles as $role) {
                    $nestedData['role'] = '<label class="label label-success">'.$role->display_name.'</label>';
                }
                $nestedData['action'] = '
                        <a href="/console/user/edit/'.Crypt::encrypt($user->id).'" title="Edit" class="userUpdate" btn-value="'.$user->id.'"><i class="fa fa-pencil-square-o fa-fw edit-icons edit"></i> </a>

						<a href="'.url("/console/user/delete").'/'.$user->id.'" title="Delete" class="userRemove" userName="'.$user->name.'"  userId="'.$user->id.'" "><i class="fa fa-trash edit-icons del"></i> </a>
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

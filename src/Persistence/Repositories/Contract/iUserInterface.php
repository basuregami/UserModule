<?php
/**
 * Created by PhpStorm.
 * User: basu
 * Date: 1/10/18
 * Time: 5:00 PM
 */

namespace basuregami\UserModule\Persistence\Repositories\Contract;

interface iUserInterface extends iMainRepositoryInterface
{

    public function getListDataTable($request);
}

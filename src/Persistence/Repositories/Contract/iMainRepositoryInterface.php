<?php

namespace basuregami\UserModule\Persistence\Repositories\Contract;

interface iMainRepositoryInterface
{
    /*
    * create function
    * Method Declartion
    * @param array of attributes
    */
    public function create(array $attributes);

    /*
    * update function
    * Method Declartion
    * @param array of $data, $id
    */
    public function update(array $data, $parameter, $attribute = "id");


    /*
    * getAll function
    * Method Declartion
    * @param array of attributes
    */
    public function getAll($columns = array('*'));

    /*
    * Delet function
    * Method Declartion
    * @param $id
    */
    public function delete($id);

    /*
   * findByID function
   * Method Declartion
   * @param $id
   */
    public function findById($id, $columns = array('*'));


    /*
    * findBy function
    * Method Declartion
    * @param array of attributes $data
    */
    public function findBy($attribute, $data);


    /**
     * Paginate all
     * @param  integer $perPage
     * @param  array   $columns
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate($perPage = 15, $columns = ['*']);
}

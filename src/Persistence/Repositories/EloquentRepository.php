<?php

namespace basuregami\UserModule\Persistence\Repositories;

use basuregami\UserModule\Persistence\Repositories\Contract\iMainRepositoryInterface;


/**
 * Abstract class
 * Define alll the generic function
 * Implements the Main Interface
 * Deals with dynamic model class Name
 *
 ********************************
 * The Abstract Repository provides default implementations of the methods defined in the base repository interface. These simply
 * delegate static function calls to the right eloquent model based on the $modelClassName.
*/
abstract class EloquentRepository implements iMainRepositoryInterface{


    /**
     * @var $modelClassName
     */
    protected $modelClassName;

    /**
     * create function
     * Method Definition
     * @param array of attributes
     */
    public function create(array $attributes)
    {
      return $this->modelClassName::create($attributes);

    }

    /*
    * update function
    * Method Definition
    * @param array of $data, $id
    */
    public function update(array $data, $parameter, $attribute="id")
    {

        return $this->modelClassName::where($attribute, '=', $parameter)->update($data);
    }


    /*
    * getAll function
    * Method Definition
    * @param array of attributes
    */
    public function getAll($columns =array('*'))
    {
        //return $this->modelClassName::all;
        return call_user_func_array("{$this->modelClassName}::all", array($columns));
    }


    /**
     * Delete function
     * Method Definition
     * @param $id
     */
    public function delete($id) {
        //return $this->modelClassName->delete($id);
        return call_user_func_array("{$this->modelClassName}::destroy", array($id));
    }

    /*
   * findByID function
   * Method Definition
   * @param $id
   */
    public function findById($id, $columns = array('*'))
    {
        return $this->modelClassName::find($id);
    }

    /**
     * findBy function
     * Method Definition
     * @param array of attributes $data
     */
    public function findBy($attribute,$data)
    {
        // Implment findBy() method
        return $this->modelClassName::where($attribute, '=', $data)->first();
    }


    /**
     * Paginate all
     * @param  integer $perPage
     * @param  array   $columns
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate($perPage = 7, $columns = ['*'])
    {
        return $this->modelClassName::paginate($perPage, $columns);
    }



    public function find($attribute,$data)
    {
        return $this->modelClassName::where($attribute, '=', $data)->get();
    }





}

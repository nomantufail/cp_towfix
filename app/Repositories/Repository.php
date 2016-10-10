<?php
/**
 * Created by PhpStorm.
 * User: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


class Repository
{
    protected $model = null;
    public function setModel($model)
    {
        $this->model = clone($model);
        return $this;
    }

    public function getModel()
    {
        return clone($this->model);
    }



    public function all()
    {
        return $this->getModel()->all();
    }

    public function store($attrs = [])
    {
        return $this->getModel()->create($attrs);
    }

    public function deleteById($id)
    {
        return $this->getModel()->destroy($id);
    }

    public function findById($id)
    {
        return $this->getModel()->find($id);
    }

    public function updateWhere($where, $attrs)
    {
        $query = $this->getModel();
        foreach($where as $key => $value){
            $query = $query->where($key,'=',$value);
        }
        return $query->update($attrs);
    }
}
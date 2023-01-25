<?php
interface CrudInterface{

    public function all();
    public function store($data);
    public function findOne($id);
    public function update($data, $id); 
    public function destroy($id);
}
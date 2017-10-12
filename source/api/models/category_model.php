<?php

class CategoryModel extends BaseModel
{
    public $id;
    public $name;
    public $description;
    
    public $_data;
    
    protected $ModelName = 'CategoryModel';
    protected $TableName = 'categories';
}
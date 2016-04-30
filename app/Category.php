<?php

namespace App;

class Category extends BaseModel
{
    protected $primaryKey = 'id';
    protected $tablename = 'categories';
    public $timestamps = false;
    protected $fillable = array('name', 'created_at_ip', 'updated_at_ip');
}

<?php
namespace Core;

class Model extends Db{

    protected $id;
    protected $table;

    public function __construct( $id = null )
    {
        $this->id = $id;
    }

    public function query()
    {
        # code...
    }
}

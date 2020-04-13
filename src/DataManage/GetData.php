<?php
namespace CjsSupport\DataManage;

class GetData extends Data {

    protected function __construct()
    {
        parent::__construct();
        $this->data = &$_GET;
    }

}



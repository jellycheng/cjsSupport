<?php
namespace CjsSupport\DataManage;

class EmptyData extends Data {

    protected function __construct()
    {
        parent::__construct();
        $this->data = [];
    }


}



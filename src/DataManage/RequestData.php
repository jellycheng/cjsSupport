<?php
namespace CjsSupport\DataManage;

class RequestData extends Data {

    protected function __construct()
    {
        parent::__construct();
        $this->data = &$_REQUEST;
    }

}



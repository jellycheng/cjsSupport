<?php
namespace CjsSupport\DataManage;

class ServerData extends Data {

    protected function __construct()
    {
        parent::__construct();
        $this->data = &$_SERVER;
    }

}



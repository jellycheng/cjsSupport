<?php
namespace CjsSupport\DataManage;

class EnvData extends Data {

    protected function __construct()
    {
        parent::__construct();
        $this->data = &$_ENV;
    }

}



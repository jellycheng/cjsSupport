<?php
namespace CjsSupport\DataManage;

class SessionData extends Data {

    protected function __construct()
    {
        parent::__construct();
        $this->data = &$_SESSION;
    }

}



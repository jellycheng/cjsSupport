<?php
namespace CjsSupport\DataManage;

class PostData extends Data {

    protected function __construct()
    {
        parent::__construct();
        $this->data = &$_POST;
    }

}



<?php
namespace CjsSupport\DataManage;

class FilesData extends Data {

    protected function __construct()
    {
        parent::__construct();
        $this->data = &$_FILES;
    }

}



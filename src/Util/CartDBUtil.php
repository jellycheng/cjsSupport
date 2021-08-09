<?php
namespace CjsSupport\Util;

// 购物车分库分表类
class CartDBUtil extends DBUtil {
    protected $db_num = 1;  //分库总数
    protected $table_num = 16; //分表总数

}

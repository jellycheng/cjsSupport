<?php
namespace CjsSupport\Util;

/**
 * 使用示例见CartDBUtil类，即CartDBUtil.php文件
 */
abstract class DBUtil {

    const PREFIX="_";
    const DATABASEKEY = "db_key";
    const DATATABLEKEY = "tbl_key";

    protected function __construct() {

    }

    public static function getInstance() {
        static $instance;
        if(!$instance) {
            $instance = new static();
        }
        return $instance;
    }

    /**
     * 根据数值返回对应 库名前缀 和 表名前缀
     * @param int $num 数值，一般是数据库的自增ID
     * @return array
     *        db_key 库名后缀
     * 		  tbl_key 表名后缀
     *
     */
    public function getDBBaseByNum($num){
        if($num<0 || !is_numeric($num)){
            throw  new \Exception("分库分表参数异常", 99000001);
        }
        $num = intval($num);
        $database = intval($num/$this->db_num)%$this->db_num+1;
        $table = $num%$this->table_num+1;
        return [self::DATABASEKEY=>self::PREFIX.$database,
                self::DATATABLEKEY=>self::PREFIX.$table
                ];
    }

    /**
     * 字符串hash分库分表
     * @param String str
     * @return array
     */
    public function getDBBaseByStr($str) {
        if($str==null || $str ==""){
            throw  new \Exception("分库分表参数异常",99000001);
        }
        $n = $this->getHashOrd($str);
        return $this->getDBBaseByNum($n);
    }

    /**
     * @param String $str ASCII 对应10进制总和
     * @return 数值
     */
    public function getHashOrd($str) {
        $n=0;
        if(is_numeric($str)) { //是数值型，则后面直接取模
            $n = intval($str);
        } else {
            $str = trim($str . '');
            $len = mb_strlen($str);
            for($i=0;$i<$len;$i++){
                $n+=ord($str[$i]);
            }
        }
        $res = $n%128;
        return $res;
    }

}

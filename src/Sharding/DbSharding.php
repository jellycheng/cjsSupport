<?php
namespace CjsSupport\Sharding;

/**
 * 分库分表，获取数据库和表编号算法
 */
class DbSharding
{
    /**
     * 根据数据源id 和 数量进行hash 取模 得到一个数值
     *
     * @param int $dataid 必须大于0
     * @param int $num 必须大于0
     * @return int|bool
     */
    public static function hashMod($dataid, $num)
    {
        if ( !is_numeric($dataid) || $dataid <= 0 || !is_numeric($num) || $num <= 0) {
            return false;
        }

        return $dataid % $num;
    }

    /**
     * 根据数据源，获取区间号
     *
     * @param int $dataid 必须大于0
     * @param array $aParams [
     *                          '0' => [                 //0库取值是 1 <= Userid <= 30000000
     *                              'min' => 1,          //必须存在，int
     *                              'max' => 30000000    //必须存在，int
     *                          ],
     *                          '1' => [                 //1库取值是 30000001 <= Userid <= PHP_INT_MAX
     *                              'min' => 30000001,   //必须存在，int
     *                              'max' => PHP_INT_MAX //必须存在，int
     *                          ]
     *                      ];
     * @return int|bool
     */
    public static function partitionNum($dataid, $aParams)
    {
        if ( !is_numeric($dataid) || $dataid <= 0 || !is_array($aParams) || empty($aParams)) {
            return false;
        }

        foreach ($aParams as $id => $arr) {
            if ( !isset($arr['min']) || !is_numeric($arr['min']) || !isset($arr['max']) || !is_numeric($arr['max'])) {
                return false;
            }

            if ($arr['min'] <= $dataid && $dataid <= $arr['max']) {
                return $id;
            }
        }

        return false;
    }

}


<?php
namespace CjsSupport\Enum;

/**
 * redis group 常量
 */
class RedisGroupEnum extends Enum
{
    const USER_QUEUES = 'user_queues'; //用户Queues模块
    const USER = 'user'; //用户模块
    const MISC = 'misc'; //无法归类的业务模块
    const USER_LOCK = 'user_lock'; //防并发锁的业务模块
}

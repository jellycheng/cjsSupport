<?php
namespace CjsSupport\Enum;

/**
 * redis key 常量
 */
class RedisKeyEnum extends Enum
{
    const USER_INFO_KEY = 'cjs:user:data:'; //用户信息缓存前缀
    const USER_TOKEN_KEY = 'cjs:user:token:'; //用户token缓存前缀
    const USER_LOCK_KEY = 'cjs:login:locker:'; //用户登录锁前缀
    const QUEUES_USER_REGISTER_KEY = 'cjs:queues:user:register'; //用户注册队列

}

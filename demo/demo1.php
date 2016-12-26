<?php
/**
 *
 */
require __DIR__ . '/common.php';

echo \CjsSupport\Util\SmsTpl::getSmsContent(\CjsSupport\Util\SmsCode::LOGIN_BUY, ['sms_code'=>'8989']);
echo PHP_EOL;


echo \CjsSupport\Util\SmsTpl::getSmsContent(\CjsSupport\Util\SmsCode::COMMON_TEST,
                                            ['sms_code'=>'8989',
                                                'username'=>'账号A',
                                                'nickname'=>'昵称j'
                                            ]);
echo PHP_EOL;

echo \CjsSupport\Util\SmsTpl::getSmsContent(9,
                                            ['sms_code'=>'6565',
                                                'username'=>'账号A',
                                                'nickname'=>'昵称j'
                                            ]);
echo PHP_EOL;

<?php
/**
 * 邀请码
 */
require 'common.php';

$inviteObj = new \CjsSupport\Util\GetInviteCode();

$userid = 1234567;
$inviteCode = $inviteObj->enCode($userid);
echo $inviteCode . PHP_EOL;
echo $inviteObj->deCode($inviteCode) . PHP_EOL;

$userid = 456;
$inviteCode = $inviteObj->enCode($userid);
echo $inviteCode . PHP_EOL;
echo $inviteObj->deCode($inviteCode) . PHP_EOL;


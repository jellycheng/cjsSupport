<?php
namespace CjsSupport\Util;

class DataCrypt {

	/**
     * openssl_get_cipher_methods()该方法可获取有效密码方式列表
     */
    const METHOD = 'AES-128-CBC';
	
	/**
	 * 加密数据 $res = DataCrypt::encryptData("后卫how are you！@#123");
	*/
	public static function encryptData( $data, $aesKey = 'cjsWin1234568')
	{
		$iv_length = openssl_cipher_iv_length(self::METHOD);
        $iv = openssl_random_pseudo_bytes($iv_length);
		$result = openssl_encrypt($data, self::METHOD, $aesKey, 1, $iv);
		$result = base64_encode($iv.$result);
		return $result;
	}

	//解密 DataCrypt::decryptData($res)
	public function decryptData( $encryptedData, $aesKey='cjsWin1234568')
	{
		$aesCipher=base64_decode($encryptedData);
		$iv_length = openssl_cipher_iv_length(self::METHOD);
        $iv = substr($aesCipher, 0, $iv_length);
        $aesCipher=substr($aesCipher, $iv_length);
		$result=openssl_decrypt($aesCipher, self::METHOD, $aesKey, 1, $iv);
		return $result;
	}

}


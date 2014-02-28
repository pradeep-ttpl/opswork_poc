<?php

/**
 * PHP version 5
 *
 * @Copyright (c) 2012. All Rights Reserved.
 * @filename : MCrypt.php
 * @version  : 1.0
 * @date  : 07-Jan-2014
 *
 * @description :
 *
 * @author      : Ramesh Raja
 *
 * History of modifications:
 *
 * Author                Date                  Description of modifications
 * ----------            ------------          ------------------------------
 * Ramesh Raja           07-Jan-2014           Initial Version - File Created
 * 
 */

class MCrypt
{
        private $iv = CRYPTO_ID;
        private $key = CRYPTO_KEY;


        function __construct()
        {
        }

        function encrypt($str) {
			$iv = $this->iv;

			$td = mcrypt_module_open('rijndael-128', ' ', 'cbc', $iv);

			mcrypt_generic_init($td, $this->key, $iv);
			$encrypted = mcrypt_generic($td, utf8_decode($str));

			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);

			return bin2hex($encrypted);
        }

        function decrypt($code) {
        	if($code != '')
        	{
	          $code = $this->hex2bin($code);
	          $iv = $this->iv;
	
	          $td = mcrypt_module_open('rijndael-128', ' ', 'cbc', $iv);
	
	          mcrypt_generic_init($td, $this->key, $iv);
	          $decrypted = mdecrypt_generic($td, $code);
	
	          mcrypt_generic_deinit($td);
	          mcrypt_module_close($td);
	
	          return utf8_encode(trim($decrypted));
        	}
        }

        protected function hex2bin($hexdata) {
          $bindata = '';

          for ($i = 0; $i < strlen($hexdata); $i += 2) {
                $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
          }

          return $bindata;
        }

}

?>
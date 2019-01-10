<?php
/**
 * Created by PhpStorm.
 * User: pragolan
 * Date: 2018/11/20
 * Time: 15:21
 */
$email = 'this@this.com';
$token = 1;
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-Type: text/html; charset=iso-8859-1";

echo "test";
mail("retief@mailinator.com", "test","hhh",implode("\n", $headers));

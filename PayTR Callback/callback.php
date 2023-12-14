<?php

include 'discord.php';

$merchant_key   = 'KEY_GIR';
$merchant_salt  = 'SALT_GIR';

$post = $_POST;

$hash = base64_encode( hash_hmac('sha256', $post['merchant_oid'].$merchant_salt.$post['status'].$post['total_amount'], $merchant_key, true) );

if( $hash != $post['hash'] ) {
    die('PAYTR notification failed: bad hash');
}

if( $post['status'] == 'success' ) { 

   

    $logMessage = "Ödeme onaylandı. Sipariş ID: " . $post['merchant_oid'] . ", Toplam Tutar: " . $post['total_amount'];
    logToDiscord($logMessage);

} else { 

  

    $logMessage = "Ödeme onaylanmadı. Sipariş ID: " . $post['merchant_oid'] . ", Hata Kodu: " . $post['failed_reason_code'] . ", Hata Mesajı: " . $post['failed_reason_msg'];
    logToDiscord($logMessage);

}

echo "OK";
exit;

?>

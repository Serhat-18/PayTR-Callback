<?php

function logToDiscord($message)
{
    $webhookUrl = 'WEBHOOK_HERE';

    $data = array('content' => $message);
    
    $options = array(
        'http' => array(
            'header'  => 'Content-type: application/json',
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );
    
    $context  = stream_context_create($options);
    $result = file_get_contents($webhookUrl, false, $context);

    if ($result === FALSE) {
        error_log('Discord loglama hatası: ' . error_get_last());
    }
}

?>

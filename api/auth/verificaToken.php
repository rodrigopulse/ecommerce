<?php
  function verificaToken($token) {
    $part = explode(".",$token);
    $header = $part[0];
    $payload = $part[1];
    $signature = $part[2];
    $valid = hash_hmac('sha256',"$header.$payload",'$ab45febebt#224R0',true);
    $valid = base64_encode($valid);
    if($signature == $valid){
      return true;
    } else {
      return false;
    }
  }
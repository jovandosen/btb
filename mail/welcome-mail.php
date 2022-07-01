<?php

ini_set("smtp_server", "smtp.gmail.com");
ini_set("smtp_port", 587);
ini_set("smtp_ssl", "tls");
ini_set("auth_username", "jovandosen994@gmail.com");
ini_set("auth_password", "protector994");
ini_set("force_sender", "dosenj994@gmail.com");

// The message
$message = "Line 1\r\nLine 2\r\nLine 3";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Send
$res = mail('dosenj994@gmail.com', 'My Subject', $message);

var_dump($res);
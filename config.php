<?php
$dotenv->required(["SMTP_HOST", "SMTP_PORT", "SMTP_CRIPT", "EMAIL_LOGIN", "EMAIL_PASSWORD", "EMAIL_SENDFROM", "EMAIL_SENDFROM_NAME"]); 
$options = array(
    "host" => getenv("SMTP_HOST"),
    "port" => getenv("SMTP_PORT"),
    "cript" => getenv("SMTP_CRIPT"),
    "login" => getenv("EMAIL_LOGIN"),
	"password" => getenv("EMAIL_PASSWORD"),
    "senderMail" => getenv("EMAIL_SENDFROM"),
    "senderName" => getenv("EMAIL_SENDFROM_NAME"),
);
	
	   	 
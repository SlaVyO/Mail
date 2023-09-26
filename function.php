<?php
function sendMail($options, $sendto, $subject, $sendtext, $image){
	try {
	    // Create the SMTP Transport
		$transport = (new Swift_SmtpTransport($options['host'], $options['port'], $options['cript']))	
		->setUsername($options['login'])
	    ->setPassword($options['password']);
	 
	    // Create the Mailer using your created Transport
	    $mailer = new Swift_Mailer($transport);
	 
	    // Create a message
	    $message = new Swift_Message();
	 
	    // Set a "subject"
	    $message->setSubject($subject);
	 
	    // Set the "From address"
	    $message->setFrom([$options['senderMail'] => $options['senderName']]);//pererabotat
	   	 
	    // Set the "To address" [Use setTo method for multiple recipients, argument should be array]
	    //print_r($sendto);
         //var_dump($sendto);
	    //$message->addTo($sendto);
         $message->setTo($sendto);
	    	
	 
	    // Add inline "Image"
	    $inline_attachment = Swift_Image::fromPath($image);
	    $cid = $message->embed($inline_attachment);
	 
	     
	    // Set a "Body"
	    $message->addPart($sendtext.'<br><img src="'.$cid.'>', 'text/html');
	    	// var_dump($message);
	     //Send the message
	    $result = $mailer->send($message);
	    return $result;
	} catch (Exception $e) {
	  echo $e->getMessage();
		return false;
	}
}
<?php

class Email extends Service
{

public $mailTo;
public $mailSubject;
public $mailMessage;
public $mailHeaders;
public $htmlMail = false;
public $lastOP;

	public function addHeader ($header) 
	{
		$mailHeaders = $mailHeaders . $header . '\r\n';
	}

	public function setRecipient($recipient )
	{
		$this->mailTo = $recipient;
	}

	public function setSender( $sender )
	{
		$this->addHeader('From:'.$sender.' ');
	}

	public function setCC( $copycat )
	{
		$this->addHeader('Cc:'.$copycat.' ');
	}

	public function setBCC( $ob_copycat )
	{
		$this->addHeader('Bcc:'.$ob_copycat.' ');
	}

	public function setHTML()
	{
		$this->addHeader('MIME-Version: 1.0');
		$this->addHeader('Content-type: text/html');
		$this->htmlMail = true;
	}


	public function setSubject( $subject )
	{
		$this->mailSubject = $subject;
	}
		
	public function setMessage( $message )
	{
		$this->mailMessage = $message;
	}

	public function send()
	{
 
		 $retval = mail ($to,$subject,$message,$header);

		 $this->lastOP = $retval;

		 return $retval;
 
	}

	public function lastOperation() 
	{
		return $this->lastOP;
	}



	protected function afterDestruct()
	{

	}	

	protected function afterConstruct() 
	{
         
    }



}
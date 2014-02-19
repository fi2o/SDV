<?php
$mail = FALSE;

class jMail {
	
	public function jMail($from=FALSE,$to=FALSE,$subject=FALSE,$body=FALSE) {
		global $mail;
	
		$phpmailer_path = realpath(dirname(__FILE__));
		require "$phpmailer_path/class.phpmailer.php";
		
		$mail = new PHPMailer;
		$mail->IsHTML(FALSE);
		$mail->CharSet = 'utf-8';
		
		if (($from===FALSE || $to===FALSE) || $subject===FALSE) {
			return FALSE;
		}
		
		if (is_array($from)) { // Name and email
			$mail->From = $from[0];
			$mail->FromName = $from[1];
		} else { // Email only
			$mail->From = $from;
		}

		if (is_array($to)) { // Name and email
			$mail->AddAddress($to[0],$to[1]);
		} else { // Email only
			$mail->AddAddress($to);
		}
		
		$mail->Subject = $subject;
		$mail->Body = $body;
		
		$this->send();
	}
	
	public function send() {
		global $mail;
		
		if ($mail->Send()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>
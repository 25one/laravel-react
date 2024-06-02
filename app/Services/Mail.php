<?php
namespace App\Services;

use App\Services\GuzzleBase;

class Mail extends GuzzleBase {

    private $message;
    private $contact;

	public function getUrl() {
       return 'http://api.25one.com.ua/api_mail.php';
	}

	public function getParams() {
       return [
          'email_to' => config('app.adminemail'),
          'title' => 'Message from user - ' . date('d-m-Y H:i:s'),
          'message' => '<b>Message:</b> ' . $this->message . '<br><b>Contact:</b> ' . $this->contact,
       ];
	}

	public function funcSend($message, $contact) {
		$this->message = $message;
	    $this->contact = $contact;

	    return $this->funcGet();
	}

}

?>

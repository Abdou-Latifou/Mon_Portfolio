<?php

class PHP_Email_Form {

  public $ajax = false;
  public $to = '';
  public $from_name = '';
  public $from_email = '';
  public $subject = '';
  private $messages = [];

  public function add_message($content, $label, $priority = 0) {
    $this->messages[] = "$label: $content";
  }

  public function send() {
    $email_body = implode("\n", $this->messages);
    $headers = "From: {$this->from_name} <{$this->from_email}>\r\n";

    if (mail($this->to, $this->subject, $email_body, $headers)) {
      return json_encode(["status" => "success", "message" => "Your message has been sent. Thank you!"]);
    } else {
      http_response_code(500);
      return json_encode(["status" => "error", "message" => "Error sending the message. Check your server mail configuration."]);
    }
  }
}

?>
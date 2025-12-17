<?php
  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'abdou.l.kedjeri@aims-senegal.org';

  // Check if POST data is set
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? 'Anonymous';
    $email = $_POST['email'] ?? 'no-reply@example.com';
    $subject = $_POST['subject'] ?? 'No Subject';
    $message = $_POST['message'] ?? 'No Message';

    // Construct the email body
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Message: $message\n";

    // Set email headers
    $headers = "From: $email\r\n";

    // Attempt to send the email
    if (mail($receiving_email_address, $subject, $email_body, $headers)) {
      echo json_encode(["status" => "success", "message" => "Your message has been sent. Thank you!"]);
    } else {
      error_log("[ERROR] Failed to send email to $receiving_email_address");
      http_response_code(500);
      echo json_encode(["status" => "error", "message" => "Error sending the message. Check your server mail configuration."]);
    }
  } else {
    error_log("[ERROR] Invalid request method: " . $_SERVER['REQUEST_METHOD']);
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
  }
?>

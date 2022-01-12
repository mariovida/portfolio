<?php
if(isset($_POST['mail'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "info@fi-design.eu";
    $email_subject = "Your email subject line";
 
    function died($error) {
        // your error code can go here
		echo "<br/>Ispričavamo se zbog ovoga, ali čini nam se da je došlo do problema u formularu koji ste poslali.";
        /*echo "We are very sorry, but there were error(s) found with the form you submitted. ";*/
        echo "<br/>U nastavku se nalazi razlog zbog kojega je nastao problem.<br/><br/><br/>";
		echo "----------------------------------------------------------------------------<br/>";
		/*echo "These errors appear below.<br /><br />";*/
        echo $error."----------------------------------------------------------------------------<br/>";
		echo "<br/><br/>";
		echo "Molimo Vas da se vratite na prethodnu stranicu i ispravite greške.";
        /*echo "Please go back and fix these errors.<br /><br />";*/
        die();
    }
 
    if(!isset($_POST['name']) ||
		!isset($_POST['mail']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['comment'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
	}
	
 
    $first_name = $_POST['name']; // required
	$email_from = $_POST['mail']; // required
    $last_name = $_POST['subject']; // required
    $comments = $_POST['comment']; // required
 
  $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= ' > E-mail adresa koju se unijeli nije ispravna.<br />';
  }
 
    $string_exp = "/^[A-Za-zćĆčČžŽđĐšŠ .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= ' > Ime koje ste unijeli nije ispravno.<br />';
  }
 
  if(strlen($last_name) < 2) {
    $error_message .= ' > Predmet je prekratak.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= ' > Komentar je prekratak.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
  
  if(isset($_POST['submit'])) {
		/*echo "USPJEŠNO POSLANO!";*/
		header("location:confirm.html");
	}
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($first_name)."\n";
    $email_message .= "Subject: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Comment: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
<?php
 
}
?>
<?php
/*
Script:  Secure Contact Form Script (FREE Version)
Version: 3.6 FREE
Date:    February 2009
Author:  Stuart Cochrane
URL:     www.freecontactform.com

-- License start --

Copyright (c) 2009 Stuart Cochrane <stuartc1@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software with little restriction, including the rights to use, copy, 
modify, merge, convey and publish the Software, subject to the following conditions:

A. The copyright, permission and conditional notices shall be included in
   all copies or substantial portions of the Software.

B. You will not convey the software (in any form) at a monetary cost (you can't sell it).
	 This includes any derived or merged works which contain any part of this software.

C. If you convey/distribute this software, in any form, you must include the source code.

D. Any derived or merged works must support this license.

E. You will link to the Authors website (www.freecontactform.com) from 
   all interface screens (forms). Links must be standard HTML and link directly.
   You may use any of the following as the link anchor text:
   Contact Form, Website Form, Spam Prevention, Free Contact Form, FreeContactForm.com,
   Email Form, Email Contact Form. Please contact the Author if you wish to remove the
   link.
   
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.


-- License end --

NOTE: 
 We now offer Professional Version (suitable for Professional/Commercial websites).
 Professional version license holders gain more features, more support and more updates.
 Visit: www.freecontactform.com for details.

*/


// THIS CODE IS KEPT LINEAR FOR EASE OF USER UNDERSTANDING
include 'config.php';


// set-up redirect page
if($send_back_to_form == "yes") {
    $redirect_to = $form_page_name."?done=1";   
} else {
    $redirect_to = $success_page;
}


if(isset($_POST['enc'])) {

    
/* THIS IS THE NEW FORM VALIDATION SECTION */
include 'validation.class.php';


// function to handle errors
function error_found($mes,$failure_accept_message,$failure_page) {   
   if($failure_accept_message == "yes") {
        $qstring = "?prob=".urlencode(base64_encode($mes));
   } else {
        $qstring = "";
   }
   $error_page_url = $failure_page."".$qstring;
   header("Location: $error_page_url"); 
   die();     
}


/* SET REQUIRED */
$reqobj = new required;
// ADD ALL REQUIRED FIELDS TO VALIDATE!
$reqobj->add("fullname","NOT_EMPTY");
$reqobj->add("email","EMAIL");
$reqobj->add("comments","NOT_EMPTY");
$reqobj->add("answer_out","NUMERIC");
$out = $reqobj->out();
$val = new validate($out, $_POST);
if($val->error) {
  $er = $val->error_string;
  error_found($er,$failure_accept_message,$failure_page);
  die(); 
}

// check for any human hacking attempts
class clean {
    function comments($message) {
        $this->naughty = false;
        $this->message = $message;
        $bad = array("content-type","bcc:","to:","cc:","href");
        $for = array( "\r", "\n", "%0a", "%0d");
        foreach($bad as $b) {
            if(eregi($b, $this->message)) {
                $this->naughty = true;
            }   
        }   
        $this->message = str_replace($bad,"#removed#", $this->message);
        $this->message = stripslashes(str_replace($for, ' ', $this->message));
        
        // check for HTML/Scripts
        $length_was = strlen($this->message);
        $this->message = strip_tags($this->message);
        if(strlen($this->message) < $length_was) {
            $this->naughty = true;
        }
   }
} // class













/* validate the encrypted strings */
$dec = false;
$valid = false;

$dec = valEncStr(trim($_POST['enc']), $mkMine);
if($dec == true) {
    $valid = true;   
} else {
  $er = "Field data was incorrect.<br />$dec";
  error_found($er,$failure_accept_message,$failure_page);
  die(); 
}


// check the spam question has the correct answer
$ans_one = $_POST['answer_out'];
$fa = new encdec;
$ans_two = $fa->decrypt($_POST['answer_p']);

if($ans_one === $ans_two) {
    $valid = true;
} else {
    $er ='Your spam prevention answer was wrong.';
    error_found($er,$failure_accept_message,$failure_page);
    die(); 
}



if($valid) {
	$email_from = $_POST['email'];
	$email_message = "Please find below a message submitted on ".date("Y-m-d")." at ".date("H:i")."\n\n";
  
  // loop through all form fields submitted
  // ignore all fields used for security measures
  foreach($_POST as $field_name => $field_value) {
    if($field_name == "answer_out" || $field_name == "answer_p" || $field_name == "enc") {
      // do not email these security details
    } else {
        // run all submitted content through string checker
        // removing any dangerous code
      $ms = new clean;
      $ms->comments($field_value);
      $is_naughty = $ms->naughty;
      $this_val = $ms->message;
      $email_message .= $field_name.": ".$this_val."\n\n";
    }
  }

  if($is_naughty) { 
      if($accept_suspected_hack == "yes") {
        // continue
      } else {
        // pretend the email was sent
        header("Location: $redirect_to");
        die();  
      }
      $email_subject = $email_suspected_spam; 
  }
  
// create email headers
$headers = 'From: '.$email_from."\r\n" .
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
  // send the email
  @mail($email_it_to, $email_subject, $email_message, $headers);  
  // redirect
  header("Location: $redirect_to");
  die(); 
}

} else {
	
	extract($_POST);
	if(isset($enc)) {
    echo "register globals may be on, please switch this setting off (look at php.net for details, specifically the ini_set() function )";
	} else {
		die('There was an error, please check the form was configured properly.');
	}
	
}
?>
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
?>
<html>
    <head>
        <title>Form Error</title>
    </head>
<body>
<style>
#er {font-family:arial}
#er .rd{color:#F00}
</style>
<div id="er">
<h1>Form Error</h1>

The error message returned was:<br /><br />
<div class="rd">
<?php
  if(isset($_GET['prob'])) {
      echo urldecode(base64_decode($_GET['prob']));
  }
?>
</div>
<br /><br />
<b>Please hit the browser back button and try again.....</a>
</div>
</body>
</html>
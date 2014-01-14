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

 
// SPECIFY ALL REQUIRED FIELDS AND
// VALIDATION TYPE

// EXAMPLES:
// one or more characters
// required.add('[ FIELDID ]', 'NOT_EMPTY');
// alpha characters, no spaces
// required.add('[ FIELDID ]', 'ALPHA');
// alpha characters, accept spaces
// required.add('[ FIELDID ]', 'ALPHASPACE');
// numeric characters, no spaces
// required.add('[ FIELDID ]', 'NUMERIC');
// numeric characters, also accepts +-.
// required.add('[ FIELDID ]', 'NUMERICPLUS');
// alpha and numeric characters, no spaces
// required.add('[ FIELDID ]', 'ALPHANUM');
// alpha and numeric characters, accept spaces
// required.add('[ FIELDID ]', 'ALPHANUMSPACE');
// email address
// required.add('[ FIELDID ]', 'EMAIL');
// date format yyyy-mm-dd, accepts - or / separators
// required.add('[ FIELDID ]', 'YYYYMMDD');
// date format dd-mm-yyyy, accepts - or / separators
// required.add('[ FIELDID ]', 'DDMMYYYY');
// date format mm-dd-yyyy, accepts - or / separators
// required.add('[ FIELDID ]', 'MMDDYYYY');
// enter own regular expression, example: '^[0-9]{3}$'
// required.add('[ FIELDID ]', '[ REGULAR EXPRESSION ]');

// NOTES:
// [ FIELD ID ] = REPLACE WITH ACTUAL FIELD ID VALUE
// example: <input type="text" name="THIS" ID="THIS"> = THIS

// to specify your own regular expression,
// enter the literal regex as type
// example: required.add('fieldid', '^[0-9]{3}$');
// note: no leading or preceeding / (slash) is required!


function $$(id) {
try {
var tmp = document.getElementById(id).value;
}
catch(e) {
alert("Field " + id + " does not exist!\nvalidation is configured on a field with no ID");
return false;
}
if(tmp == "") {
alert("Field " + id + " cannot be empty");
return false;
}
return tmp;
}

var required = {
field : [],
add : function(name, type) {
this.field[this.field.length] = [name,type];
},
out : function() {
return this.field;
}
}

var validate = {

check : function() {
var tmp;
// loop all required fields
for(var i=0; i<required.field.length; i++) {
// check the form field exists
this.tmp = $$(required.field[i][0]);
if(this.tmp) {
if(this.checkit(required.field[i][0],required.field[i][1])) {
// validated okay
} else {
alert("Field "+required.field[i][0]+" not valid\n");
document.getElementById(required.field[i][0]).focus();
return false;
}
} else {
try {
document.getElementById(required.field[i][0]).focus();
} catch(e) { }
return false;
}
} // for
return true;
},

checkit : function(value,type) {
exp : '';
switch(type) {

case "NOT_EMPTY":
if(this.trim($$(value)).length < 1) { return false; } else { return true; }
break;

case "ALPHA":
exp = /^[A-Za-z]+$/;
if($$(value).match(exp)==null) { return false; } else { return true; }
break;

case "ALPHASPACE":
exp = /^[A-Za-z ]+$/;
if($$(value).match(exp)==null) { return false; } else { return true; }
break;

case "NUMERIC":
exp = /^[0-9]+$/;
if($$(value).match(exp)==null) { return false; } else { return true; }
break;

case "NUMERICPLUS":
exp = /(^-*\d+$)|(^-*\d+\.\d+$)/;
if($$(value).match(exp)==null) { return false; } else { return true; }
break;

case "ALPHANUM":
exp = /^[a-zA-Z0-9]+$/;
if($$(value).match(exp)==null) { return false; } else { return true; }
break;

case "ALPHANUMSPACE":
exp = /^[a-zA-Z0-9 ]+$/;
if($$(value).match(exp)==null) { return false; } else { return true; }
break;

case "EMAIL":
exp = /^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
if($$(value).match(exp)==null) { return false; } else { return true; }
break;

case "YYYYMMDD":
exp = /^(19|20)[0-9][0-9][- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/;
if($$(value).match(exp)==null) { return false; } else { return true; }
break;

case "DDMMYYYY":
exp = /^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)[0-9][0-9]$/;
if($$(value).match(exp)==null) { return false; } else { return true; }
break;

case "MMDDYYYY":
exp = /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)[0-9][0-9]$/;
if($$(value).match(exp)==null) { return false; } else { return true; }
break;

default:
exp = new RegExp(type);
if($$(value).match(exp)==null) { return false; } else { return true; }
} // switch
},
trim : function(s) {
return s.replace(/^\s+/, '').replace(/\s+$/, '');
}

}
function $val(id) {
return document.getElementById(id);
}
function trim(id) {
$val(id).value = $val(id).value.replace(/^\s+/, '').replace(/\s+$/, '');
}
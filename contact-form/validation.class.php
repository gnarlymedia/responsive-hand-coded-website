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
error_reporting(~0);

/* 
    PHP 4 compatible class - 
    change 'var' to 'public' if using PHP 5
*/
class required {
    var $fields; // public
    function required() // __construct()
    {
        $this->fields = array();
    } 
    function add($name, $type) // public
    {
        $this->fields[$name] = $type;
    } 
    function out() // public
    {
        return $this->fields;
    } 
} 

class validate {
    var $error = false; // public
    var $error_string; // publc
    var $error_tmp = "data not valid";

    function validate($ar, $post) // __construct()
    {
        if (!is_array($ar)) {
            /* no validation required */
        } else {
            foreach($ar as $a_name => $a_type) {
                /* if no validation specified, make not_empty */
                if (trim($a_type) == "") {
                    $a_type = "NOT_EMPTY";
                } 
                /* make sure $name is in $post */
                $found = false;
                foreach($post as $p_name => $p_value) {
                    if ($p_name == $a_name) {
                        $found = true;
                        break;
                    } 
                } 
                if (!$found) {
                    $this->error("FIELD: " . $a_name . " -> ERROR: no data submitted.<br />");
                } else {
                    if (is_array($a_type)) {
                        foreach($a_type as $tp) {
                            if (!$this->checkit($p_value, $tp)) {
                                echo "<i>$p_value,$tp</i><br />";
                                $this->error("FIELD: " . $a_name . " -> ERROR: " . $this->error_tmp . "<br />");
                            } 
                        } 
                    } else {
                        if (!$this->checkit($p_value, $a_type)) {
                            $this->error("FIELD: " . $a_name . " -> ERROR: " . $this->error_tmp . "<br />");
                        } 
                    } 
                } 
            } 
        } 
    } 
    /* ERRORS */
    function error($str) // private
    {
        $this->error = true;
        $this->error_string .= $str;
    } 
    /* VALIDATE FIELD AGAINST TYPE */
    function checkit($value, $type) // private
    {
        $length = "";
        if (eregi("^MIN[0-9]+$", $type)) {
            $tmp = explode(":", $type);
            $length = $tmp[1];
            $type = "MINLENGTH";
        } 
        if (eregi("^MAX[0-9]+$", $type)) {
            $tmp = explode(":", $type);
            $length = $tmp[1];
            $type = "MAXLENGTH";
        } 

        switch ($type) {
            case "NOT_EMPTY":
                $this->error_tmp = "string cannot be empty";
                return $this->not_empty($value);
                break;

            case "MINLENGTH":
                if (strlen($value) < $length) {
                    $this->error_tmp = "string to short";
                    return false;
                } else {
                    return true;
                } 
                break;

            case "MAXLENGTH":
                if (strlen($value) > $length) {
                    $this->error_tmp = "string to long";
                    return false;
                } else {
                    return true;
                } 
                break;

            case "ALPHA":
                $exp = "^[a-z]+$";
                if ($this->not_empty($value) && eregi($exp, $value)) {
                    return true;
                } else {
                    $this->error_tmp = "string not alpha";
                    return false;
                } 
                break;

            case "ALPHASPACE":
                $exp = "^[a-z ]+$";
                if ($this->not_empty($value) && eregi($exp, $value)) {
                    return true;
                } else {
                    $this->error_tmp = "string not alphaspace";
                    return false;
                } 
                break;

            case "ALPHANUM":
                $exp = "^[a-z0-9]+$";
                if ($this->not_empty($value) && eregi($exp, $value)) {
                    return true;
                } else {
                    $this->error_tmp = "string not alphanum";
                    return false;
                } 
                break;

            case "ALPHANUMSPACE":
                $exp = "^[a-z0-9 ]+$";
                if ($this->not_empty($value) && eregi($exp, $value)) {
                    return true;
                } else {
                    $this->error_tmp = "string not alphanumspace";
                    return false;
                } 
                break;

            case "NUMERIC":
                $exp = "^[0-9]+$";
                if ($this->not_empty($value) && eregi($exp, $value)) {
                    return true;
                } else {
                    $this->error_tmp = "string not numeric";
                    return false;
                } 
                break;

            case "NUMERICPLUS":
                $exp = "^[0-9+-.]+$";
                if ($this->not_empty($value) && eregi($exp, $value)) {
                    return true;
                } else {
                    $this->error_tmp = "string not numericplus";
                    return false;
                } 
                break;

            case "EMAIL":
                $exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
                if ($this->not_empty($value) && eregi($exp, $value)) {
                    return true;
                } else {
                    $this->error_tmp = "not a valid email";
                    return false;
                } 
                break;

            case "YYYYMMDD":
                $exp = "^(19|20)[0-9][0-9][- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$";
                if ($this->not_empty($value) && eregi($exp, $value)) {
                    return true;
                } else {
                    $this->error_tmp = "string not YYYYMMDD";
                    return false;
                } 
                break;

            case "DDMMYYYY":
                $exp = "^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)[0-9][0-9]$";
                if ($this->not_empty($value) && eregi($exp, $value)) {
                    return true;
                } else {
                    $this->error_tmp = "string not DDMMYYYY";
                    return false;
                } 
                break;

            case "MMDDYYYY":
                $exp = "^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)[0-9][0-9]$";
                if ($this->not_empty($value) && eregi($exp, $value)) {
                    return true;
                } else {
                    $this->error_tmp = "string not MMDDYYYY";
                    return false;
                } 
                break;

            default:
                if ($this->not_empty($value) && $this->regex($type, $value)) {
                    return true;
                } else {
                    $this->error_tmp = "string not valid";
                    return false;
                } 
        } 
    } 
    /* NOT_EMPTY */
    function not_empty($value) // private
    {
        if (trim($value) == "") {
            return false;
        } else {
            return true;
        } 
    } 

    /* REGULAR EXPRESSION */
    function regex($regex, $value) // private
    {
        $the_regex = 'ereg("' . $regex . '", "' . $value . '")';
        $the_code = '<?php if(' . $the_regex . ') { return true; } else { return false; } ?>';
        if (!eval('?>' . $the_code . '<?php ')) {
            return false;
        } else {
            return true;
        } 
    } 
}
?>
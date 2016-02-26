<?php

/* //index.php This file is the main file to send sms normally index.php */
 
 
 $_REQUEST['username']=9092371237;
 $_REQUEST['password']='icrtwicrtw';
 $_REQUEST['receiver']=9791143254;
 $_REQUEST['message']='';

    $username   =   isset($_REQUEST['username'])?trim($_REQUEST['username']):"";
    $password   =   isset($_REQUEST['password'])?trim($_REQUEST['password']):"";
    $receiver   =   isset($_REQUEST['receiver'])?trim($_REQUEST['receiver']):"";
    $message    =   isset($_REQUEST['message'])?trim($_REQUEST['message']):"";

    if (empty($username))
        echo "Enter Username";
    elseif (empty($password))
        echo "Enter Password";
    elseif (empty($receiver))
        echo "Enter Mobile No";
    elseif (empty($message))
        echo "Enter Message";
    else {
        require 'Way2Sms.php';
        $sms            =   new Way2Sms();
        $result         =   $sms->login($username, $password);
        if($result) {
            $smsStatus  =   $sms->send($receiver, $message);
            if($smsStatus)
                echo "Message sent successfully!!!";
            else
                echo "Unable to send message";
            $sms->logout();
        }
        else
            echo "Invalid Username or Password";
    }
?>

<?php
//This filename is Way2Sms.php
  include_once 'CurlProcess.php';

  class Way2Sms{
    
    var $login;
    var $curl;
    var $token;
    var $autobalancer;
    var $cookieToken;
    var $cookieSendSMS;
    
    public function Way2Sms()
    {
        $this->login        =   FALSE;
        $this->autobalancer =   rand(1, 8);
        $this->curl         =   new CurlProcess();
        $this->cookieSendSMS=   "12489smssending34908=67547valdsvsikerexzc435457";
    }

    // Login into website    
    public function login($username, $password)
    {
        $post_data  =   "gval=&username=$username&password=$password&userLogin=no&button=Login";
        $url        =   "http://site".$this->autobalancer.".way2sms.com/Login1.action";
        $ref        =   "http://site".$this->autobalancer.".way2sms.com/entry.jsp";
        $content    =   ($this->curl->post($url,$post_data,$ref));
				
        if (!stristr($content,"Logout")) {
            $this->login=FALSE;
        } else {
            // Find customer token id
		        $regex      =   '/name="id" id="id" value="(.*)"/';
            preg_match($regex,$content,$match);
            
            if(isset($match[1])) {
              $this->token=$match[1];
              preg_match("/w8(\d+)/is",$match[1],$cookieMatch);
              $this->cookieToken=$cookieMatch[1];
              $this->login=TRUE;
            } else {
              $this->login=FALSE;
            }
        }
        return $this->login;
    }
    
    // Try to send SMS
    public function send($number,$message)
    {
			  if ($this->login) {
				  $mobileNo    =  trim($number);
				  $msg         =  urlencode(trim($message));
				  $post_data   =  "";
				  $ref         =   "http://site".$this->autobalancer.".way2sms.com/singles.action?Token=".$this->token;
				  $content     =   $this->curl->get($ref, "JSESSIONID=A".$this->cookieToken."~".$this->token);
				
				  // Dynamic read text area from the page
				  preg_match_all("~<textarea(?=[^>]* name=[\"']([^'\"]*)|)(\s+[^>]*)?>(.*?)</textarea>~",$content,$textAreaResults);
				  if(isset($textAreaResults[3])) {
					  $textAreaNames  =  $textAreaResults[1];
					  $textAreaValues =  $textAreaResults[3];
					  foreach($textAreaNames as $textAreaKey => $textAreaName) {
						  if(trim($textAreaName)=="m_15_b")
							  $post_data  .=  "&".$textAreaValues[$textAreaKey]."=".$mobileNo;
						  if(empty($textAreaValues[$textAreaKey]))
							  $post_data  .=  "&".$textAreaName."=". $msg;
						  elseif(stristr($textAreaValues[$textAreaKey],"enter your mobile number"))
							  $post_data  .= "";
						  elseif(!empty($textAreaValues[$textAreaKey]))
							  $post_data  .=  "&".$textAreaName."=". urlencode(trim($textAreaValues[$textAreaKey]));
					  }
				  }
                  
				  // Dynamic read input from the page
				  preg_match_all('/<input(?=[^>]* name=["\']([^\'"]*)|)(?=[^>]* value=["\']([^\'"]*)|)/',$content,$results);
				  if(isset($results[2])) {
					  $inputNames  =  $results[1];
					  $inputValues =  $results[2];
					  foreach($inputNames as $key => $inputName) {
						  if(!empty($inputName)) {
							  if(trim($inputName)=="m_15_b")
								  $post_data  .=  "&".$inputValues[$key]."=".$mobileNo;
							  if(trim($inputName) == "chkall")
								  $post_data  .=  "&".$inputName."=on";
							  elseif(trim($inputValues[$key]) == "Mobile Number")
								  $post_data  .=  "&".$inputName."=".$mobileNo;
							  elseif(!empty($inputValues[$key]) && $inputValues[$key]!= "+91")
								  $post_data  .=  "&".$inputName."=".urlencode(trim($inputValues[$key]));
						  }
					  }
				  }

				  // Dynamic read select tag from the page
				  preg_match_all("#<select(?=[^>]* name=[\"']([^'\"]*)|)(\s+[^>]*)?>(.|\n)*?</select>#",$content,$selectResults);
				  if(isset($selectResults[1])) {
					  $selectNames  =  $selectResults[1];
					  $selectTags   =  $selectResults[0];
					  foreach($selectTags as $selectTagKey => $selectTag) {
						  preg_match('/<option(?=[^>]* value=["\']([^\'"]*)|)/',$selectTag,$selectOptValue);
						  if(count($selectOptValue)>1 && !empty($selectOptValue[1])) {
							  $post_data  .=  "&".$selectNames[$selectTagKey]."=".urlencode(trim($selectOptValue[1]));
							  if(trim($selectNames[$selectTagKey])=="m_15_b")
								  $post_data  .=  "&".$selectOptValue[1]."=".$mobileNo;
						  }
					  }
				  }

				  // Dynamically Load js fields
				  preg_match_all("/setAttribute((.|\n)*?);/is",$content,$jsResults);
				  if(isset($jsResults)) {
					  foreach ($jsResults[1] as $key => $value) {
						  $strValue = str_replace(array("\"","(",")"), "", $jsResults[1][$key]);
						  $KeyValue = explode(",", $strValue);
						  if($KeyValue[0]=="value") {
							  $strName = str_replace(array("\"","(",")"), "", $jsResults[1][$key+1]);
							  $strName = explode(",", $strName);
							  if($strName[0]=="name")
								  $post_data  .=  "&".trim($strName[1])."=".urlencode(trim($KeyValue[1]));
						  }
					  }
				  }

				  // Dynamically get form action url to send sms
				  $regex      =   "/<form.*action=(\"([^\"]*)\"|'([^']*)'|[^>\s]*)([^>]*)?>/is";                
				  preg_match($regex,$content,$match);
				  if(isset($match[1]))
					  $frmAction  =   $match[1];
				  else {
					  preg_match("/document.InstantSMS.action=(\"([^\"]*)\"|'([^']*)'|[^>\s]*)([^>]*)?;/is",$content,$match);
					  $frmAction  =   $match[2];
				  }

				  // Post message
				  $frmAction  =   trim(str_replace(array('"','../','./',''), ' ', $frmAction));
				  $url        =   "http://site".$this->autobalancer.".way2sms.com/".$frmAction;
				  $content    =   ($this->curl->post($url,$post_data, $ref, "JSESSIONID=A".$this->cookieToken."~".$this->token."; ".$this->cookieSendSMS));
				  if(stristr($content,"submitted successfully"))
					  return true;
				  else {
					  $regex      =   "/img(?=[^>]* src=[\"']([^'\"]*)|)(\s+[^>]*)/is";
					  preg_match_all($regex,$content,$match);
					  foreach($match[1] as $ms) {
						  if(stristr($ms,"CaptchaServlet?rd=")) {
							  $capcha = substr($ms, 18);
							  $post_data .= "&textcode=".$capcha;
						  }
					  }
					  $content    =   ($this->curl->post($url,$post_data,$ref));
					  if(stristr($content,"submitted successfully"))
						  return true;
					  else
						  return false;
				  }
			  } else
          return false;
    }

    // Logout from site
    public function logout()
    {
        $post_data  =   "1=1";
        $url        =   "http://site".$this->autobalancer.".way2sms.com/jsp/logout.jsp";
        $content    =   ($this->curl->post($url,$post_data));
        if(stristr($content,"successfully logged out"))
          return true;
        else
          return false;
    }
    
  }
?>

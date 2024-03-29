<?php 
/*	
	@name:                    stackoverflow questions viewer (SQV)
	@filename:                sqv.php
	@Online :				  http://www.svoptik.com/elahe/sqv1.php
	@version:                 1.0
	@date:                    December 13, 2019
	@author:                  Elahe Nourkami
	@email:                   nourkami.e@gmail.com
	@server requirements:     PHP + Apache
	@browser requirements:    regular browser
	This Script is free software; you can redistribute it and/or modify it under the terms of the
	GNU General Public License as published by the Free Software Foundation.


This is a PHP Script which helps people who are active users on "www.stackoverflow.com" and also interested in android. 
SQV(stackoverflow questions viewer) shows 10 newest Android-related questions and the 10 most voted Android-related questions posted in the past week on one page.
In addition you can read the full information of the questions by clicking the titles.
 */
    function get_web_page( $url )
    {
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $options = array(

            CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
            CURLOPT_POST           =>false,        //set to GET
            CURLOPT_USERAGENT      => $user_agent, //set user agent
            CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false,
        );
 

        $ch  = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }
 
///set request time for 30 Sec
$time_start = microtime(true);//1
$timeout=false;
    while(true){
            ///Reload Again for Not show Robot Stackoverflow
            $result = get_web_page("https://stackoverflow.com/search?tab=votes&q=%5bandroid%5d%20created%3a7d..%20is%3aquestion");//http://stackoverflow.com/search?q=%5Bandroid%5D+created%3A7d..+is%3Aquestion
            $page = $result['content'];
            $doc = new DOMDocument();
            @$doc->loadHtml($page);
            $xpath = new DOMXpath($doc);
            $elements = $xpath->query("//div[@class='flush-left js-search-results']");
            if ($elements->length > 0) {
                break;
            }
           sleep(1);
            if((microtime(true) - $time_start)==30){$timeout=true;break;}
    }

	 if(!$timeout){
 

                 $sub = $xpath->query("//div[@class='question-summary search-result']", $elements->item(0));
                 if($sub->length>10){$len = 10;}else{$len=$sub->length;}
				  echo "<h2> Most voted </h2><br>";
				 for($i = 0;$i<$len;$i++){
                     $votes = $xpath->query(".//div[@class='vote']", $sub->item($i))->item(0)->nodeValue;
                     $answeres = $xpath->query(".//div[contains(@class,'status')]", $sub->item($i))->item(0)->nodeValue;
                    $title = $xpath->query(".//a[@class='question-hyperlink']", $sub->item($i))->item(0)->nodeValue;
                    $excerpt = $xpath->query(".//div[@class='excerpt']", $sub->item($i))->item(0)->nodeValue;

					 echo "<div style='display: inline-block'>";
                         echo "<div style='float: left;width: 100px;'>";
                                echo $votes ."<hr>" . $answeres;
                         echo "</div>";
                         echo "<div style='float: right;width: 700px;'>";
                         echo $title ."<hr>" . $excerpt;
                         echo "</div>";
                     echo "</div>";
                     echo "<br><hr>";



                 }
				 echo "<hr><hr><hr>";

     }else{
	     echo "stackoverflow Robot has blocked You";
     }



?>
 
 

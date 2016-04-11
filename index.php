<!--
Author: DOSIKA WEBSITES
Author URL: http://dosikawebsites.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
    <head>
        <title>WASP AFRICA SUBSCRIPTION SERVICE</title>
        <link rel="icon" href="images/favicon.ico" type="image/ico" sizes="16x16 32x32">
	<link rel="icon" href="images/favicon.png" type="image/png" sizes="16x16 32x32">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="WASP AFRICA SUBSCRIPTION SERVICE"/>
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

    </head>

    <body>

        <div class="header">

            <h1>Subscribe Now</h1>
        </div>

        <div class="mail-form shadow">
            <form method="POST" action='index.php'>
                <input type='text' name='recipient'>
                <input type='hidden' value="Send DOSIKA to 21208 to START WINNING NOW!" name='message'>
                <p></p>
                <input style="margin-top: 20px;" type="submit" value="Subscribe">
            </form>
            <?php
           
            ########################################################
            # Login information for the SMS Gateway
            ########################################################

            $ozeki_user = "admin";
            $ozeki_password = "*1wasp123";
            $ozeki_url = "http://172.31.183.218:4994/api?";

            ########################################################
            # Functions used to send the SMS message
            ########################################################

            function httpRequest($url) {
                $pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
                preg_match($pattern, $url, $args);
                $in = "";
                $fp = fsockopen("$args[1]", $args[2], $errno, $errstr, 30);
                if (!$fp) {
                    return("$errstr ($errno)");
                } else {
                    $out = "GET /$args[3] HTTP/1.1\r\n";
                    $out .= "Host: $args[1]:$args[2]\r\n";
                    $out .= "User-agent: Ozeki PHP client\r\n";
                    $out .= "Accept: */*\r\n";
                    $out .= "Connection: Close\r\n\r\n";

                    fwrite($fp, $out);
                    while (!feof($fp)) {
                        $in.=fgets($fp, 128);
                    }
                }
                fclose($fp);
                return($in);
            }

            function ozekiSend($phone, $msg, $debug = false) {
                global $ozeki_user, $ozeki_password, $ozeki_url;

                $url = 'username=' . $ozeki_user;
                $url.= '&password=' . $ozeki_password;
                $url.= '&action=sendmessage';
                $url.= '&messagetype=SMS:TEXT';
                $url.= '&recipient=' . urlencode($phone);
                $url.= '&messagedata=' . urlencode($msg);
                //$tel = "+254" . substr($_POST['tel'], -9);

                $urltouse = $ozeki_url . $url;
                if ($debug) { //echo "Request: <br>$urltouse<br><br>"; 
                }

                //Open the URL to send the message
                $response = httpRequest($urltouse);
                if ($debug) {
                    echo 'Thank you for subscribing!';
                    //echo "Response: <br><pre>".
                    //str_replace(array("<",">"),array("&lt;","&gt;"),$response).
                    //"</pre><br>"; 
                }

                //return($response);
            }

            ########################################################
            # GET data from sendsms.html
            ########################################################
             if(isset($_POST['recipient'])&&isset($_POST['message'])){
            $phonenum = "254" . substr($_POST['recipient'], -9);
            $message = $_POST['message'];
            $debug = true;

            ozekiSend($phonenum, $message, $debug);
           }
            ?>
        </div>

        <div class="footer">
            <p>© 2016 WASP Africa LTD. All Rights Reserved | Design by  <a href="www.dosikawebsites.com" target="_blank"> WASP AFRICA </a></p>
        </div>

    </body>
</html>

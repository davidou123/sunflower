<?
function cURL($url, $header=NULL, $cookie=NULL, $post=NULL)
{
    //$user_agent = $_SERVER['HTTP_USER_AGENT']; 
    $user_agent = 'Mozilla/5.0 (Windows NT 5.1; rv:10.0.2) Gecko/20100101 Firefox/10.0.2';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_NOBODY, $header);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      
    if ($post) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    $result = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
      
    if($result){
        return $result;
    }else{
        return $error;
    }
}
  
function curl_fb($url){
    //輸入要用來登入的e-mail與密碼
    $EMAIL = "";
    $PASSWORD = "";
 
    $fb_login_url = "https://login.facebook.com/login.php?login_attempt=1"; 
    $result = cURL($fb_login_url,true,null,"email=$EMAIL&pass=$PASSWORD");
    preg_match('%Set-Cookie: ([^;]+);%',$result,$M);
    $result = cURL($fb_login_url,true,$M[1],"email=$EMAIL&pass=$PASSWORD");
    preg_match_all('%Set-Cookie: ([^;]+);%',$result,$M);
     
    $cookie = '';
    for($i=0;$i<count($M[0]);$i++){
        $cookie .= $M[1][$i].";";
    } 
 
    return cURL($url,null,$cookie,null);
}
 
//要抓取的網頁顯示出來
$url = 'https://www.facebook.com/pages/%E7%84%A1%E9%99%90%E6%9C%9F%E6%94%AF%E6%8C%81%E6%96%B9%E4%BB%B0%E5%AF%A7%E6%94%AF%E6%8C%81%E8%AD%A6%E5%AF%9F/310212962461242?fref=ts';
$lines_string= curl_fb($url);
 eregi("cg\"><div class=\"fsm fwn fcg\">(.*) 人說讚", $lines_string, $head);

 $url2 = 'http://www.facebook.com/pages/%E6%96%B9%E4%BB%B0%E5%AF%A7%E5%8A%A0%E6%B2%B9/1422073471381129?ref=stream';
$lines_string2= curl_fb($url2);
 eregi("cg\"><div class=\"fsm fwn fcg\">(.*) 人說讚", $lines_string2, $head2);
 

echo "無限期支持方仰寧、支持警察". $head[1];
echo "<br>";
echo "方仰寧加油".$head2[1];
?>

<html>
<head>
<meta http-equiv="Content-Language" content="zh-tw"></meta>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>
<script>
window.setTimeout("refresh()", 1000)

function refresh()
{
var time = new Date();
if ( time.getSeconds() == 0)
location.reload();

window.setTimeout("refresh()", 1000)
}

</script>
<title>方仰寧專用BOT</title>
</meta></head>
<body onload="refresh()">

</body>
</html>
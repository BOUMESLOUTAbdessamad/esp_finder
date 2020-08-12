<?php

function query($method = "GET",$path = "",$query = [],$data = []) {
    $end = "https://chiptuning-file.firebaseio.com/".$path.".json";
    /*$data = [
            "clientKey" => "5ad208947855374818372e8e9045db64",
            "queueId" => 6
    ];*/
        
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$end);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CUSTOMREQUEST, $method);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    $postDataEncoded = json_encode($data);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$postDataEncoded);
    curl_setopt($ch,CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',     
        'Accept: application/json',     
        'Content-Length: ' . strlen($postDataEncoded) 
    ));
    $result = curl_exec($ch);
    $curlError = curl_error($ch);
    if ($curlError != "") {
        return false;
    }
    curl_close($ch);
    return $result;
}

function j($s, $echo = true) {
    if ($echo) {
        header('Content-type: application/json');
        echo json_encode($s);
    } else {
        return json_encode($s);
    }

}

function stamp() {
    return date('Y-m-d H:i:s');
}

function post() {
    $_POST = json_decode(file_get_contents('php://input'), true);
    return json_decode(file_get_contents('php://input'), true);
}

function pages($total, $current = 1) {

    $end = (((LIMIT * $current) + ($current - 1)) > $total ? $total : (LIMIT * $current) +
        ($current - 1));
    $start = ((((LIMIT * $current) + ($current - 1)) - LIMIT) == 0 ? 1 : (((LIMIT *
        $current) + ($current - 1))) - LIMIT);
    $pages = (($total % LIMIT) > 0 ? (int)($total / LIMIT) + 1 : ($total / LIMIT));

    //calculate vector
    $vector = [];
    for($i = 0;$i <= $pages;$i++) {
        if(!($i > 3 && $i <= $pages - 3) || ($i >= $current - 3 && $i < $current + 4)) {
            $vector[] = $i;
        }
    }
    //
    
    $result = array(
        "total" => $total,
        "pages" => $pages,
        "start" => $start,
        "end" => $end,
        "current" => $current,
        "next" => ($current >= $pages ? false : $current + 1),
        "prev" => ($current <= 1 ? false : $current - 1),
        "separations" => [
                ($current - 3 > 4 ? $current - 3 : null),
                ($current < $total - 6 ? $current + 4 : null)
            ],
        "vector" => $vector
        );
    
    return $result;
}

function n_crypt($string) {
    //$string = 'string to be encrypted';

    /*$encrypted = base64_encode(mcrypt_encrypt(N_ALG, md5(N_KEY), $string,
        MCRYPT_MODE_CBC, md5(md5(N_KEY))));*/
    $encrypted = openssl_encrypt($string, N_ALG , N_KEY, 0, N_IV);
    return $encrypted;
}

function n_decrypt($string) {
    /*$decrypted = rtrim(mcrypt_decrypt(N_ALG, md5(N_KEY), base64_decode($string),
        MCRYPT_MODE_CBC, md5(md5(N_KEY))), "\0");*/
    $decrypted = openssl_decrypt($string, N_ALG, N_KEY, 0, N_IV);
    return $decrypted;
}

function ago($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function access($success = null, $error = null) {

    //access should go  : controller : methode : extras ...

    //Access Temp Settings

    //
    $ci = &get_instance();
    $data = array();
    $data['controller'] = $ci->router->fetch_class();
    $data['method'] = $ci->router->fetch_method();
    $ci->load->library('session');
    
    if ((!isset($_SESSION['user']) || $_SESSION['user']['role'] != "admin") && ($data['controller'] !== "users" || $data['method'] !== "login" )) {
            if ($error) {
            //applied error fallback
            $ci->output->set_status_header(401);
            $error();
        } else {
            //default error fallback
            redirect(base_url("users/login/"));
        }
    } else {
        //success extra callback
        if ($success) {
            $success();
        }
    }

    if ((isset($_GET['ajax'])) /*dif route ajax calls*/ ) {
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');
    } else {
        if (($data['controller'] !== "users" || $data['method'] !== "auth")) {
            //$this->load->view("header", $data);
        }
    }
}

function language() {
    $ci = &get_instance();
    $langs = ['en', "fr"];
    if (isset($_GET['hl']) && in_array($_GET['hl'], $langs)) {
        //select by url param
        $_SESSION['lang'] = strtolower($_GET['hl']);
    } else
        if (isset($_SESSION["lang"])) {
            //select based on previous session
            $_SESSION['lang'] = $_SESSION['lang'];
        } else {
            //select by domaine => english by defualt
            $_SESSION['lang'] = "en";
        }

        //Interface Language File
        switch ($_SESSION['lang']) {
            case 'en':
                $ci->lang->load('help_center', 'english');
                $ci->lang->load('global', 'english');
                break;
            case 'fr':
                $ci->lang->load('help_center', 'french');
                $ci->lang->load('global', 'french');
                break;
        }
}

function folder($id = 0) {
    return substr(base64_encode($id),0,3)."/".$id."/";
}

function mime2ext($mime){
  $all_mimes = '{"png":["image\/png","image\/x-png"],"bmp":["image\/bmp","image\/x-bmp","image\/x-bitmap","image\/x-xbitmap","image\/x-win-bitmap","image\/x-windows-bmp","image\/ms-bmp","image\/x-ms-bmp","application\/bmp","application\/x-bmp","application\/x-win-bitmap"],"gif":["image\/gif"],"jpeg":["image\/jpeg","image\/pjpeg"],"xspf":["application\/xspf+xml"],"vlc":["application\/videolan"],"wmv":["video\/x-ms-wmv","video\/x-ms-asf"],"au":["audio\/x-au"],"ac3":["audio\/ac3"],"flac":["audio\/x-flac"],"ogg":["audio\/ogg","video\/ogg","application\/ogg"],"kmz":["application\/vnd.google-earth.kmz"],"kml":["application\/vnd.google-earth.kml+xml"],"rtx":["text\/richtext"],"rtf":["text\/rtf"],"jar":["application\/java-archive","application\/x-java-application","application\/x-jar"],"zip":["application\/x-zip","application\/zip","application\/x-zip-compressed","application\/s-compressed","multipart\/x-zip"],"7zip":["application\/x-compressed"],"xml":["application\/xml","text\/xml"],"svg":["image\/svg+xml"],"3g2":["video\/3gpp2"],"3gp":["video\/3gp","video\/3gpp"],"mp4":["video\/mp4"],"m4a":["audio\/x-m4a"],"f4v":["video\/x-f4v"],"flv":["video\/x-flv"],"webm":["video\/webm"],"aac":["audio\/x-acc"],"m4u":["application\/vnd.mpegurl"],"pdf":["application\/pdf","application\/octet-stream"],"pptx":["application\/vnd.openxmlformats-officedocument.presentationml.presentation"],"ppt":["application\/powerpoint","application\/vnd.ms-powerpoint","application\/vnd.ms-office","application\/msword"],"docx":["application\/vnd.openxmlformats-officedocument.wordprocessingml.document"],"xlsx":["application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application\/vnd.ms-excel"],"xl":["application\/excel"],"xls":["application\/msexcel","application\/x-msexcel","application\/x-ms-excel","application\/x-excel","application\/x-dos_ms_excel","application\/xls","application\/x-xls"],"xsl":["text\/xsl"],"mpeg":["video\/mpeg"],"mov":["video\/quicktime"],"avi":["video\/x-msvideo","video\/msvideo","video\/avi","application\/x-troff-msvideo"],"movie":["video\/x-sgi-movie"],"log":["text\/x-log"],"txt":["text\/plain"],"css":["text\/css"],"html":["text\/html"],"wav":["audio\/x-wav","audio\/wave","audio\/wav"],"xhtml":["application\/xhtml+xml"],"tar":["application\/x-tar"],"tgz":["application\/x-gzip-compressed"],"psd":["application\/x-photoshop","image\/vnd.adobe.photoshop"],"exe":["application\/x-msdownload"],"js":["application\/x-javascript"],"mp3":["audio\/mpeg","audio\/mpg","audio\/mpeg3","audio\/mp3"],"rar":["application\/x-rar","application\/rar","application\/x-rar-compressed"],"gzip":["application\/x-gzip"],"hqx":["application\/mac-binhex40","application\/mac-binhex","application\/x-binhex40","application\/x-mac-binhex40"],"cpt":["application\/mac-compactpro"],"bin":["application\/macbinary","application\/mac-binary","application\/x-binary","application\/x-macbinary"],"oda":["application\/oda"],"ai":["application\/postscript"],"smil":["application\/smil"],"mif":["application\/vnd.mif"],"wbxml":["application\/wbxml"],"wmlc":["application\/wmlc"],"dcr":["application\/x-director"],"dvi":["application\/x-dvi"],"gtar":["application\/x-gtar"],"php":["application\/x-httpd-php","application\/php","application\/x-php","text\/php","text\/x-php","application\/x-httpd-php-source"],"swf":["application\/x-shockwave-flash"],"sit":["application\/x-stuffit"],"z":["application\/x-compress"],"mid":["audio\/midi"],"aif":["audio\/x-aiff","audio\/aiff"],"ram":["audio\/x-pn-realaudio"],"rpm":["audio\/x-pn-realaudio-plugin"],"ra":["audio\/x-realaudio"],"rv":["video\/vnd.rn-realvideo"],"jp2":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"tiff":["image\/tiff"],"eml":["message\/rfc822"],"pem":["application\/x-x509-user-cert","application\/x-pem-file"],"p10":["application\/x-pkcs10","application\/pkcs10"],"p12":["application\/x-pkcs12"],"p7a":["application\/x-pkcs7-signature"],"p7c":["application\/pkcs7-mime","application\/x-pkcs7-mime"],"p7r":["application\/x-pkcs7-certreqresp"],"p7s":["application\/pkcs7-signature"],"crt":["application\/x-x509-ca-cert","application\/pkix-cert"],"crl":["application\/pkix-crl","application\/pkcs-crl"],"pgp":["application\/pgp"],"gpg":["application\/gpg-keys"],"rsa":["application\/x-pkcs7"],"ics":["text\/calendar"],"zsh":["text\/x-scriptzsh"],"cdr":["application\/cdr","application\/coreldraw","application\/x-cdr","application\/x-coreldraw","image\/cdr","image\/x-cdr","zz-application\/zz-winassoc-cdr"],"wma":["audio\/x-ms-wma"],"vcf":["text\/x-vcard"],"srt":["text\/srt"],"vtt":["text\/vtt"],"ico":["image\/x-icon","image\/x-ico","image\/vnd.microsoft.icon"],"csv":["text\/x-comma-separated-values","text\/comma-separated-values","application\/vnd.msexcel"],"json":["application\/json","text\/json"]}';
  $all_mimes = json_decode($all_mimes,true);
  foreach ($all_mimes as $key => $value) {
    if(array_search($mime,$value) !== false) return $key;
  }
  return false;
}

?>
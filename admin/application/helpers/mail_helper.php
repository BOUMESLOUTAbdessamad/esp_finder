<?php

function amazonSes($from_name, $from, $to_name, $to, $subject, $textBody,$htmlBody, $attchements) {
    include APPPATH . 'third_party/SimpleEmailService.php';
    include APPPATH . 'third_party/SimpleEmailServiceMessage.php';
    include APPPATH . 'third_party/SimpleEmailServiceRequest.php';
    
    $m = new SimpleEmailServiceMessage();
    if($to_name) {
        $m->addTo("$to_name <$to>");
    } else {
        $m->addTo($to);
    }
    
    if($from_name) {
        $m->setFrom("$from_name <$from>");
    } else {
        $m->setFrom($from);
    }
    
    //$m->addAttachmentFromFile('index.jpg', "http://images.frandroid.com/wp-content/uploads/2015/03/amazon_1-1000x364.jpg","image/jpeg");
    //$m->addAttachmentFromUrl('index.jpg', "http://images.frandroid.com/wp-content/uploads/2015/03/amazon_1-1000x364.jpg","image/jpeg");
    $m->setSubject($subject);
    $m->setMessageFromString($textBody,$htmlBody);
    $ses = new SimpleEmailService(AWS_KEY,AWS_SECRET, "email.eu-west-1.amazonaws.com");
    $ses->enableVerifyHost(false);
    return $ses->sendEmail($m);
}

?>
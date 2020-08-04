<?php
function activate($mailaddress){
    require_once("database.php");
    $db = new database("activation");
    $rnd = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 30);
    $db->add(["seed"=>$rnd,"mailaddress"=>$mailaddress]);

    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    require '../phpmailer/setting.php';

    // PHPMailerのインスタンス生成
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP(); // SMTPを使うようにメーラーを設定する
    $mail->SMTPAuth = true;
    $mail->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
    $mail->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
    $mail->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
    $mail->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
    $mail->Port = SMTP_PORT; // 接続するTCPポート

    // メール内容設定
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "base64";
    $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
    $mail->addAddress($mailaddress, '受信者さん'); //受信者（送信先）を追加する
    $mail->Subject = MAIL_SUBJECT; // メールタイトル
    $mail->isHTML(false);    // HTMLフォーマットの場合はコチラを設定します
    $body =  'TECH-BASEインターンシップ【中田敦也】ウェブサイトのメール認証です。
    認証するには"https://tb-220127.tech-base.net/login/authentication.php?seed='.$rnd.'をクリックしてください。';

    $mail->Body = $body; // メール本文
    // メール送信の実行
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

?>

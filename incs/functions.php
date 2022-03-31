<?php

/**
 * Функция для распечатки массивов
 */

function debug($data){
    echo '<pre>'.print_r($data, 1) . '</pre>';
}

/**
 * Функция для заполнения полей массива $fields из $_POST; 
 * @ var $data array 
 */

 function load($data){
    foreach($_POST as $key => $value ){
        if(array_key_exists($key, $data)){
            $data[$key]['value'] = trim($value);

        }
    }
    return $data;
}

/**
 * Функция валидации данных 
 * @ var array
 */ 

function validate($data){
    $errors = '';
    foreach($data as $key => $value){
        if($data[$key]['requiered'] && empty($data[$key]['value'])){
            $errors .= "<li>Вы не заполнели поле {$data[$key]['field_name']}</li>";
        }
    }
    if (!check_captcha($data['captcha']['value'])){
        $errors .= "<li>Не верно заполнено поле Captcha</li>";
    }
    
    return $errors;
}

function set_captcha(){
    $num1 = rand(1,100);
    $num2 = rand(1,100);

    $_SESSION['captcha'] = $num1 + $num2;

    return "Сколько будет {$num1} + {$num2}?";

}

function check_captcha($res){
    return $res ==  $_SESSION['captcha'];
}

function send_mail($fields, $mail_settings){
    $mail = new \PHPMailer\PHPMailer\PHPMailer();

    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $mail_settings['host'];
        $mail->SMTPAuth = $mail_settings['smtp_auth'];
        $mail->Username = $mail_settings['username'];
        $mail->Password = $mail_settings['password'];
        $mail->SMTPSecure = $mail_settings['smtp_secure'];
        $mail->Port = $mail_settings['port'];

        $mail->setFrom($mail_settings['from_email'], $mail_settings['from_name']);
        $mail->addAddress($mail_settings['to_email']);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Форма с сайта';

        $flag = true;
        $message = '';
        foreach ($fields as $k => $v) {
            if (isset($v['mailable']) && $v['mailable'] == 0){
                continue;
            }
            $message .= ( ($flag = !$flag) ? '<tr>' : '<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>{$v['field_name']}</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>{$v['value']}</td>
			</tr>";
        }

        $mail->Body = "<table style='width: 100%;'>$message</table>";
        if (!$mail->send()) {
            return false;
        }

        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }

}

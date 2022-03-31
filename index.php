<?php

session_start();
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/incs/data.php';
require_once __DIR__ . '/incs/functions.php';


if(!empty($_POST)){
    $fields = load($fields);
    if($errors = validate($fields)){
        $res = ['answer' => 'error', 'errors' => $errors];
    }else{
        if(!send_mail($fields, $mail_settings)){
            $res = ['answer' => 'error', 'errors' => 'Ошибка отправки письма'];
        }else{
            $res = ['answer' => 'ok', 'captcha' => set_captcha()];

        }
        
        
    }
    exit(json_encode($res));
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">

            <form method="post" id="form" class="needs-validation mt-5 mb-5" novalidate>

                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните имя
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните почту
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Адрес</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>

                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните телефон
                    </div>
                </div>

                <div class="form-group">
                    <label for="comment">Комментарий</label>
                    <textarea name="comment" id="comment" rows="3" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="captcha" id="label-captcha"><?= set_captcha() ?></label>
                    <input type="text" class="form-control" id="captcha" name="captcha" required>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните капчу
                    </div>
                </div>

                <div class="form-group form-check">
                    <input name="agree" type="checkbox" class="form-check-input" id="agree" required>
                    <label class="form-check-label" for="agree">Соглашаюсь с обработкой персональных данных</label>
                    <div class="invalid-feedback">
                        Пожалуйста, согласитесь
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                
                <div class="mt-3" id="answer"></div>
                
                <div class="loader">
                    <img src="walk.gif" alt="">
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="main.js"></script>

</body>
</html>
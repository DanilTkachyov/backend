<?php

header('Content-Type: text/html; charset=UTF-8');
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(!empty($_GET['logout'])) {
        setcookie('name_value', '', 100000);
        setcookie('email_value', '', 100000);
        setcookie('date_value', '', 100000);
        setcookie('gender_value', '', 100000);
        setcookie('limbs_value', '', 100000);
        setcookie('stand_value', '', 100000);
        setcookie('bio_value', '', 100000);
        setcookie('policy_value', '', 100000);
        header('Location: ./');
    }

  
  $messages = array();
  
  if (!empty($_COOKIE['save'])) {
    
    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('pass', '', 100000);
    
    $messages[] = 'Спасибо, результаты сохранены.';
    
    if (!empty($_COOKIE['pass'])) {
      $messages[] = sprintf(
        'Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
        strip_tags($_COOKIE['login']),
        strip_tags($_COOKIE['pass'])
      );
    }
  }

  
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['date'] = !empty($_COOKIE['date_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['limbs'] = !empty($_COOKIE['limbs_error']);
  $errors['stand'] = !empty($_COOKIE['stand_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['policy'] = !empty($_COOKIE['policy_error']);

  
  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages[] = '<div class="error">Введите имя.</div>';
  }
  if ($errors['email']) {
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="error">Введите верный email.</div>';
  }
  if ($errors['date']) {
    setcookie('date_error', '', 100000);
    $messages[] = '<div class="error">Введите корректную дату рождения.</div>';
  }
  if ($errors['gender']) {
    setcookie('gender_error', '', 100000);
    $messages[] = '<div class="error">Выберите пол.</div>';
  }
  if ($errors['limbs']) {
    setcookie('limbs_error', '', 100000);
    $messages[] = '<div class="error">Выберите количество конечностей.</div>';
  }
  if ($errors['stand']) {
    setcookie('stand_error', '', 100000);
    $messages[] = '<div class="error">Выберите суперспособнос(ть/ти).</div>';
  }
  if ($errors['bio']) {
    setcookie('bio_error', '', 100000);
    $messages[] = '<div class="error">Расскажите о себе.</div>';
  }
  if ($errors['policy']) {
    setcookie('policy_error', '', 100000);
    $messages[] = '<div class="error">Ознакомтесь с политикой обработки данных.</div>';
  }
  
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : strip_tags($_COOKIE['name_value']);
  $values['email'] = empty($_COOKIE['email_value']) ? '' : strip_tags($_COOKIE['email_value']);
  $values['date'] = empty($_COOKIE['date_value']) ? '' : strip_tags($_COOKIE['date_value']);
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : strip_tags($_COOKIE['gender_value']);
  $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : strip_tags($_COOKIE['limbs_value']);
  $values['stand'] = empty($_COOKIE['stand_value']) ? '' : strip_tags($_COOKIE['stand_value']);
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : strip_tags($_COOKIE['bio_value']);
  $values['policy'] = empty($_COOKIE['policy_value']) ? '' : strip_tags($_COOKIE['policy_value']);
  
  if (empty($errors) && !empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login'])) {
    try {
      $user = 'u47588';
      $pass = '9029914';
      $member = $_SESSION['login'];
      $db = new PDO('mysql:host=localhost;dbname=u47588', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
      $stmt = $db->prepare("select * FROM clients2 WHERE login = ?");
      $stmt->execute(array($member));
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $values['name'] = $result['name'];
      $values['email'] = $result['email'];
      $values['date'] = $result['date'];
      $values['gender'] = $result['gender'];
      $values['limbs'] = $result['limbs'];
      $values['bio'] = $result['bio'];
      $values['policy'] = $result['policy'];

      $stand = $db->prepare("select * FROM powers2 WHERE user_login = ?");
      $stand->execute(array($member));
      $result = $stand->fetch(PDO::FETCH_ASSOC);
      $values['stand'] = $result['stand'];
    } catch (PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
    }
    printf('<div>Вход с логином %s, uid %d</div>', $_SESSION['login'], $_SESSION['uid']);
  }
  include('form.php');
}

else {
    $errors = FALSE;
   
    if (!preg_match('/^([a-zA-Z]|[а-яА-Я])/', $_POST['name'])) {
        setcookie('name_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('name_value', $_POST['name'], time() + 12 * 30 * 24 * 60 * 60);
    }

    
    if (!preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/', $_POST['email'])) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        setcookie('email_value', $_POST['email'], time() + 12 * 30 * 24 * 60 * 60);
    }


  $date = explode('-', $_POST['date']);
  $age = (int)date('Y') - (int)$date[0];
  if ($age > 100 || $age < 0) {
    setcookie('date_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('date_value', $_POST['date'], time() + 12 * 30 * 24 * 60 * 60);
  }

  
  if (empty($_POST['gender'])) {
    setcookie('gender_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('gender_value', $_POST['gender'], time() + 12 * 30 * 24 * 60 * 60);
  }

  
  if (empty($_POST['limbs'])) {
    setcookie('limbs_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('limbs_value', $_POST['limbs'], time() + 12 * 30 * 24 * 60 * 60);
  }

  
  if (empty($_POST['stand'])) {
    setcookie('stand_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('stand_value', implode(',', $_POST['stand']), time() + 12 * 30 * 24 * 60 * 60);
  }


  if (empty($_POST['bio'])) {
    setcookie('bio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('bio_value', $_POST['bio'], time() + 12 * 30 * 24 * 60 * 60);
  }

   
  if (empty($_POST['policy'])) {
    setcookie('policy_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    setcookie('policy_value', $_POST['policy'], time() + 12 * 30 * 24 * 60 * 60);
  }

  if ($errors) {
    
    header('Location: index.php');
    exit();
  } else {
    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('date_error', '', 100000);
    setcookie('gender_error', '', 100000);
    setcookie('limbs_error', '', 100000);
    setcookie('stand_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('policy_error', '', 100000);
  }

  $user = 'u47588';
  $pass = '9029914';
  $name = $_POST['name'];
  $email = $_POST['email'];
  $date = $_POST['date'];
  $gender = $_POST['gender'];
  $limbs = $_POST['limbs'];
  $bio = $_POST['bio'];
  $policy = $_POST['policy'];
  $stand = implode(',', $_POST['stand']);
  $member = $_SESSION['login'];

  $db = new PDO('mysql:host=localhost;dbname=u47588', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
  
  if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login'])) {
    try {
      $stmt = $db->prepare("UPDATE clients2 SET name = ?, email = ?, date = ?, gender = ?, limbs = ?, bio = ?, policy = ? WHERE login = ?");
      $stmt->execute(array($name, $email, $date, $gender, $limbs, $bio, $policy, $member));

      $superstand = $db->prepare("UPDATE powers2 SET stand = ? WHERE user_login = ? ");
      $superstand->execute(array($stand, $member));
    } catch (PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
    }
  } else {
    $login = uniqid();
    $password = uniqid();
    $hash = md5($password);
    
    setcookie('login', $login);
    setcookie('pass', $password);

    try {
      $stmt = $db->prepare("INSERT INTO clients2 SET login = ?, pass = ?, name = ?, email = ?, date = ?, gender = ?, limbs = ?, bio = ?, policy = ?");
      $stmt->execute(array($login, $hash, $name, $email, $date, $gender, $limbs, $bio, $policy));

      $superstand = $db->prepare("INSERT INTO powers2 SET stand = ?, user_login = ? ");
      $superstand->execute(array($stand, $login));
    } catch (PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
    }
  }
  setcookie('save', '1');
  header('Location: ./');
}
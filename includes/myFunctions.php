<?php
  // session_start();
  function uploadImage($filedName, $dirctoryPath, $old_value = null)
  {
    if(!empty($_FILES[$filedName]['tmp_name']))
    {
      $file = basename( $_FILES[$filedName]['name']);
      $path = $dirctoryPath . $file;


      if(move_uploaded_file($_FILES[$filedName]['tmp_name'], $path)) 
      {
        return $file;
      }
      else
      {
        return null;
      }
    }
    else
    {
      if(isset($old_value) && !empty($old_value))
      {
        return $old_value;
      }
      else
      {
        return null;
      }
    }
    return null;
  }


  function getRateColor($rate)
  {
    if(!isset($rate)) return "danger";
    if($rate > 75){
      return "success";
    }
    else if($rate > 50){
      return "primary";
    }
    else if($rate > 25){
      return "warning";
    }
    else{
      return "danger";
    }
  }

  function displayAvailableCount($available_copies_count)
  {
    if(!isset($available_copies_count)){
      return '<span class="badge bg-danger"> '. lang("Available"). $available_copies_count.' </span>';
    } 
    if($available_copies_count > 0){
      return '<span class="badge bg-success"> '. lang("Available"). $available_copies_count . ' </span>';
    }
    // else if($available_copies_count > 50){
    //   return "primary";
    // }
    // else if($available_copies_count > 25){
    //   return "warning";
    // }
    else{
      return '<span class="badge bg-danger"> '. lang("Available"). $available_copies_count.' </span>';
    }
  }

  function lang($word) {

    if( !isset($_SESSION['words']) || is_null($_SESSION['words'])) {
      if(isset($_SESSION['lang'])){
        changeLanguage($_SESSION['lang']);
      }
      else{
        $_SESSION['lang'] = 'en';
        changeLanguage($_SESSION['lang']);
      }
    }

    if(is_null($_SESSION['words'])) {
      lang($word);
    }
    // var_dump($_SESSION);
    // exit;
    $translations = $_SESSION['words'];
    return isset($translations[$word])? $translations[$word] : $word;
  }
  

  function changeLanguage($lang = 'en') 
  {
    try {
      //code...
      $_SESSION['lang'] = $lang ?? 'en';
      
      $lang = isset($_SESSION['lang'])? $_SESSION['lang'] : 'en';
      $_SESSION['words'] = json_decode(file_get_contents('lang/'.$lang.'.json'), true);
    } catch (\Throwable $th) {
      //throw $th;
      var_dump($th);
      exit();
    }
  }















  function redirectToReferer($error = null)
  {
    if(isset($error))
    {
      if(empty($_SESSION['fail']))
      {
        $_SESSION['fail'] = $error;
      }
      else{
        $_SESSION['fail'] .= $error;
      }
    }
     
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

  function redirectToRefererSuccess($message = null)
  {
    if(isset($message))
    {
      if(empty($_SESSION['success']))
      {
        $_SESSION['success'] = $message;
      }
      else{
        $_SESSION['success'] .= $message;
      }
    }
     
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

  ?>
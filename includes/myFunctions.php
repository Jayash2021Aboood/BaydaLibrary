<?php
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
      if(empty($_SESSION['fail']))
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
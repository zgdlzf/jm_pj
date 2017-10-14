<?php
    require_once("function.php");
    $key1=$_GET['key1'];
    $key2=$_GET['key2'];
    $key3=$_GET['key3'];
    $key4=$_GET['key4'];
    $mykey="nbjmxx28js83hdo9";
    $key5="72a895dee348ef3f9c0cefa0acdc694e";
    // $key5="a38624987618bc387dd9f982";
    $key=md5($key1.$key2.$key3.$key4.$mykey);
    $keyTime=getTime();
    if($key==$key5){
        $key4=getTime()-5;
        if(abs($keyTime-$key4)<=10){
            @session_start();
            $_SESSION['user']=$key1;
            redirect('assess.php');
        }else{
            echo "<script>alert('登陆时间过长！重新登陆。');</script>";
            redirect('index.php');
        }
        
    }else{
        redirect('index.php');
    }
?>
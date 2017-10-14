<?php
function add_evaluate(){
    $action=isset($_GET['act']) ? $_GET['act']:"";
    $as_title=isset($_POST['as_title'])?$_POST['as_title']:"";
    $xq=isset($_POST['xq'])?$_POST['xq']:"";
    $stage=isset($_POST['stage'])?$_POST['stage']:"";
    if(isset($_POST['as_item'])){
        $as_items=preg_split("/rn/",$_POST['as_item']);
    }
    $as_sum=count($as_items);
    $conn=conn();
    if($action=="add_evaluate"){
        $rs=mysqli_query($conn,"insert into wxapp_as_item (as_title,xq,stage,as_sum) values('".$as_title."','".$xq."','".$stage."','".$as_sum."')");
        $i=1; 
        $id=mysqli_insert_id($conn);
        foreach($as_items as $as_item){
            $asItem="as_item".$i;
            mysqli_query($conn,"update wxapp_as_item set $asItem='".$as_item."' where id='".$id."'");
            $i=$i+1;
            
        }
    }
}
function activate(){
    $action=isset($_GET['act']) ? $_GET['act']:"";
    $id=isset($_GET['id']) ? $_GET['id']:"";
    $conn=conn();
    if($action=="activate"){
        if(!empty($id)){
            $row=mysqli_fetch_array(mysqli_query($conn,"select * from wxapp_as_item where id='".$id."'"));
            if($row['as_state']=="激活"){
                echo("<script>alert('评价方案已激活');</script>");
            }else if($row['as_state']=="未激活"){
                mysqli_query($conn,"update wxapp_as_item set as_state='激活' where id='".$row['id']."'");
                // mysqli_query($conn,"update wxapp_as_item set as_state='未激活' where id not in (select * from wxapp_as_item where id='".$row['id']."')");
                mysqli_query($conn,"update wxapp_as_item set as_state='未激活' where id <>'".$row['id']."'");
            } 
        }else{
            echo("<script>alert('评价方案参数不能为空');</script>");
        }
    }
}
function del_assess(){
    $action=isset($_GET['act']) ? $_GET['act']:"";
    $id=isset($_GET['id']) ? $_GET['id']:"";
    $conn=conn();
    if($action=="del"){
        if(!empty($id)&&is_numeric($id)){
            mysqli_query($conn,"delete from wxapp_as_item where id='".$id."'");
            die("<script>alert('记录已删除');location.href='evaluate.php';</script>");
            mysqli_close($conn);
        }else{
            die("评价方案参数不能为空");
            exit();
        }
    }
}
function insert_assess($xk,$item){
    $action=isset($_GET['act']) ? $_GET['act']:"";
    $conn=conn();
    if($action=="login"){
        if($xk['k1']){
            $st1=mysqli_query($conn,"insert into wxapp_as_content (as_title,xq,kcid,kc,ykt,xm,bj,xb) values ('".$item['as_title']."','".$item['xq']."','".$xk['k1']."','".$xk['kc1']."','".$xk['ykt']."','".$xk['xm']."','".$xk['bj']."','".$xk['xb']."')");
            for($i=1;$i<=$item['as_sum'];$i++){
                $item_score="item_score".$i;
                $st11=mysqli_query($conn,"update wxapp_as_content set $item_score='".$_POST['k1'.$i]."' where ykt='".$xk['ykt']."' and kcid ='".$xk['k1']."'");
            }        
        }else{
            $st1=$st11=1;
        }
        if($xk['k2']){
            $st2=mysqli_query($conn,"insert into wxapp_as_content (as_title,xq,kcid,kc,ykt,xm,bj,xb) values ('".$item['as_title']."','".$item['xq']."','".$xk['k2']."','".$xk['kc2']."','".$xk['ykt']."','".$xk['xm']."','".$xk['bj']."','".$xk['xb']."')");
            for($i=1;$i<=$item['as_sum'];$i++){
                $item_score="item_score".$i;
                $st22=mysqli_query($conn,"update wxapp_as_content set $item_score='".$_POST['k2'.$i]."' where ykt='".$xk['ykt']."' and kcid ='".$xk['k2']."'");
            }
        }else{
            $st2=$st22=1;
        }
        if($xk['k4']){
            $st3=mysqli_query($conn,"insert into wxapp_as_content (as_title,xq,kcid,kc,ykt,xm,bj,xb) values ('".$item['as_title']."','".$item['xq']."','".$xk['k4']."','".$xk['kc4']."','".$xk['ykt']."','".$xk['xm']."','".$xk['bj']."','".$xk['xb']."')");
            for($i=1;$i<=$item['as_sum'];$i++){
                $item_score="item_score".$i;
                $st33=mysqli_query($conn,"update wxapp_as_content set $item_score='".$_POST['k4'.$i]."' where ykt='".$xk['ykt']."' and kcid ='".$xk['k4']."'");
            }
        }else{
            $st3=$st33=1;
        }
        if($st1&&$st11&&$st2&&$st22&&$st3&&$st33){
            redirect("feedback.php");
        }else{
            echo "<script>alert('评价异常');</script>";
        }
    }
}
function judge_session(){
    if(!$_SESSION['user']){
        redirect('main.php');
    }
}
function getTime(){
    return strtotime(date("Y-m-d H:i:s"));
}
function getWebName(){
    echo $name="宁波经贸学校选修课评教系统";
}
function redirect($url){
    echo "<script>location.href='".$url."';</script>";
}
function getSemester(){
    $term=date("Y");
    $semester=date("m");
    if($semester>=8 && $semester<=11){
        $num="第二学期 期初";
    }else if($semester>=12||$semester<=2){
        $num="第二学期 期末";
    }else if($semester>=3 && $semester<=5){
        $num="第一学期 期初";
    }else{
        $num="第一学期 期末";
    }
    echo $term."学年".$num;
}
function getSemesters(){
    $term=date("Y");
    for($i=0;$i<10;$i++){
        $semesters[$i][0]=$term-$i."学年第一学期";
        $semesters[$i][1]=$term-$i."学年第二学期";
    }
    return $semesters;
}
function conn(){
    $conn=mysqli_connect('localhost','root','','wxapp');
    if(!$conn){
        die("can not connect".$database."<br>".mysqli_connect_error($conn));
    }
    mysqli_set_charset($conn,'utf8');
    return $conn;
}
?>

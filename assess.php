<?php require_once("function.php");?>
<?php 
    session_start();
    judge_session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=0.5,minimum-scale=2,user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./jquery-3.2.1.min.js"></script>
</head> 
<body>
    
    <div class="main">
        <span class="main-name">
            <?php getWebName();?>
        </span>
        <span class="main-semester">当前学期：&nbsp;&nbsp;<?php getSemester();?></span>
        <?php 
            $conn=conn();
            $item=mysqli_fetch_array(mysqli_query($conn,"select * from wxapp_as_item where as_state='激活'"));
            $xk=mysqli_fetch_array(mysqli_query($conn,"select * from wxapp_xk where ykt='".$_SESSION['user']."' and xq='".$item['xq']."'"));                  
        ?>
        <form name="form1" action="?act=login" method="POST" onSubmit="return check()" class="margin-top">
            <!--周一选修课评价-->
            <?php  
                if($xk['k1']){
                    if(!mysqli_fetch_array(mysqli_query($conn,"select * from wxapp_as_content where ykt='".$xk['ykt']."' and kcid='".$xk['k1']."'"))){
                        $kc=mysqli_fetch_array(mysqli_query($conn,"select * from wxapp_kc where kcid='".$xk['k1']."' and xq='".$item['xq']."'"));
            ?>
                <div class="main-container margin-top">
                    <div class="course-info clear-float">
                        <div class="course title">课程名： <?php echo $kc['kc'];?></div>
                        <div class="course teacher">任课教师：<?php echo $kc['js'];?></div>
                    </div>
                    <div class="memo part">说明：&nbsp;<?php echo $kc['memo'];?></div>
                    <?php for($i=1;$i<=$item['as_sum'];$i++){ ?>
                    <div class="assess clear-float margin-top">
                        <div class="assess item1">项目：<?php echo $i?></div>
                        <div class="assess item2"><?php $s="as_item".$i;echo $item[$s]?></div>
                        <div class="assess item3">
                            <i class="star star1" score="1">★</i>
                            <i class="star star2" score="2">★</i>
                            <i class="star star3" score="3">★</i>
                            <i class="star star4" score="4">★</i>
                            <i class="star star5" score="5">★</i>
                            <input class="starIn" <?php echo "name=".'k1'.$i;?> type="text">
                        </div>
                    </div>
                 <?php  }?>
                </div>
            <?php   }else{$check_k1=1;}
                }?>
            <!--周二选修课评价-->
            <?php  
                if($xk['k2']){
                    if(!mysqli_fetch_array(mysqli_query($conn,"select * from wxapp_as_content where ykt='".$xk['ykt']."' and kcid='".$xk['k2']."'"))){
                        $kc=mysqli_fetch_array(mysqli_query($conn,"select * from wxapp_kc where kcid='".$xk['k2']."' and xq='".$item['xq']."'"));
            ?>
                <div class="main-container margin-top">
                    <div class="course-info clear-float">
                        <div class="course title">课程名： <?php echo $kc['kc'];?></div>
                        <div class="course teacher">任课教师：<?php echo $kc['js'];?></div>
                    </div>
                    <div class="memo part">说明：&nbsp;<?php echo $kc['memo'];?></div>
                    <?php for($i=1;$i<=$item['as_sum'];$i++){ ?>
                    <div class="assess clear-float margin-top">
                        <div class="assess item1">项目：<?php echo $i?></div>
                        <div class="assess item2"><?php $s="as_item".$i;echo $item[$s]?></div>
                        <div class="assess item3">
                            <i class="star star1" score="1">★</i>
                            <i class="star star2" score="2">★</i>
                            <i class="star star3" score="3">★</i>
                            <i class="star star4" score="4">★</i>
                            <i class="star star5" score="5">★</i>
                            <input class="starIn" <?php echo "name=".'k2'.$i;?> type="text">
                        </div>
                    </div>
                    <?php }?>
                </div>
            <?php   }else{$check_k2=1;}
                }
            ?>

            <!--周四选修课评价-->
            <?php  
                if($xk['k4']){
                    if(!mysqli_fetch_array(mysqli_query($conn,"select * from wxapp_as_content where ykt='".$xk['ykt']."' and kcid='".$xk['k4']."'"))){
                        $kc=mysqli_fetch_array(mysqli_query($conn,"select * from wxapp_kc where kcid='".$xk['k4']."' and xq='".$item['xq']."'"));
            ?>
                <div class="main-container margin-top">
                    <div class="course-info clear-float">
                        <div class="course title">课程名： <?php echo $kc['kc'];?></div>
                        <div class="course teacher">任课教师：<?php echo $kc['js'];?></div>
                    </div>
                    <div class="memo part">说明：&nbsp;<?php echo $kc['memo'];?></div>
                    <?php for($i=1;$i<=$item['as_sum'];$i++){ ?>
                    <div class="assess clear-float margin-top">
                        <div class="assess item1">项目：<?php echo $i?></div>
                        <div class="assess item2"><?php $s="as_item".$i;echo $item[$s]?></div>
                        <div class="assess item3">
                            <i class="star star1" score="1">★</i>
                            <i class="star star2" score="2">★</i>
                            <i class="star star3" score="3">★</i>
                            <i class="star star4" score="4">★</i>
                            <i class="star star5" score="5">★</i>
                            <input class="starIn" <?php echo "name=".'k4'.$i;?> type="text">
                        </div>
                    </div>
                    <?php }?>
                </div>
            <?php   }else{$check_k4=1;}
                }
            ?>
            <?php if(isset($check_k1)&&isset($check_k2)&&isset($check_k4)){
                    echo "<span style='width:100%;font-size:40px;color:#f77;text-align:center;display:inline-block'>已经进行过评价！无需重复评价。</span>";
            }else {?>
            
            <div class="gratulate margin-top">
                <span class="submit">
                    <input type="submit" value="完成评价">
                </span>
            </div>
            <?php }?>
        </form>      

    </div>
    <?php insert_assess($xk,$item);?>
    <script>
    function check(){
        <?php if($xk['k1']){
            for($i=1;$i<=$item['as_sum'];$i++){          
        ?>
            if(form1.<?php echo "k1".$i?>.value==""){
                alert("请完成所有评价内容后，再进行提交");
                form1.<?php echo "k1".$i?>.focus();
                return false;
            }
        <?php }}?>
        <?php if($xk['k2']){
            for($i=1;$i<=$item['as_sum'];$i++){          
        ?>
            if(form1.<?php echo "k2".$i?>.value==""){
                alert("请完成所有评价内容后，再进行提交");
                form1.<?php echo "k2".$i?>.focus();
                return false;
            }
        <?php }}?>
        <?php if($xk['k4']){
            for($i=1;$i<=$item['as_sum'];$i++){          
        ?>
            if(form1.<?php echo "k4".$i?>.value==""){
                alert("请完成所有评价内容后，再进行提交");
                form1.<?php echo "k4".$i?>.focus();
                return false;
            }
        <?php }}?>
        return true;
    }
    $(function(){
        /*
        * 鼠标点击，该元素包括该元素之前的元素获得样式,并给隐藏域input赋值
        * 鼠标移入，样式随鼠标移动
        * 鼠标移出，样式移除但被鼠标点击的该元素和之前的元素样式不变
        * 每次触发事件，移除所有样式，并重新获得样式
        * */
        var stars = $('.item3');
        var Len = stars.length;
        //遍历每个评分的容器
        for(i=0;i<Len;i++){
            //每次触发事件，清除该项父容器下所有子元素的样式所有样式
            function clearAll(obj){
                obj.parent().children('i').removeClass('on');
            }
            stars.eq(i).find('i').click(function(){
                var num = $(this).index();
                clearAll($(this));
                //当前包括前面的元素都加上样式
                $(this).addClass('on').prevAll('i').addClass('on');
                //给隐藏域input赋值
                $(this).siblings('input').val(num+1);
            });
            stars.eq(i).find('i').mouseover(function(){
                var num = $(this).index();
                clearAll($(this));
                //当前包括前面的元素都加上样式
                $(this).addClass('on').prevAll('i').addClass('on');
            });
            stars.eq(i).find('i').mouseout(function(){
                clearAll($(this));
                //触发点击事件后input有值
                var score = $(this).siblings('input').val();
                for(i=0;i<score;i++){
                    $(this).parent().find('i').eq(i).addClass('on');
                }
            });
        }
    })
</script>
    
</body>
</html>

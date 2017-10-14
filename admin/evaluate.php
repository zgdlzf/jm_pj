<?php require_once("../function.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<script>
    function del($url){
        if(confirm("确认删除！")){
        location.href=$url;
    }}
    function activate($value){
        if(confirm("确认激活！")){
            location.href=$value;
    }}
</script>
<?php 
    del_assess();
    activate();
?>
<?php 
    $conn=conn();
    $rs=mysqli_query($conn,"select * from wxapp_as_item order by id desc");
?>
    <div class="main">
        <div class="main_name">
            <?php getWebName();?>
        </div>
        <div class="add"><a href="./add_evaluate.php">+添加评价方案+</a></div>
        <table class="display" cellspacing="0" cellpdding="0">
            <tr>
                <td style="border-right:0;">ID</td><td style="border-right:0;">方案</td><td style="border-right:0;">学期</td><td>操作</td>
            </tr>
        <?php 
                $i=1;
                while($row=mysqli_fetch_array($rs)){ 
                    
        ?>
            <tr>
                <td style="border-top:0;border-right:0;"><?php echo $i;?></td>
                <td style="border-top:0;border-right:0;"><?php echo $row["as_title"];?></td>
                <td style="border-top:0;border-right:0;"><?php echo $row["xq"];?></td>
                <td style="border-top:0;">
                        <a href="javascript:void(0)" onClick="del('evaluate.php?act=del&id=<?php echo $row["id"];?>');">删除</a><br>
                        修改<br>
                <?php if($row["as_state"]=="未激活"){?>
                        <a href="javascript:void(0)" onClick="activate('evaluate.php?act=activate&id=<?php echo $row["id"];?>')">激活</a>
                <?php }?>
                </td>
            </tr>
        <?php   
                $i=$i+1;
        } ?>
        </table>
        <div class="bottom"></div>
    </div>
</body>
</html>
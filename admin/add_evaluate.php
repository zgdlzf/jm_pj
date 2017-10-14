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
    <div class="main margin-top">
        <div class="main_name"><?php getWebName();?></div>
        <form action="?act=add_evaluate" method="POST" onSubmit="return check();" enctype="multipart/form-data">
            <div class="select">
                <label for="as_title">评价方案：</label>
                <input type="text" name="as_title" id="as_title">
            </div>
            <div class="select">
            <label for="xq">评价学期：</label>
            <select name="xq" id="xq">
            <?php $semesters=getSemesters();
                for($i=0;$i<10;$i++){
                    for($j=0;$j<2;$j++){
            ?>
                <option value="<?php echo $semesters[$i][$j];?>"><?php echo $semesters[$i][$j];?></option>
            <?php }}?>
            </select>
            </div>
            <div class="select">
                <label for="stage">评价阶段：</label>
                <select name="stage" id="stage">
                    <option value="">期初</option>
                    <option value="">期终</option>
                </select>
            </div>
            <div class="area">
            <span>新增评价方案的项目内容，每一行代表一个评价项</span>
            <textarea name="as_item" id="as_item" cols="30" rows="10"></textarea>
            </div>
            <div class="select">
                <label for=""></label>
                <input type="submit" value="提交">
            </div>
        </form>
        <?php add_evaluate();?>
        <div class="select"></div>
    </div>
    <script>
        function check(){
            return true;
        }
    </script>
</body>
</html>
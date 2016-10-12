<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Акция</title>
    <meta name="title" content=""/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <!-- Удалить в HTML перед тем как отдавать -->
    <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
    <!-- -->
<body>
<div style="background: url(images/bg.png);">
   <div  style="width: 998px;margin: 20px auto;position: relative; font-family: Arial, Tahoma, sans-serif; background-color: #02a80a;">

       <!-- Удалить в HTML перед тем как отдавать -->
       <div style="position: relative; right: 32px; left: -32px;"><img src="images/header.png" alt="header"/></div>
       <!-- -->

       <div style="margin: 0 auto"><img src="images/banner.jpg" alt="banner"/></div>
       <div style="margin: 20px auto -3px"><img src="images/instruction.png" alt="instruction"/></div>
       <?php
       include('db_conn.php');
       $query = "SELECT * FROM tovari";
       $row = mysqli_query($dbase, $query);
       $i=0;
       while($result = mysqli_fetch_array($row, MYSQLI_ASSOC)) {
           $i++;
           echo '<div style="height: 466px;width: 331px;border-left: 1px solid #e5e5e5;float:left;border-bottom: 1px solid #e5e5e5;overflow: hidden;background: #ffffff;position: relative;text-align: center;">'."\r\n";
                echo '<div style="display: table; width: 100%; margin-top: 17px;">'."\r\n";
                    echo "<a href='${result['link']}' target='_blank'  title='${result['nam']}' style='margin:20px 0 0;height: 257px;text-align: center;display: table-cell; vertical-align: middle'>"."\r\n";
                         echo "<img style='border: none' src='${result['pic_link']}' alt='${result['nam']}'/></a>"."\r\n";
                echo '</div>'."\r\n";
                echo '<div style="padding: 15px 5px 0 18px;text-align: left;min-height:48px;">'."\r\n";
                    echo "<a href='${result['link']}' title='${result['nam']}' style='color: #3b86c5;font-size: 16px;line-height: 24px; text-decoration: none;height: 43px; display:block;' target=\"_blank\">${result['nam']}</a>"."\r\n";
                    echo '<div style="clear: both"></div>'."\r\n";
                echo '<div style="float: left; position: relative">'."\r\n";
                    echo '<div style="position: relative;margin: 1px 0 0;font: italic 20px/18px Impact;height: 35px;text-align: center;width: 73px;border-radius: 50% / 50%;background: #fff;top: 11px;left: 5px;box-shadow: 0 4px 4px -4px #A3A3A3;border-bottom: 1px solid #a3a3a3">'."\r\n";
                        echo "<span style='font-size: 20px;line-height: 38px;'>${result['price_old']},-</span>"."\r\n";
                            echo '<img src="images/old_price.png" alt="img" style="position: absolute; top:9px; left: 13px; z-index: 5"/>'."\r\n";
                    echo '</div>'."\r\n";
                echo '<div style="position: relative;margin: 5px 0 0;font: italic 30px/62px Impact;height: 72px;text-align: center;width: 150px; z-index: 10; border-radius: 50% / 50%;background: #ffe121;top: 0;left: 0;box-shadow: 0 4px 4px -4px #e1af00;border-bottom: 1px solid #e1af00;">'."\r\n";
                        echo "<span style='font-size: 40px;line-height: 72px;'>${result['price']},-</span>"."\r\n";
                echo '</div>'."\r\n";
                echo '</div>'."\r\n";
                echo '<div style="display: inline-block;float: left;padding: 16px 0 0 32px;text-align: right;">'."\r\n";
                echo '<div style="color:#f06421;font-size: 11px;line-height: 12px; text-align: left">Промокод для цього<br>товару:'."\r\n";
                    echo "<span style='position:relative; border: 1px dashed;display: block;font-size: 16px;font-weight: bold;margin-top: 4px;padding: 7px 6px 5px;text-align: center;width: 103px;'>${result['code']}</span>"."\r\n";
                 echo '</div>'."\r\n";
                    echo "<a href='${result['link']}' title='${result['nam']}' target='_blank' style='padding: 0;line-height: 32px;height: 32px;position: absolute;right: 14px;bottom: 25px;display: inline-block;border: 0;background: #f06421;color: #FFF;font-size: 13px;border-bottom: 1px solid #c9490c;'><img src=\"images/btn.png\" alt=\"button\"/></a>"."\r\n";
                echo '</div>'."\r\n";
                echo '</div>'."\r\n";
           echo '</div>'."\r\n";
           $ii = 3 - ($i%3);
       }
       if($ii==3){
//           die;
       }
       else {
           while ($ii) {
               $ii--;
               echo '<div style="height: 466px;width: 331px;border-left: 1px solid #e5e5e5;float:left;border-bottom: 1px solid #e5e5e5;overflow: hidden;background: #ffffff;position: relative;text-align: center;">'."\r\n";
               echo '<div style="display: table; width: 100%; margin-top: 17px;">'."\r\n";
               echo '</div>'."\r\n";
               echo '</div>'."\r\n";
           }
       }

       mysqli_free_result($row);

       mysqli_close($dbase);
       ?>        <div style="clear: both"></div>       

       <!-- Удалить в HTML перед тем как отдавать -->
       <div style="position: initial;margin-top: 20px"><img src="images/footer.png" alt="footer"/></div>
       <!-- -->

    </div>

    <!-- Удалить в HTML перед тем как отдавать -->
    <form action="save_html.php" method="post" class="form2">
        <input type="submit" name="pc" value="Сохранить HTML для PC" class="add"/>
        <input type="submit" name="mob" value="Сохранить HTML для mob" class="add"/>
    </form>
    <!-- -->

</div>
</body>
</html>
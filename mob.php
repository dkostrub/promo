<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Акция</title>
    <meta name="title" content=""/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
</head>
<body>
<div style="background: url(images/bg.png)">
    <div  style="width: 640px;margin: 30px auto;position: relative; font-family: Arial, Tahoma, sans-serif;">
        <div style="margin: 0 auto"><img style="width:640px;" src="images/banner.jpg" alt="banner"/></div>
        <div style="display: block; background: #fff29a;padding: 15px; margin: 15px 0 2px">
            <p style="color: #f06522;font-size: 30px;font-weight: bold;margin: 0;">Як використати промо код?</p>
            <ul style="color: #02a709;font-size: 20px;font-weight: bold;list-style-type: decimal;">
                <li>Cкопіюйте промокод під обраним товаром</li>
                <li>Перейдіть на картку товару, натиснувши «Детальніше»</li>
                <li>Додайте обраний товар у корзину</li>
                <li>Введіть промокод на знижку при оформленні замовлення</li>
            </ul>
        </div>
        <?php
        include('db_conn.php');
        $query = "SELECT * FROM tovari";
        $row = mysqli_query($dbase, $query);
        while($result = mysqli_fetch_array($row, MYSQLI_ASSOC)) {
            echo '<div  style="height: 466px;width: 640px;border-left: 1px solid #e5e5e5;border-bottom: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;float: left;overflow: hidden;background: #ffffff;position: relative;text-align: center;">'."\r\n";
                echo '<div style="display: table; width: 100%; margin-top: 17px;">'."\r\n";
                    echo "<a href='${result['link']}' target='_blank'  title='${result['nam']}' style='margin: 20px 0 0;height: 257px;text-align: center;display: table-cell; vertical-align: middle'>"."\r\n";
                        echo "<img style='border: none; height: 100%' src='${result['pic_link']}' alt='${result['nam']}'/></a>"."\r\n";
                echo '</div>'."\r\n";
                echo '<div style="padding: 15px 5px 0 18px;text-align: left;min-height:48px;">'."\r\n";
                    echo "<a href='${result['link']}' title='${result['nam']}' style='text-align: center;color: #3b86c5;font-size: 26px;line-height: 24px; text-decoration: none;height: 43px; display:block;' target=\"_blank\">${result['nam']}</a>"."\r\n";
                    echo '<div style="clear: both">'."\r\n";
                    echo '</div>'."\r\n";
                echo '<div style="float: left; position: relative">'."\r\n";
                    echo '<div style="position: relative;margin: 1px 0 0;font: italic 20px/18px Impact;height: 35px;text-align: center;width: 73px;border-radius: 50% / 50%;background: #fff;top: 11px;left: 5px;box-shadow: 0 4px 4px -4px #A3A3A3;border-bottom: 1px solid #a3a3a3">'."\r\n";
                        echo "<span style='font-size: 20px;line-height: 38px;'>${result['price_old']},-</span>"."\r\n";
                            echo '<img src="images/old_price.png" alt="img" style="position: absolute; top:9px; left: 13px; z-index: 5"/>'."\r\n";
                    echo '</div>'."\r\n";
                    echo '<div style="position: relative;margin: 5px 0 0;font: italic 30px/62px Impact;height: 72px;text-align: center;width: 150px; z-index: 10; border-radius: 50% / 50%;background: #ffe121;top: 0;left: 0;box-shadow: 0 4px 4px -4px #e1af00;border-bottom: 1px solid #e1af00;">'."\r\n";
                        echo "<span style='font-size: 40px;line-height: 72px;'>${result['price']},-</span>"."\r\n";
                    echo '</div>'."\r\n";
                echo '</div>'."\r\n";
                echo '<div style="display: inline-block;float: left;padding: 16px 0 0 50px;text-align: right;">'."\r\n";
                    echo '<div style="color:#f06421;font-size: 18px;line-height: 20px;margin-top: 25px; text-align: left">Промокод для цього<br>товару:'."\r\n";
                        echo "<span style='font-size: 27px; font-weight: bold; display: block; margin-top: 10px;'>${result['code']}</span>"."\r\n";
                    echo '</div>'."\r\n";
                        echo "<a href='${result['link']}' title='${result['nam']}' target='_blank' style='padding: 0;line-height: 32px;height: 60px;width: 200px;position: absolute;right: 14px;bottom: 21px;display: inline-block;border: 0;background: #f06421;color: #FFF;font-size: 13px;border-bottom: 3px solid #c9490c;'><img src=\"images/btn_big.png\" alt=\"button\"/></a>"."\r\n";
                echo '</div>'."\r\n";
                echo '</div>'."\r\n";
            echo '</div>'."\r\n";
        }
        ?>
        <div style="clear: both"></div>
    </div>
</div>

</body>
</html>
<?php
require "inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Спецпропозицii вiд Comfy!</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        .link_underline{text-decoration: none !important;}
        .link{text-decoration: underline !important;}
        .link_underline:hover{text-decoration: underline !important;}
        .link:hover{text-decoration: none !important}
    </style>

    <!-- Удалить в HTML перед тем как отдавать -->
    <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
    <!-- -->

</head>
<body bgcolor="#ffffff" style="margin: 0 auto; padding: 10px 0">
<table border="0" cellspacing="0" cellpadding="0" style="width:558px; font-family: Arial,sans-serif; background-color: #ffffff;" align="center">
    <tr>
        <td style="font-size:0;line-height: 0;vertical-align: top;">

            <table border="0" cellspacing="0" cellpadding="0" width="558" style="width: 558px;">
                <tr><td style="font-size:0;line-height: 0;vertical-align: top; min-height:23px;"><div style="font-size:0;line-height: 0;min-height:23px">&nbsp;</div><!-- indent --></td></tr>
                <tr>
                    <td style="font-size:0;line-height:0;vertical-align: top;min-height:60px;background-color: #f06421;text-align: center">
                        <a style="outline: none; border: none;display: block;background-color: #f06421;color:#ffffff;" target="_blank" href="http://comfy.ua/promo?utm_source=gsp&utm_medium=cpc&utm_content=button-promokod&utm_campaign=promocod_01">
                            <img width="560" border="0" height="155" alt="Всі пропозиції comfy.ua" src="images/gdn/all_items_btn.png" style="color:#ffffff;font-size: 14px;line-height: 14px;background-color: #f06421">
                        </a>
                    </td>
                </tr>
                <tr><td style="font-size:0;line-height: 0;vertical-align: top; min-height:3px;"><div style="font-size:0;line-height: 0;min-height:3px">&nbsp;</div><!-- indent --></td></tr>
                <tr>
                    <td style="font-size:0;line-height:0;vertical-align: top;min-height:60px;background-color: #f06421;text-align: center">
                        <img width="560" border="0" height="100" alt="Всі пропозиції comfy.ua" src="images/gdn/second_img.png" style="color:#ffffff;font-size: 14px;line-height: 14px;background-color: #f06421">
                    </td>
                </tr>
                <tr><td style="font-size:0;line-height: 0;vertical-align: top; min-height:31px;"><div style="font-size:0;line-height: 0;min-height:31px">&nbsp;</div><!-- indent --></td></tr>
                <tr>
                    <td style="font-size:0;line-height:0;vertical-align: top;">
                        <table width="560" cellspacing="0" cellpadding="0" border="0" style="width: 560px">
                            <tbody>

                            <?php
                            echo "<tr><td style='font-size:0;line-height:0;vertical-align: top;'>";
                            $query = "SELECT * FROM goods";
                            $row = mysqli_query($dbase, $query);

                            if ($row !== false) {

                                $i = 0;
                                while($result = mysqli_fetch_assoc($row)) {
                                    echo '<table width="186" cellspacing="0" cellpadding="0" border="0" style="width: 186px">'."\r\n";
                                        echo "<tbody>"."\r\n";
                                        echo "<tr>"."\r\n";
                                            echo '<td height="260" style="font-size:0;line-height: 0;vertical-align: top; text-align: center">'."\r\n";
                                                echo "<a target='_blank' style='outline:none;border:none;' title='${result['nam']}' href='${result['link']}'>"."\r\n";
                                                    echo "<img width='170' height='260' alt='Увімкніть відображення зображень' src='${result['pic_link']}' style='border: none;outline: none; font-size: 12px;line-height: 14px; color: green;'></a>"."\r\n";
                                            echo "</td>"."\r\n";
                                        echo '</tr>'."\r\n";
                                        echo '<tr><td style="font-size:0;line-height: 0;vertical-align: top; min-height:7px;"><div style="font-size:0;line-height: 0;min-height:7px">&nbsp;</div><!-- indent --></td></tr>'."\r\n";
                                        echo "<tr>"."\r\n";
                                            echo "<td>"."\r\n";
                                                echo '<table width="186" cellspacing="0" cellpadding="0" border="0" style="width: 186px">'."\r\n";
                                                    echo "<tbody>"."\r\n";
                                                    echo "<tr>"."\r\n";
                                                        echo '<td style="line-height:25px; ;vertical-align: top; text-align: center; width: 7px">'."\r\n";
                                                        echo "</td>"."\r\n";
                                                        echo '<td style="font-size:13px; line-height:25px; ;vertical-align: top; text-align: center; border:1px dashed #f06421">'."\r\n";
                                                            echo "<span style='font-weight: bold; color: #f06421'>${result['code']}</span>"."\r\n";
                                                        echo "</td>"."\r\n";
                                                        echo '<td style="line-height:25px; ;vertical-align: top; text-align: center; width: 7px">'."\r\n";
                                                        echo "</td>"."\r\n";
                                                    echo "</tr>"."\r\n";
                                                    echo "</tbody>"."\r\n";
                                                echo "</table>"."\r\n";
                                            echo "</td>"."\r\n";
                                        echo "</tr>"."\r\n";
                                        echo '<tr><td style="font-size:0;line-height: 0;vertical-align: top; min-height:4px;"><div style="font-size:0;line-height: 0;min-height:4px">&nbsp;</div><!-- indent --></td></tr>'."\r\n";
                                        echo "<tr>"."\r\n";
                                            echo '<td style="font-size:0;line-height: 0;vertical-align: top;">'."\r\n";
                                                echo '<div style=" font-size:13px; line-height: 16px; text-align: center; ">'."\r\n";
                                                    echo "<a target='_blank' class='link_underline' style='outline:none;border:none;color:#2e7ec2;text-decoration: none;' title='${result['nam']}' href='${result['link']}'>${result['nam']}</a>"."\r\n";
                                                echo "</div>"."\r\n";
                                            echo "</td>"."\r\n";
                                        echo "</tr>"."\r\n";
                                        echo '<tr><td style="font-size:0;line-height: 0;vertical-align: top; min-height:7px;"><div style="font-size:0;line-height: 0;min-height:7px">&nbsp;</div><!-- indent --></td></tr>'."\r\n";
                                        echo "<tr>"."\r\n";
                                            echo '<td height="38" style="font-size:0;line-height: 0;vertical-align: top; text-align: center;">'."\r\n";
                                                echo "<a target='_blank' style='outline:none;border:none;color: #ffffff;' href='${result['link']}'>"."\r\n";
                                                    echo "<img width='115' height='38' alt='Детальніше' src='images/gdn/more_btn.png' style='line-height:20px;color:#ffffff;background-color: #f16321;font-size:14px;border: none; outline: none; margin: 0;'></a>"."\r\n";
                                            echo "</td>"."\r\n";
                                        echo "</tr>"."\r\n";
                                        echo '<tr><td style="font-size:0;line-height: 0;vertical-align: top; min-height:36px;"><div style="font-size:0;line-height: 0;min-height:36px">&nbsp;</div><!-- indent --></td></tr>';
                                        echo "</tbody>"."\r\n";
                                    echo "</table>"."\r\n";

                                    $i++;
                                    if ( $i%3 == 0 ) {
                                        // новая строка в таблице
                                        echo "</td></tr><tr><td>";
                                    }
                                    else {
                                        // следующая колонка
                                        echo "</td><td>";
                                    }
                                }
                            }
                            echo "</td></tr>";

                            mysqli_free_result($row);

                            mysqli_close($dbase);

                            ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:0;line-height:0;vertical-align: top;min-height:60px;background-color: #f06421;text-align: center">
                        <a style="outline: none; border: none;display: block;background-color: #f06421;color:#ffffff;" target="_blank" href="http://comfy.ua/promo?utm_source=gsp&utm_medium=cpc&utm_content=button-promokod&utm_campaign=promocod_01">
                            <img width="558" border="0" height="64" alt="Всі пропозиції comfy.ua" src="images/gdn/show_all.png" style="color:#ffffff;font-size: 14px;line-height: 14px;background-color: #f06421">
                        </a>
                    </td>
                </tr>
                <tr><td style="font-size:0;line-height: 0;vertical-align: top; min-height:5px;"><div style="font-size:0;line-height: 0;min-height:5px">&nbsp;</div><!-- indent --></td></tr>
            </table>
        </td>
    </tr>
</table>

<!-- Удалить в HTML перед тем как отдавать -->
<hr>
<form action="save_html.php" method="post" class="form2">
    <input type="submit" name="pc_gdn" value="Сохранить HTML" class="add"/>
</form>
<!-- -->

</body>
</html>
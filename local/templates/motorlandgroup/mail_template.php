<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <style type="text/css">

    * {
      margin: 0;
      padding: 0;
      font-size: 100%;
      font-family: Arial, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
      line-height: 1.65; }
    
    a {
      color: #71bc37;
      text-decoration: none; }
    
    .text-center {
      text-align: center; }

    .text-right {
      text-align: right; }
    
    .text-left {
      text-align: left; }
    
    .button {
      display: inline-block;
      color: white;
      background: #df5700;
      border: solid #df5700;
      border-width: 10px 20px 8px;
      font-weight: bold;
      border-radius: 4px; }
    
    h1, h2, h3, h4, h5, h6 {
      margin-bottom: 20px;
      line-height: 1.25; }
    
    h1 {
      font-size: 32px; }
    
    h2 {
      font-size: 28px; }
    
    h3 {
      font-size: 24px; }
    
    h4 {
      font-size: 20px; }
    
    h5 {
      font-size: 16px; }
    
    p, ul, ol {
      font-size: 16px;
      font-weight: normal;
      margin-bottom: 20px; }
    
    .container {
      display: block !important;
      clear: both !important;
      margin: 0 auto !important;
      max-width: 588px !important;
      }
      .container table {
        width: 100% !important;
        border-collapse: collapse; 
        }
      .container .masthead {
        padding: 20px 0;
        background: #3b3536;
        color: white; 
        }
        .container .masthead h1 {
          margin: 0 auto !important;
          max-width: 90%;
          text-transform: uppercase; 
          }
      .container .content {
        background: white;
        padding: 30px 35px; 
        }
        .container .content.footer {
          background: none; 
          }
          .container .content.footer p {
            margin-bottom: 0;
            color: #888;
            text-align: center;
            font-size: 14px; 
            }
          .container .content.footer a {
            color: #df5700;
            text-decoration: none;
            font-weight: bold; }


    </style>
</head>
<body style="width: 100% !important;height: 100%; background: #fff; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; margin: 0;
      padding: 0;
      font-size: 100%;
      font-family: Arial, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      line-height: 1.65;">
<table style="width: 100% !important;height: 100%;background: #fff;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none; ">
    <tr>
        <td style="display: block !important;
      clear: both !important;
      margin: 0 auto !important;
      max-width: 588px !important; width: 100%;">

            <!-- Message start -->
            <table style=" width: 100%;">
                <tr>
                    <td align="center" style="padding: 20px 0;background: #fff;color: white; ">

                        <img src="https://volvocarbelgorod.ru/upload/logo-mail.jpeg" style="max-width: 100%;margin: 0 auto;display: block;" />

                    </td>
                </tr>
                <tr>
                    <td style="background: white;padding: 30px 35px;border: 1px #1f1f1f solid;">

                        <h2><? echo $mail_title; ?></h2>
                        
                        <p style="color:#989898;font-size: 13px;"><?=$datetime;?></p>
                        
                        <table style="width: 100%; font-size: 13px;">

							<? if($pname): ?>
                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Запись к специалисту:</strong> <?=$pname;?></td>
                            </tr>
							<? endif; ?>

                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Имя:</strong> <?=$name;?></td>
                            </tr>

							<? if($soname): ?>
                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Фамилия:</strong> <?=$soname;?></td>
                            </tr>
							<? endif; ?>

                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Номер телефона:</strong> <?=$phone?> </td>
                            </tr>

							<? if($mail): ?>
                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Email:</strong> <?=$mail;?></td>
                            </tr>
							<? endif; ?>

							<? if($pdate): ?>
                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Желаемое время:</strong> <?=$pdate;?></td>
                            </tr>
							<? endif; ?>

							<? if($theme): ?>
                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Тема сообщения:</strong> <?=$theme;?></td>
                            </tr>
							<? endif; ?>

							<? if($masege): ?>
                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Сообщение:</strong><br> <?=$masege;?></td>
                            </tr>
							<? endif; ?>
							
							

							<? if($model): ?>
                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Интересующая модель:</strong> <?=$model?> </td>
                            </tr>
							<? endif; ?>
							<? if($pay): ?>
                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Первоначальный взнос:</strong> <?=$pay?> </td>
                            </tr>
							<? endif; ?>
							<? if($tradIn): ?>
                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Автомобиль для сдачи по программе Trade-in:</strong> <?=$tradIn?> </td>
                            </tr>
							<? endif; ?>
							<? if($time): ?>
                            <tr style="vertical-align: top;">
                                <td style="width: 100%;padding: 5px 0;" colspan="2"><strong>Срок кредита:</strong> <?=$time?> </td>
                            </tr>
							<? endif; ?>
                        </table>

                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td style="display: block !important;
      clear: both !important;
      margin: 0 auto !important;
      max-width: 588px !important;">

            <!-- Message start -->
            <table style="width: 100% !important;height: 100%;background: #fff;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none; ">
                <tr>
                    <td style="padding: 30px 35px; " align="center">
                        <p style="margin-bottom: 0;
            color: #888;
            text-align: center;
            font-size: 12px; ">Создание сайта <a href="http://promo01.ru" style="color: #0051CA;
            text-decoration: none;
            font-weight: bold;display:block;width:100%;text-align:center;">ООО &laquo;Генерация&raquo;</a></p>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>
</html>
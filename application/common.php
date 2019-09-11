<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

/*
 * |date='Y-m-d H:i:s',###}
 */
// 应用公共文件
use PHPMailer\PHPMailer\PHPMailer;

/*
 * pic_suo($data['pic'],false,270,150);
 * @unlink(pic_suo($oldpicurl,true));
 * {$vo.pic|pic_suo=###,true}
 */
function pic_suo($url,$getname=false,$width=200,$height=150){
    if($getname){
        $name=basename($url);
        $smname="mb_".$name;
        $smurl=str_replace($name,$smname,$url);
        return $smurl;
    }else{
        $img=\think\Image::open(".".$url);
        $name=basename($url);
        $smname="mb_".$name;
        $smurl=str_replace($name,$smname,$url);
        $img->thumb($width,$height)->save(".".$smurl);
        return $smurl;
    }
}

function to_404(){
    header('HTTP/1.1 404 Not Found');
    header("status: 404 Not Found");
    $url=ROOT_PATH .'dispatch_404.tpl';
    echo(file_get_contents($url));
    exit;
}

/**
 * 计算几分钟前、几小时前、几天前、几月前、几年前。
 * $agoTime string Unix时间
 * @author tangxinzhuan
 * @version 2016-10-28
 */
function time_ago($agoTime)
{
    $agoTime = (int)$agoTime;

    // 计算出当前日期时间到之前的日期时间的毫秒数，以便进行下一步的计算
    $time = time() - $agoTime;

    if ($time >= 31104000) { // N年前
        $num = (int)($time / 31104000);
        return $num.'年前';
    }
    if ($time >= 2592000) { // N月前
        $num = (int)($time / 2592000);
        return $num.'月前';
    }
    if ($time >= 86400) { // N天前
        $num = (int)($time / 86400);
        return $num.'天前';
    }
    if ($time >= 3600) { // N小时前
        $num = (int)($time / 3600);
        return $num.'小时前';
    }
    if ($time > 60) { // N分钟前
        $num = (int)($time / 60);
        return $num.'分钟前';
    }
    return '1分钟前';
}

/**
 * 发送邮件
 * @param string $address 收件人邮箱
 * @param string $subject 邮件标题
 * @param string $message 邮件内容
 * @return array<br>
 * 返回格式：<br>
 * array(<br>
 *    "error"=>0|1,//0代表出错<br>
 *    "message"=> "出错信息"<br>
 * );
 * send_email("sdfsdf@qq.com","title","body");
 */
function send_email($address, $subject, $message)
{
    $mail        = new PHPMailer();
    // 设置PHPMailer使用SMTP服务器发送Email
    $mail->IsSMTP();
    $mail->IsHTML(true);
    //$mail->SMTPDebug = 3;
    // 设置邮件的字符编码，若不指定，则为'UTF-8'
    $mail->CharSet = 'UTF-8';
    // 添加收件人地址，可以多次使用来添加多个收件人
    $mail->AddAddress($address);
    // 设置邮件正文
    $mail->Body = $message;
    // 设置邮件头的From字段。
    $mail->From = config('mail.address');
    // 设置发件人名字
    $mail->FromName = "瑞立诺";
    // 设置邮件标题
    $mail->Subject = $subject;
    // 设置SMTP服务器。
    $mail->Host = config('mail.smtp');
    //by Rainfer
    // 设置SMTP服务器端口。
    $mail->Port =config('mail.port');
    // 设置为"需要验证"
    $mail->SMTPAuth    = true;
    $mail->SMTPAutoTLS = false;
    $mail->Timeout     = 10;
    // 设置用户名和密码。
    $mail->Username = config('mail.username');
    $mail->Password = config('mail.password');

    // 发送邮件。
    if (!$mail->Send()) {
        return $mail->ErrorInfo;
    } else {
        return true;
    }
}


function remove_html($str) {
$okstr = preg_replace( "/<([^p].*?)>/",'',$str);
$okstr = preg_replace( "/<(.*?)>/",'',$okstr);
return $okstr;
}
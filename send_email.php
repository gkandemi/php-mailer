<?php

session_start();
error_reporting(E_ERROR);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

if(isset($_POST)){


    if($_POST["to_email"] && $_POST["sender"] && $_POST["subject"] && $_POST["message"]){

        // Mail Gönderme İşlemini Gerçekleştir...

        $file = $_FILES["attachment"];


        if(move_uploaded_file($file["tmp_name"], "files/" . $file["name"])){

            $mail = new PHPMailer(true);

            try{

                // Server Ayarları
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = "ssl://smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = ""; // Mail adresinizi yazın.. test@gmail.com
                $mail->Password = ""; // Mail adresinizin Şifresi sifre123!
                $mail->CharSet = "utf8";
                $mail->SMTPSecure = "tls";
                $mail->Port = 465;

                // Alıcı Ayarları
                $mail->setFrom("", $_POST["sender"]); // nereden gidecegini berliteceginiz mail adresi... test@gmail.com
                $mail->addAddress($_POST["to_email"], "");
                $mail->addAttachment("files/" .$file["name"]);
//            $mail->addBCC("","");
//            $mail->addCC("","");

                // Gonderi Ayarları
                $mail->isHTML();
                $mail->Subject = $_POST["subject"];
                $mail->Body = $_POST["message"];

                if($mail->send()){

                    $alert = array(
                        "message"   => "Mail başarılı bir şekilde gönderilmiştir.",
                        "type"      => "success"
                    );

                } else {

                    $alert = array(
                        "message"   => "Mail gönderirken bir hata oluştu.",
                        "type"      => "danger"
                    );

                }

            } catch (Exception $e){

                $alert = array(
                    "message"   => $e->getMessage(),
                    "type"      => "danger"
                );

            }

        } else {

            $alert = array(
                "message"   => "Dosya yüklenirken bir hata oluştu!",
                "type"      => "danger"
            );


        }

    } else {


        $alert = array(
            "message"   => "Lütfen tüm alanları doldurunuz!",
            "type"      => "danger"
        );

    }

    $_SESSION["alert"] = $alert;

    header("location:index.php");

}

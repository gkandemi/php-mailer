<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Kullanarak Mail Gönderme İşlemi</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h3 class="text-center mt-5 mb-5">PHP ile Mail Göndermek</h3>
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php if(isset($_SESSION["alert"])){; ?>

                <div class="alert alert-<?php echo $_SESSION["alert"]["type"]; ?>">
                    <?php echo $_SESSION["alert"]["message"]; ?>
                </div>

                <?php unset($_SESSION["alert"]); ?>

            <?php } ?>


            <form action="send_email.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Gönderilecek Adres</label>
                    <input class="form-control" type="email" name="to_email">
                </div>
                <div class="form-group">
                    <label>Gönderenin Adı</label>
                    <input class="form-control" type="text" required name="sender">
                </div>
                <div class="form-group">
                    <label>Konu</label>
                    <input class="form-control" type="text" required name="subject">
                </div>
                <div class="form-group">
                    <label>Mesaj</label>
                    <textarea name="message" cols="30" rows="10" required class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Dosya Eki</label>
                    <input type="file" name="attachment" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Gönder</button>
                <button type="reset" class="btn btn-danger">Temizle</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
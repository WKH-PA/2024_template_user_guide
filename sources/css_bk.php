<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="css/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="images/fancybox/jquery.fancybox.css"/>
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.caroufredsel.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/jquery.idtabs.min.js"></script>
    <script type="text/javascript" src="js/jquery.mmenu.all.js"></script>
    <script type="text/javascript" src="js/script218.js"></script>
    <script type="text/javascript" src="images/fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/owl.carousel.js"></script>
</head>
<script>
    $(document).ready(function(){
        // hide #back-top first
        $("#back-top").hide();

        // fade in #back-top
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('#back-top').fadeIn();
                } else {
                    $('#back-top').fadeOut();
                }
            });

            // scroll body to 0px on click
            $('#back-top a').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });

    });
</script>
<body>
<?php include"header.php";?>
<div class="conten">
    <?php
    if (isset($_GET["page"]))
    {
        $page=$_GET["page"];
        $page.=".php";
        if($page=="index.php")
            $page="trangchu.php";
        $page = str_replace("http","XXX",$page);
        $page = str_replace("https","XXX",$page);
        $page = str_replace("ftp","XXX",$page);
        $page = str_replace("ftps","XXX",$page);
        if (is_file($page))
            include $page;
        else echo "<div class='no_data'></div> <div class='pagewrap page_conten_page'>Under Contruction</div>";
    }
    else
        include "trangchu.php";
    ?>
    <div class="clr"></div>
</div>
<?php include"footer.php";?>
</body>
</html>
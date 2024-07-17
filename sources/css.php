<link href="css/flaticon.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">



<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.caroufredsel.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/jquery.idtabs.min.js"></script>
<script type="text/javascript" src="js/script218.js"></script>
<script type="text/javascript" src="images/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/jquery.mmenu.all.js"></script>

<script>
    $(document).ready(function () {
        // Kiểm tra điều kiện và hiển thị icon tương ứng
        if (<?= $thongtin['show_fb'] ?> == 1) {
            $("#fb-messenger-icon").show();
        }

        if (<?= $thongtin['show_zalo'] ?> == 1) {
            $("#zalo-icon").show();
        }

        // Tính toán lại khoảng cách bottom dựa trên số lượng icon được hiển thị
            adjustIconPosition();

        // Fade in #back-top khi cuộn lên trên
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
            adjustIconPosition(); // Adjust position on scroll to account for back-top visibility
        });

        // Cuộn body lên đầu trang khi click vào #back-top
        $('#back-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

    // Hàm để tính toán lại khoảng cách bottom của từng icon
    function adjustIconPosition() {
        var icons = [];
        var bottomOffset = 30; // Khoảng cách mặc định từ bottom
        var visibleIconsCount = 0;
        if ($('#fb-messenger-icon').is(":visible")) {
            icons.push('#fb-messenger-icon');
        }
        if ($('#zalo-icon').is(":visible")) {
            icons.push('#zalo-icon');
        }
        // Kiểm tra nếu #back-top không hiển thị, chỉ tính hai icon khác
        if ($(window).scrollTop() > 100 && $('#back-top').is(":visible")) {
            icons.push('#back-top'); // Thêm #back-top vào danh sách icon
        }

        // Đếm số lượng icon đang hiển thị
        for (var i = 0; i < icons.length; i++) {
            if ($(icons[i]).is(":visible")) {
                visibleIconsCount++;
            }
        }

        // Điều chỉnh khoảng cách bottom cho mỗi icon
        for (var i = 0; i < icons.length; i++) {
            if ($(icons[i]).is(":visible")) {
                $(icons[i]).css('bottom', bottomOffset + (visibleIconsCount - 1 - i) * 60 + 'px');
            }
        }
    }

</script>


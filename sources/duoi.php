<div class="clr"></div>
    <?php include _source."footer.php";?>
</div>
</article></section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.js"></script>
<script type="text/javascript" src="js/jquery.lazyload.min.js"></script>
<script type="text/javascript" language="javascript" src="js/me.js?v=<?=time() ?>"></script>
<script src='menu_mb/jquery.mmenu.min.js' type='text/javascript'></script>
<!-- Include mmenu CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/8.5.22/mmenu.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/8.5.22/mmenu.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo plugin mmenu
        var $navMobile = $("#nav-mobile");
        $navMobile.mmenu({
            // Tùy chọn cấu hình của mmenu (nếu cần)
        });

        // Lưu trữ tham chiếu đến API của mmenu
        var api = $navMobile.data("mmenu");

        // Kiểm tra xem api đã được khởi tạo đúng cách chưa
        if (api) {
            // Thêm sự kiện click vào phần tử đầu tiên tìm thấy với selector '.menu-bar a'
            document.querySelector('.menu-bar a').addEventListener('click', function(event) {
                event.preventDefault();
                // Kiểm tra trạng thái của mmenu và mở hoặc đóng menu tương ứng
                if (api.opened) {
                    api.close();
                } else {
                    api.open();
                }
            });

            // Đăng ký sự kiện mở menu của mmenu để đặt display thành 'block'
            api.bind("open:finish", function() {
                document.getElementById('nav-mobile').style.display = 'block';
            });

            // Đăng ký sự kiện đóng menu của mmenu để đặt display thành 'none'
            api.bind("close:finish", function() {
                document.getElementById('nav-mobile').style.display = 'none';
            });
        } else {
            console.error("mmenu API không thể khởi tạo.");
        }
    });


</script>


<?php if(!empty($slug_step)){ ?>
    <script>$(".active_mn_<?=$slug_step ?>").addClass("acti")</script>
<?php }else{ ?>
    <script>$(".active_mn_01").addClass("acti")</script>
<?php } ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchIcon = document.querySelector('.search-icon');
        const searchOverlay = document.querySelector('.search-overlay');
        const searchInput = document.querySelector('.input-search');
        const submitButton = document.querySelector('.submit-button');

        // Kiểm tra xem các phần tử có tồn tại trước khi gán sự kiện cho chúng
        if (searchIcon && searchOverlay && searchInput && submitButton) {
            // Sự kiện khi click vào biểu tượng tìm kiếm
            searchIcon.addEventListener('click', function() {
                if (searchOverlay.style.display === 'block') {
                    searchOverlay.style.display = 'none';
                } else {
                    searchOverlay.style.display = 'block';
                    searchInput.focus(); // Tự động focus vào ô tìm kiếm
                }
            });

            // Ẩn overlay khi click ra ngoài
            document.addEventListener('click', function(event) {
                if (!searchOverlay.contains(event.target) && !searchIcon.contains(event.target)) {
                    searchOverlay.style.display = 'none';
                }
            });

            // Gửi form khi nhấn Enter
            searchInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Ngăn chặn gửi form mặc định
                    submitForm();
                }
            });

            // Gửi form khi click nút submit
            submitButton.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn gửi form mặc định
                submitForm();
            });

            // Hàm gửi form
            function submitForm() {
                const key = searchInput.value.trim();
                if (key !== '') {
                    const url = '<?php echo $fullpath."/search/" ?>?key=' + encodeURIComponent(key);
                    window.location.href = url;
                }
            }
        } else {
            // Thay vì ghi lỗi ra console, bạn có thể hiển thị thông báo lỗi trên trang hoặc bỏ qua phần mã liên quan
            console.error('One or more required elements are not found in the DOM.');
        }
    });



</script>

<?php
$step_ids ='';
$sp_steps = LAY_step1($step_ids); // Fetch all steps that match the IDs
?>
<script>
    $(document).ready(function() {
        <?php if (!empty($sp_steps)): ?>
        <?php foreach ($sp_steps as $step): ?>
        <?php if (isset($step['icon'])): ?>
        var imageUrl = "<?=$fullpath."/".$step['duongdantin']."/".$step['icon']; ?>";

        // Ensure image URL is valid
        if (imageUrl) {
            // Find the corresponding submenu index based on step ID
            var stepId = <?php echo $step['id']; ?>; // Assuming $step['id'] is the step ID
            var submenu = $("#menu li ul").eq(stepId - 1); // Adjust index if necessary

            // Prepend image to the corresponding submenu
            if (submenu.length) {
                submenu.prepend('<img src="' + imageUrl + '" >');
            }
        }
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    });
</script>
<script>
    $(function(){
        $(".menu > li").each(function(){
            if($("ul", this).length > 0){
                var a_ok = $("a", this).eq(0).attr('addok');
                if(a_ok != "ok"){
                    $("a", this).eq(0).append('<i class="fa fa-angle-down"></i>');
                    $("a", this).eq(0).attr("addok", "ok");
                }
            }
        });
    });





</script>

</body>

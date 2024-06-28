<div class="clr"></div>
<?php include _source."footer.php";?>
</div>
</article></section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.js"></script>
<script type="text/javascript" src="js/jquery.lazyload.min.js"></script>
<script type="text/javascript" language="javascript" src="js/me.js?v=<?=time() ?>"></script>
<script src='menu_mb/jquery.mmenu.min.js' type='text/javascript'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/8.5.22/mmenu.min.css" />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo plugin mmenu
        var $navMobile = $("#nav-mobile");
        $navMobile.mmenu({
            // Tùy chọn cấu hình của mmenu (nếu cần)
        });

        // Lưu trữ tham chiếu đến API của mmenu
        var api = $navMobile.data("mmenu");

        // Thêm sự kiện click vào phần tử đầu tiên tìm thấy với selector '.menu-bar a'
        document.querySelector('.menu-bar a').addEventListener('click', function(event) {
            event.preventDefault();
            // Kiểm tra trạng thái của mmenu và mở hoặc đóng menu tương ứng
            if (api.isOpen()) {
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

        if (searchIcon && searchOverlay && searchInput && submitButton) {
            // Toggle search overlay visibility when clicking the search icon
            searchIcon.addEventListener('click', function() {
                if (searchOverlay.style.display === 'block') {
                    searchOverlay.style.display = 'none';
                } else {
                    searchOverlay.style.display = 'block';
                    searchInput.focus(); // Focus on input field
                }
            });

            // Hide search overlay when clicking outside of it
            document.addEventListener('click', function(event) {
                if (!searchOverlay.contains(event.target) && !searchIcon.contains(event.target)) {
                    searchOverlay.style.display = 'none';
                }
            });

            // Handle form submission when Enter key is pressed in the input field
            searchInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Prevent default form submission
                    submitForm();
                }
            });

            // Submit form when the submit button is clicked
            submitButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default form submission
                submitForm();
            });

            // Submit form function
            function submitForm() {
                const key = searchInput.value.trim();
                if (key !== '') {
                    const url = 'http://localhost/phurieng/search/?key=' + encodeURIComponent(key);
                    window.location.href = url;
                }
            }
        } else {
            console.error('One or more required elements are not found in the DOM.');
        }
    });


</script>


<?php
// Assuming $connection is your MySQL database connection

// Function to fetch duongdantin based on icon URL
function getDuongDantinFromStep($icon, $connection) {
    $icon = mysqli_real_escape_string($connection, $icon);
    $query = "SELECT duongdantin FROM lh_step WHERE icon = '$icon'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['duongdantin'];
    } else {
        return ''; // Default empty URL or handle error as needed
    }
}

// Example usage assuming $icon is 'desired_icon_url'
$duongdantin = getDuongDantinFromStep('icon', $connection);
?>
<script>
    $(document).ready(function(){
        var $image_url = "<?php echo htmlspecialchars($duongdantin); ?>"; // Ensure proper escaping for HTML output
        $("#menu li ul").each(function(index, item){
            $(this).prepend('<img src="' + $image_url + '">');
        });
    });
</script>











<script>
    $(function(){
        $(".menu > li").each(function(){
            if($("ul", this).length > 0){
                var a_ok = $("a",this).eq(0).attr('addok');
                if(a_ok != "ok"){
                    $("a",this).eq(0).append('<i class="fa fa-angle-down"></i>');
                    $("a",this).eq(0).attr("addok","ok");
                }
            }
        });
    });



</script>



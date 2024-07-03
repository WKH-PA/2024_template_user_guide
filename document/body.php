
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .sidebar {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 20px; /* Sử dụng top để đặt khoảng cách từ đỉnh trang */
            z-index: 100; /* Đảm bảo sidebar hiển thị trên các phần tử khác khi cuộn */
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        h1, h2, h3 {
            color: #333;
        }

        .feature-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            margin-bottom: 10px;
        }

        .sidebar {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: #555;
            text-decoration: none;
        }
    </style>

<body>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Quản lý sản phẩm</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item">Main modules</li>
                        <li class="breadcrumb-item active"> Quản lý sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3>Danh sách bài viết</h3>
                        <h5 class="border rounded card-body f-w-300 mt-3" id="clipboardExample3">
                            <ul>
                                <li><b>Mô tả:&nbsp;</b>cho phép quản trị viên có thể cấu hình thông tin trong hệ
                                    thống như: "cấu hình chung", "cấu hình logo và liên hệ", "cấu hình hệ
                                    thống", "cấu hình khác".
                                </li>
                                <li><b>Phiên bản:</b> 1.0</li>
                            </ul>
                        </h5>
                    </div>
                    <div class="card-body card-wrapper input-group-wrapper">
                        <div class="intro">

                            <h1 style="text-align: center;">Cấu hình chung</h1>

                            <ul>
                                <li><strong>Tên công ty:</strong> tên thương hiệu của cá nhân hoặc tố chức công
                                    ty
                                </li>
                                <li><strong>Địa chỉ: </strong>địa chỉ văn phòng hoặc nơi đặt văn phòng đại điện
                                </li>
                                <li><strong>SEO (Title, Description, Keywords):</strong> dùng để hiển thị trên
                                    công cụ tìm kiếm
                                </li>
                            </ul>

                            <p style="text-align:center"><img alt="" height="98"
                                                              src="/pjcd_hailong/document_new/images/Qu%E1%BA%A3n%20l%C3%BD%20website/Thi%E1%BA%BFt%20l%E1%BA%ADp%20website/C%E1%BA%A5u%20h%C3%ACnh%20chung.png"
                                                              width="237"></p>

                            <h1 style="text-align: center;">Cấu hình logo và liên hệ</h1>

                            <ul>
                                <li><strong>Logo:</strong> logo thường được xuất hiện ở đầu trang và cuối trang&nbsp;
                                </li>
                                <li><strong>Favico:</strong> được xuất hiện ở tab điểu hướng trên trình duyệt&nbsp;&nbsp;<img
                                            alt="" height="23"
                                            src="/pjcd_hailong/document_new/images/Qu%E1%BA%A3n%20l%C3%BD%20website/Thi%E1%BA%BFt%20l%E1%BA%ADp%20website/Favico.JPG"
                                            width="83"></li>
                                <li><strong>Thông tin liên lạc:&nbsp;</strong>Số điện thoại, Hotline, Email (Tùy
                                    thuộc vào nhu cầu của doanh nghiệp&nbsp;mà thông tin ở đây có thể xuất hiện
                                    hoặc không ở giao diện người dùng)
                                </li>
                            </ul>

                            <p style="text-align:center"><img alt="" height="178"
                                                              src="/pjcd_hailong/document_new/images/Qu%E1%BA%A3n%20l%C3%BD%20website/Thi%E1%BA%BFt%20l%E1%BA%ADp%20website/C%E1%BA%A5u%20h%C3%ACnh%20logo%20v%C3%A0%20li%C3%AAn%20h%E1%BB%87.png"
                                                              width="565"></p>

                            <h1 style="text-align: center;">Cấu hình hệ thống</h1>

                            <ul>
                                <li><strong>Bật HTTPS:</strong> khi tính năng này được kích hoạt thì website sẽ
                                    tự động dẫn người dùng đến liên kết https
                                </li>
                                <li><strong>Bật comment facebook: </strong>khi tính năng này được bật hệ thống
                                    sẽ hiển thị faceboook chat lên website <em>(Dạng liên kết)</em></li>
                                <li><strong>Bật zalo chat:</strong>&nbsp;khi tính năng này được bật hệ thống sẽ
                                    hiển thị zalo chat lên website&nbsp;<em>(Dạng liên kết)</em></li>
                                <li><strong>Bật ngôn ngữ:</strong> tính năng này cho phép quản trị viên có thể
                                    điều khiển việc ẩn hoặc hiển thị&nbsp;cờ ngôn ngữ của website ở giao diện
                                    người dùng
                                </li>
                                <li><strong>Chống sao chép:</strong>&nbsp;khi tính năng này được kích hoạt thì
                                    tại giao diện người dùng hệ thống sẽ chặn việc copy nội dung
                                </li>
                                <li><strong>Tiếng việt (Mặc định):</strong>&nbsp;khi website có nhiều hơn một
                                    ngôn ngữ và bạn muốn ngôn ngữ mặc định khi người dùng vào webiste là <b>"Tiếng
                                        Việt"</b> thì hãy đánh dấu tại ô tùy chọn này
                                </li>
                                <li><strong>Facebook messages: l</strong>iên kết đến facebook chat của bạn</li>
                                <li><strong>Zalo chat: l</strong>iên kết đến zalo chat của bạn</li>
                                <li><strong>IP/Server, Email, Mật khẩu:</strong><b> </b>đây là thông số kết nối
                                    đến máy chủ email, thực hiện gửi mail đến người dùng của website (Tùy thuộc
                                    vào tính năng của website mà cấu hình thông tin cho hợp lý)
                                </li>
                            </ul>

                            <p style="text-align:center"><img alt="" height="284"
                                                              src="/pjcd_hailong/document_new/images/Qu%E1%BA%A3n%20l%C3%BD%20website/Thi%E1%BA%BFt%20l%E1%BA%ADp%20website/C%E1%BA%A5u%20h%C3%ACnh%20h%E1%BB%87%20th%E1%BB%91ng.JPG"
                                                              width="546"></p>

                            <h1 style="text-align: center;">Cấu hình khác&nbsp;</h1>

                            <ul>
                                <li><strong>Code header: </strong>phần tiện tích giúp cho quản trị viên có thể
                                    thêm những đoạn mã javascript bên thứ ba vào website của mình
                                </li>
                                <li><strong>Robots: </strong>thông tin cấu hình chặn robots &nbsp;tìm kiếm&nbsp;
                                </li>
                            </ul>

                            <p style="text-align:center"><img alt="" height="278"
                                                              src="/pjcd_hailong/document_new/images/Qu%E1%BA%A3n%20l%C3%BD%20website/Thi%E1%BA%BFt%20l%E1%BA%ADp%20website/C%E1%BA%A5u%20h%C3%ACnh%20kh%C3%A1c.JPG"
                                                              width="505"></p></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="md-sidebar-aside custom-scrollbar">
                    <div class="file-sidebar">
                        <div class="card">
                            <div class="card-body">
                                <ul>
                                    <li>
                                        <div class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-home">
                                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                            </svg>
                                            Danh sách bài viết
                                        </div>
                                    </li>
                                    <li>
                                        <div class="btn btn-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-folder">
                                                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                            </svg>
                                            Danh sách chủ đề
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

<script>
    // Lấy tất cả các liên kết trong sidebar
    const sidebarLinks = document.querySelectorAll('.sidebar a');

    // Thêm sự kiện click cho mỗi liên kết
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            // Tính toán khoảng cách cần cuộn
            const offsetTop = targetElement.getBoundingClientRect().top + window.pageYOffset - 110;

            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        });
    });
</script>

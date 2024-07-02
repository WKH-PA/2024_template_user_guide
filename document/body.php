
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
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Quản lý tính năng Công Trình</h1>

            <div class="feature-box" id="bai-viet-cong-trinh-content">
                <h2>Bài Viết Công Trình</h2>
                <p>Mô tả: chủ đề Công Trình giúp phân loại bài viết hoặc sản phẩm một cách rõ ràng. Bạn có thể thêm các thông tin chi tiết về chủ đề, cách sử dụng, các tùy chọn, v.v. tại đây. Nội dung nên được trình bày rõ ràng, dễ hiểu và có ví dụ minh họa cụ thể.</p>
                <p>Phiên bản: 1.0</p>

                <h3>Danh sách bài viết Công Trình</h3>
                <ul class="feature-list">
                    <li><strong>STT:</strong> thông tin định số tăng dần từ 1..n</li>
                    <li><strong>Tiêu đề:</strong> đây là thông tin tiêu của Công Trình mà quản trị đã thêm</li>
                    <li><strong>Hiện thị:</strong> nếu tùy chọn này được bật đồng nghĩa với thông tin sẽ được hiển thị và ngược lại là ẩn (Tùy thuộc vào dự án mà cân dùng tùy chọn này hoặc không)</li>
                    <li><strong>Hình ảnh:</strong> ảnh đại diện của Công Trình</li>
                    <li><strong>Xóa:</strong> đồng dữ liệu được đánh dấu sẽ được xóa</li>
                    <li><strong>Lưu lại:</strong> nút chức năng thực hiện việc lưu lại thông tin mà người dùng thao tác trên biểu</li>
                    <li><strong>Thêm mới:</strong> nút chức năng thực hiện việc mở liên kết đến biểu mẫu thêm mới "Công Trình"</li>
                </ul>

                <h3>Bộ lọc tìm kiếm</h3>
                <ul class="feature-list">
                    <li>Tìm kiếm theo từ khóa</li>
                    <li>Tìm kiếm theo chủ đề</li>
                </ul>
            </div>

            <div class="feature-box" id="danh-muc-cong-trinh-content">
                <h2>Danh mục Công Trình</h2>
                <p>Nội dung cho Danh mục Công Trình. Bạn có thể thêm các thông tin chi tiết về chủ đề, cách sử dụng, các tùy chọn, v.v. tại đây. Nội dung nên được trình bày rõ ràng, dễ hiểu và có ví dụ minh họa cụ thể.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="sidebar">
                <h3>Chủ đề</h3>
                <ul>
                    <li><a href="#bai-viet-cong-trinh-content">Bài viết Công Trình</a></li>
                    <li><a href="#danh-muc-cong-trinh-content">Danh mục Công Trình</a></li>
                </ul>
            </div>
        </div>
    </div>
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

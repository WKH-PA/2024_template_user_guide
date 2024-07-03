
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
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a></li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="card-body card-wrapper input-group-wrapper">
                <div class="intro">
                    <h1>Nội dung mới</h1>
                    <p>Đây là nội dung mới bạn muốn thêm vào.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>


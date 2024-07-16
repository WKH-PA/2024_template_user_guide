<style>
    .dv-load-xong {
        position: fixed;
        right: 68px;
        bottom: 40px;
        z-index: -1;
        background: rgba(0, 0, 0, 0.5490196078431373);
        padding: 0 16px 0 10px;
        font-size: 13px;
        color: #fff;
        border-radius: 100px;
        min-width: 120px;
        margin-bottom: -15px;
        opacity: 0;
        transition: all .4s;
        height: 26px;
        line-height: 26px;
    }
    .dv-load-xong.active {
        z-index: 9;
        margin-bottom: 10px;
        opacity: 1;
    }
    .dv-load-xong img {
        height: 20px;
        position: relative;
        top: -1px;
        margin-right: 6px;
    }
</style>

<div class="dv-load-xong"><img src="../images/loadernew.gif" alt="">Update data ...</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="bower_components/ckeditor/ckeditor.js"></script>
<script src="bower_components/ckfinder/ckfinder.js"></script>
<script src="js/me.js?v=2"></script>
<script src="js/jquery-ui.js?v=2"></script>
<link rel="stylesheet" href="css/jquery-ui.css?v=2">

<script>
    $(document).ready(function() {
        // Initialize CKEditor for .paEditor elements
        $('.paEditor').each(function() {
            CKEDITOR.replace($(this).attr('name'), {
                filebrowserBrowseUrl: '<?=$forder_goc ?>myadmin/bower_components/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: '<?=$forder_goc ?>myadmin/bower_components/ckfinder/ckfinder.html?type=Images',
                filebrowserUploadUrl: '<?=$forder_goc ?>myadmin/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl: '<?=$forder_goc ?>myadmin/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                removePlugins: 'elementspath',
                height: 200, // Điều chỉnh chiều cao của CKEditor
                toolbar: 'Basic'
            });
        });

        // Initialize CKEditor for .paEditorimg elements
        $('.paEditorimg').each(function() {
            CKEDITOR.replace($(this).attr('name'), {
                toolbar: [
                    { name: 'insert', items: ['Image'] }
                ],
                removePlugins: 'elementspath',
                height: 50,  // Điều chỉnh chiều cao của CKEditor để phù hợp với phần chèn ảnh
                filebrowserBrowseUrl: '<?=$forder_goc ?>myadmin/bower_components/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: '<?=$forder_goc ?>myadmin/bower_components/ckfinder/ckfinder.html?type=Images',
                filebrowserUploadUrl: '<?=$forder_goc ?>myadmin/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl: '<?=$forder_goc ?>myadmin/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                on: {
                    instanceReady: function(ev) {
                        ev.editor.on('focus', function(e) {
                            e.editor.execCommand('browse');
                        });
                    }
                }
            });
        });

        // Function to handle AJAX update on checkbox change
        $(document).on("change", "input.minimal_click", function() {
            var check = $(this).is(":checked") ? 1 : 0;
            var colum = $(this).attr("colum");
            var idcol = $(this).attr("idcol");
            var table = $(this).attr("table");

            $(".dv-load-xong").addClass('active');

            $.ajax({
                type: "POST",
                url: "index.php",
                data: {
                    'id': idcol, 'check': check, 'col': colum, 'table': table,
                    'action': '<?=$action ?>',
                    'step': '<?=$step ?>',
                    'id_step': '<?=$id_step ?>',
                    "ajax_action": "update_colum"
                },
                success: function(data) {
                    if (data == "1") {
                        setTimeout(function() {
                            $(".dv-load-xong").removeClass('active');
                        }, 1000);
                    } else {
                        alert(data);
                        window.location.reload();
                    }
                }
            });
        });

        // Function to handle AJAX update on select change
        function UPDATE_colum(obj, id, col, table) {
            $(".dv-load-xong").addClass('active');
            $.ajax({
                type: "POST",
                url: "index.php",
                data: {
                    'id': id, 'val': $(obj).val(), 'col': col, 'table': table,
                    'action': '<?=$action ?>',
                    'step': '<?=$step ?>',
                    'id_step': '<?=$id_step ?>',
                    "ajax_action": "update_colum_change"
                },
                success: function(data) {
                    if (data == "1") {
                        setTimeout(function() {
                            $(".dv-load-xong").removeClass('active');
                        }, 1000);
                    } else {
                        alert(data);
                        window.location.reload();
                    }
                }
            });
        }

        // Code to activate the Bootstrap components
        $.widget.bridge('uibutton', $.ui.button);

        // Datepicker initialization
        $('.datepicker').attr('autocomplete', 'off').datepicker({
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            format: 'dd/mm/yyyy'
        });

        $("#datepicker").datepicker({
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            format: 'dd/mm/yyyy'
        });

        // Highlight active menu item
        $(".sidebar-menu a").each(function() {
            var url_goc = "<?php
                if(isset($_GET['id-parent'])) echo $url_page."&id-parent=".@$_GET['id-parent'];
                else if(isset($_GET['them-moi']) && isset($_GET['step'])) echo $url_page."&step=".@$_GET['step']."&id_step=".@$_GET['id_step'];
                else if(isset($_GET['step'])) echo $url_page."&step=".@$_GET['step']."&id_step=".@$_GET['id_step'];
                else echo $url_page;
                ?>";
            var href = $(this).attr("href");
            var full = "<?php
                if(isset($_GET['id-parent'])) echo $url_page."&id-parent=".@$_GET['id-parent'];
                else if(isset($_GET['noi-dung'])) echo $url_page."&noi-dung=true";
                else if(isset($_GET['them-moi']) && !isset($_GET['step'])) echo $url_page."&them-moi=true";
                else if(isset($_GET['them-moi']) && isset($_GET['step'])) echo $url_page."&them-moi=true&step=".@$_GET['step']."&id_step=".@$_GET['id_step'];
                else if(isset($_GET['step'])) echo $url_page."&step=".@$_GET['step']."&id_step=".@$_GET['id_step'];
                else echo $url_page;
                ?>";
            var check_ok = $(this).attr("check");
            if (href == full || (check_ok == "ok") && url_goc == href) {
                $(this).parent().addClass("active");
                $(this).closest("li.treeview").addClass("menu-open active");
                $(this).parents("li.treeview").addClass("menu-open active");
            }
        });

        // Scroll event for fixed menu
        $(window).scroll(function() {
            if ($(".nav-tabs-custom").length > 0) {
                var hei = $('.nav-tabs-custom').offset().top;
                if ($(window).scrollTop() >= hei) {
                    $('.nav-tabs-custom > .nav-tabs').addClass('fixed');
                } else {
                    $('.nav-tabs-custom > .nav-tabs').removeClass('fixed');
                }
            }
        });

        // Initialize Select2 or SumoSelect based on class
        var settingSelect = {
            csvDispCount: 6,
            captionFormat: '{0} Danh mục',
            captionFormatAllSelected: 'Chọn tất cả ({0})',
            search: true,
            searchText: 'Nhập tìm kiếm...',
            selectAll: true,
            multiple: 'multiple',
            locale: ['Chọn', 'Thoát', 'Chọn tất cả', ' aa'],
            noMatch: 'Không tìm thấy kết quả phù hợp \'{0}\' ',
        };

        if ($('.SlectBoxNew').length > 0) {
            $('.SlectBoxNew').SumoSelect(settingSelect);
        }

        if ($('.SlectBox').length > 0) {
            $('.SlectBox').select2();
        }

        // Ensure visibility of .v2_select elements
        $('.v2_select').css("opacity", "1");
    });
</script>

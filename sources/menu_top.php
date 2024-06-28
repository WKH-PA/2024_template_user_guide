<ul class="menu tree_parent no_box" id="menu">
    <?=GET_menu_new($full_url, $lang, '', '', '') ?>
</ul>
<div class="mn-mobile" id="mmenu">
    <div class="back-button-container">
    </div>
    <div class="menu-bar hidden-md hidden-lg">
        <a href="#nav-mobile">
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
        </a>
    </div>

    <div id="nav-mobile" style="display: none;">
        <ul class="mm-listview">
            <?=GET_menu_new($full_url, $lang, '', '', '') ?>
        </ul>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Function to populate mobile menu
        function populateMobileMenu() {
            var menuHtml = $('#menu').html(); // Get menu items from main menu
            $('#nav-mobile ul').html(menuHtml); // Populate mobile menu with main menu items

            // Ensure mm-listview is updated with new content
            $('#nav-mobile').trigger('update.mm');
        }

        // Initialize mm-listview for mobile menu
        var mobileMenu = $('#nav-mobile').mmenu({
            extensions: ['effect-menu-slide', 'pagedim-black'],
            counters: true,
            navbar: {
                title: 'Menu'
            },
            offCanvas: {
                position: 'right'
            }
        }, {
            // Configuration options for mm-listview
            setSelected: true, // Set the selected menu item
            onClick: {
                close: true, // Close the menu after clicking a link
                preventDefault: false, // Allow default click behavior
            }
        });

        // Populate mobile menu on page load
        populateMobileMenu();

        // Update mobile menu when window is resized (optional)
        $(window).resize(function() {
            populateMobileMenu();
        });

        // Handle click on menu items with submenus
        $('#nav-mobile').on('click', 'li.mm-listitem > a', function(e) {
            var submenu = $(this).next('ul');
            if (submenu.length > 0) {
                e.preventDefault();
                if (!submenu.hasClass('mm-opened')) {
                    submenu.addClass('mm-opened'); // Open submenu
                } else {
                    submenu.removeClass('mm-opened'); // Close submenu
                }
            }
        });
    });

</script>

document.addEventListener('DOMContentLoaded', function () {
    // Cache selectors for efficiency
    var $toggle = $('#dark-mode-toggle');
    var $html = $('html');
    var $lightLogo = $('.light-mode-logo');
    var $darkLogo = $('.dark-mode-logo');
    var isAuthenticated = window.isAuthenticated;

    function updateLogos() {
        if ($lightLogo.length && $darkLogo.length) {
            if ($html.hasClass('dark-mode')) {
                $lightLogo.hide();
                $darkLogo.show();
            } else {
                $lightLogo.show();
                $darkLogo.hide();
            }
        }
    }

    if (!isAuthenticated) {
        $html.removeClass('dark-mode');
    } else {
        if (localStorage.getItem('dark-mode') === 'true') {
            $html.addClass('dark-mode');
            $toggle.prop('checked', true);
        } else {
            $html.removeClass('dark-mode');
            $toggle.prop('checked', false);
        }
        $toggle.on('change', function () {
            if ($toggle.prop('checked')) {
                $html.addClass('dark-mode');
                localStorage.setItem('dark-mode', 'true');
                document.cookie = "dark-mode=true; path=/; max-age=31536000";
            } else {
                $html.removeClass('dark-mode');
                localStorage.setItem('dark-mode', 'false');
                document.cookie = "dark-mode=false; path=/; max-age=31536000";
            }
            updateLogos();
        });
    }

    updateLogos();
});

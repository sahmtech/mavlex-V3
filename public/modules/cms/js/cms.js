// ==========================================================================
//  NAVBAR FUNCTIONALITY
// ==========================================================================

document.addEventListener('DOMContentLoaded', function() {
    
    // ==========================================================================
    // MOBILE MENU FUNCTIONALITY
    // ==========================================================================
    const mobileToggle = document.getElementById('mobileNavToggle');
    const mobileMenu = document.getElementById('mobileNavMenu');
    const body = document.body;
    
    // Mobile menu toggle
    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isActive = mobileMenu.classList.contains('is-active');
            
            if (isActive) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }
    
    function openMobileMenu() {
        mobileMenu.classList.add('is-active');
        mobileToggle.classList.add('is-active');
        body.classList.add('mobile-menu-open');
        mobileToggle.setAttribute('aria-expanded', 'true');
        
        // Prevent body scroll when menu is open
        body.style.overflow = 'hidden';
    }
    
    function closeMobileMenu() {
        mobileMenu.classList.remove('is-active');
        mobileToggle.classList.remove('is-active');
        body.classList.remove('mobile-menu-open');
        mobileToggle.setAttribute('aria-expanded', 'false');
        
        // Restore body scroll
        body.style.overflow = '';
        
        // Close all mobile dropdowns
        const mobileDropdowns = document.querySelectorAll('.modern-navbar__mobile-dropdown');
        mobileDropdowns.forEach(dropdown => {
            dropdown.classList.remove('is-active');
        });
        
        // Close language dropdown
        const mobileLangDropdown = document.querySelector('.mobile-lang-dropdown');
        if (mobileLangDropdown) {
            mobileLangDropdown.classList.remove('is-active');
        }
    }
    
    // ==========================================================================
    // MOBILE LANGUAGE DROPDOWN
    // ==========================================================================
    const mobileLangToggle = document.querySelector('.mobile-lang-toggle');
    const mobileLangDropdown = document.querySelector('.mobile-lang-dropdown');
    
    if (mobileLangToggle && mobileLangDropdown) {
        mobileLangToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            mobileLangDropdown.classList.toggle('is-active');
            
            // Update aria-expanded
            const isExpanded = mobileLangDropdown.classList.contains('is-active');
            this.setAttribute('aria-expanded', isExpanded);
        });
    }
    
    // ==========================================================================
    // MOBILE PAGES DROPDOWN
    // ==========================================================================
    const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
    mobileDropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const dropdown = this.nextElementSibling;
            if (dropdown && dropdown.classList.contains('modern-navbar__mobile-dropdown')) {
                dropdown.classList.toggle('is-active');
                
                // Update aria-expanded
                const isExpanded = dropdown.classList.contains('is-active');
                this.setAttribute('aria-expanded', isExpanded);
            }
        });
    });
    
    // ==========================================================================
    // DESKTOP DROPDOWN FUNCTIONALITY
    // ==========================================================================
    const desktopDropdowns = document.querySelectorAll('.modern-navbar__center .has-dropdown');
    
    desktopDropdowns.forEach(dropdown => {
        const dropdownMenu = dropdown.querySelector('.modern-navbar__dropdown');
        
        if (dropdownMenu) {
            dropdown.addEventListener('mouseenter', function() {
                if (window.innerWidth >= 992) {
                    dropdownMenu.classList.add('is-active');
                }
            });
            
            dropdown.addEventListener('mouseleave', function() {
                if (window.innerWidth >= 992) {
                    dropdownMenu.classList.remove('is-active');
                }
            });
        }
    });
    
    // ==========================================================================
    // CLICK OUTSIDE TO CLOSE
    // ==========================================================================
    document.addEventListener('click', function(event) {
        // Close mobile menu if clicking outside
        if (mobileMenu && mobileToggle && mobileMenu.classList.contains('is-active')) {
            if (!mobileToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
                closeMobileMenu();
            }
        }
        
        // Close mobile language dropdown if clicking outside
        if (mobileLangDropdown && mobileLangToggle && mobileLangDropdown.classList.contains('is-active')) {
            if (!mobileLangToggle.contains(event.target) && !mobileLangDropdown.contains(event.target)) {
                mobileLangDropdown.classList.remove('is-active');
                mobileLangToggle.setAttribute('aria-expanded', 'false');
            }
        }
    });
    
    // ==========================================================================
    // WINDOW RESIZE HANDLER
    // ==========================================================================
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            if (window.innerWidth > 991) {
                closeMobileMenu();
            }
        }, 150);
    });
    
    // ==========================================================================
    // THEME SWITCH SYNCHRONIZATION
    // ==========================================================================
    const desktopThemeSwitch = document.getElementById('themeSwitchCheckbox');
    const mobileThemeSwitch = document.getElementById('themeSwitchMobile');
    
    if (desktopThemeSwitch && mobileThemeSwitch) {
        desktopThemeSwitch.addEventListener('change', function() {
            mobileThemeSwitch.checked = this.checked;
            applyTheme(this.checked);
        });
        
        mobileThemeSwitch.addEventListener('change', function() {
            desktopThemeSwitch.checked = this.checked;
            applyTheme(this.checked);
        });
    }
    
    // // ==========================================================================
    // // STICKY NAVBAR
    // // ==========================================================================
    // let lastScrollY = window.scrollY;
    // const navbar = document.querySelector('.modern-navbar');
    
    // window.addEventListener('scroll', function() {
    //     if (!navbar) return;
        
    //     const currentScrollY = window.scrollY;
        
    //     if (currentScrollY > 100) {
    //         navbar.classList.add('is-sticky');
    //     } else {
    //         navbar.classList.remove('is-sticky');
    //     }
        
    //     // Optional: Hide navbar on scroll down, show on scroll up
    //     if (currentScrollY > lastScrollY && currentScrollY > 200) {
    //         navbar.classList.add('is-hidden');
    //     } else {
    //         navbar.classList.remove('is-hidden');
    //     }
        
    //     lastScrollY = currentScrollY;
    // });
});

// ==========================================================================
// DARK MODE FUNCTIONALITY
// ==========================================================================
document.addEventListener('DOMContentLoaded', function () {
    const $lightLogo = $('.light-mode-logo');
    const $darkLogo = $('.dark-mode-logo');
    const themeSwitchCheckbox = document.getElementById('themeSwitchCheckbox');
    const mobileThemeSwitch = document.getElementById('themeSwitchMobile');
    const bodyElement = document.body;
    const cookieName = 'theme-dark-mode';
    
    function updateLogos() {
        if ($lightLogo.length && $darkLogo.length) {
            if ($('body').hasClass('dark-mode')) {
                $lightLogo.hide();
                $darkLogo.show();
            } else {
                $lightLogo.show();
                $darkLogo.hide();
            }
        }
    }
    
    // Helper function to set a cookie
    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
    }

    // Helper function to get a cookie
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Function to apply the theme
    function applyTheme(isDark) {
        if (isDark) {
            bodyElement.classList.add('dark-mode');
            if (themeSwitchCheckbox) themeSwitchCheckbox.checked = true;
            if (mobileThemeSwitch) mobileThemeSwitch.checked = true;
        } else {
            bodyElement.classList.remove('dark-mode');
            if (themeSwitchCheckbox) themeSwitchCheckbox.checked = false;
            if (mobileThemeSwitch) mobileThemeSwitch.checked = false;
        }
        updateLogos();
        setCookie(cookieName, isDark ? 'true' : 'false', 30);
    }
    
    // Make applyTheme globally accessible
    window.applyTheme = applyTheme;

    // Initialize theme based on cookie
    let currentThemeIsDark = false;
    const storedTheme = getCookie(cookieName);

    if (storedTheme) {
        currentThemeIsDark = storedTheme === 'true';
    } else {
        // Optional: Check for system preference if no cookie is set
        currentThemeIsDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    }
    
    applyTheme(currentThemeIsDark);

    // Event listeners for theme switches
    if (themeSwitchCheckbox) {
        themeSwitchCheckbox.addEventListener('change', function() {
            applyTheme(this.checked);
        });
    }
    
    if (mobileThemeSwitch) {
        mobileThemeSwitch.addEventListener('change', function() {
            applyTheme(this.checked);
        });
    }
});

// ==========================================================================
// SMOOTH SCROLL FOR ANCHOR LINKS
// ==========================================================================
document.addEventListener('DOMContentLoaded', function() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#' || href === '') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                
                // Close mobile menu if open
                const mobileMenu = document.getElementById('mobileNavMenu');
                if (mobileMenu && mobileMenu.classList.contains('is-active')) {
                    mobileMenu.classList.remove('is-active');
                    document.getElementById('mobileNavToggle').classList.remove('is-active');
                    document.body.classList.remove('mobile-menu-open');
                }
                
                // Smooth scroll to target
                const navbarHeight = document.querySelector('.modern-navbar').offsetHeight;
                const targetPosition = target.offsetTop - navbarHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});

// ==========================================================================
// ACCESSIBILITY IMPROVEMENTS
// ==========================================================================
document.addEventListener('DOMContentLoaded', function() {
    // Add ARIA attributes
    const mobileToggle = document.getElementById('mobileNavToggle');
    const mobileMenu = document.getElementById('mobileNavMenu');
    
    if (mobileToggle && mobileMenu) {
        mobileToggle.setAttribute('aria-expanded', 'false');
        mobileToggle.setAttribute('aria-controls', 'mobileNavMenu');
        mobileMenu.setAttribute('aria-hidden', 'true');
    }
    
    // Handle escape key to close mobile menu
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (mobileMenu && mobileMenu.classList.contains('is-active')) {
                mobileMenu.classList.remove('is-active');
                mobileToggle.classList.remove('is-active');
                document.body.classList.remove('mobile-menu-open');
                mobileToggle.setAttribute('aria-expanded', 'false');
                mobileMenu.setAttribute('aria-hidden', 'true');
            }
        }
    });
});

// ==========================================================================
// PERFORMANCE OPTIMIZATIONS
// ==========================================================================
// Throttle function for scroll events
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

// Debounce function for resize events
function debounce(func, wait, immediate) {
    let timeout;
    return function() {
        const context = this, args = arguments;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}
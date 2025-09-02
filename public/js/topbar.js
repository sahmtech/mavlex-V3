
document.addEventListener('DOMContentLoaded', function() {
  var nav = document.getElementById('mainNav');
  var submenus = [];
  var active_submenu = null;
  var nav_original_offset_top = nav.offsetTop;
  
  var current_url = window.location.href.split('?')[0];
  var current_path = new URL(current_url).pathname;
  
  function getDevConsoleOffset() {
    if (window.visualViewport) {
      return window.innerHeight - window.visualViewport.height;
    }
    return 0;
  }
  
  function isTopbarVisible() {
    var topbar = document.querySelector('.topbar, .top-bar, header, .header');
    if (!topbar) return false;
    
    var rect = topbar.getBoundingClientRect();
    return rect.bottom > 0; 
  }
  
  function handle_scroll() {
    var currentScrollTop = window.pageYOffset;
    var shouldBeSticky = currentScrollTop >= nav_original_offset_top;
    
    if (shouldBeSticky && !nav.classList.contains('sticky')) {
      nav.classList.add('sticky');
      
      var devConsoleOffset = getDevConsoleOffset();
      nav.style.top = devConsoleOffset + 'px';
      
      var navHeight = nav.offsetHeight;
      document.body.style.setProperty('--nav-height', navHeight + 'px');
      document.body.classList.add('nav-sticky');
      
      submenus.forEach(function(submenu) {
        submenu.classList.add('sticky-submenu');
      });
      
    } else if (!shouldBeSticky && nav.classList.contains('sticky')) {
      nav.classList.remove('sticky');
      nav.style.top = '';
      
      document.body.classList.remove('nav-sticky');
      document.body.style.setProperty('--nav-height', '');
      
      submenus.forEach(function(submenu) {
        submenu.classList.remove('sticky-submenu');
      });
      
    } else if (shouldBeSticky && nav.classList.contains('sticky')) {
      var devConsoleOffset = getDevConsoleOffset();
      nav.style.top = devConsoleOffset + 'px';
    }
  }
  
  function position_submenu(li, submenu) {
    var rect = li.getBoundingClientRect();
    var scroll_x = window.scrollX || document.documentElement.scrollLeft;
    
    var menuItems = document.querySelectorAll('nav.horizontal-menu-wrapper .horizontal-menu > li.nav-item');
    var isLastItem = li === menuItems[menuItems.length - 1];
    
    var left, top;
    
    if (nav.classList.contains('sticky')) {
      top = rect.bottom;
      submenu.style.position = 'fixed';
      
      if (isLastItem) {
        // For the last item, align submenu to the right edge of the parent item
        submenu.style.left = 'auto';
        submenu.style.right = (window.innerWidth - rect.right) + 'px';
      } else {
        // Normal positioning for other items
        left = rect.left;
        submenu.style.left = left + 'px';
        submenu.style.right = 'auto';
      }
    } else {
      top = rect.bottom + (window.scrollY || document.documentElement.scrollTop);
      submenu.style.position = 'absolute';
      
      if (isLastItem) {
        // For the last item, calculate position from right
        var navRect = nav.getBoundingClientRect();
        var rightOffset = navRect.right - rect.right + scroll_x;
        submenu.style.left = 'auto';
        submenu.style.right = rightOffset + 'px';
      } else {
        // Normal positioning for other items
        left = rect.left + scroll_x;
        submenu.style.left = left + 'px';
        submenu.style.right = 'auto';
      }
    }
    
    submenu.style.top = top + 'px';
    
    // Add or remove the last-item-submenu class
    if (isLastItem) {
      submenu.classList.add('last-item-submenu');
    } else {
      submenu.classList.remove('last-item-submenu');
    }
  }
  
  function close_all_submenus() {
    submenus.forEach(function(sub) {
      sub.style.display = 'none';
      var parent_li = sub._parent_li;
      if (parent_li) {
        parent_li.classList.remove('active');
        parent_li.classList.remove('submenu-open');
      }
    });
    active_submenu = null;
  }
  
  function open_submenu(li, submenu) {
    close_all_submenus();
    position_submenu(li, submenu);
    submenu.style.display = 'block';
    li.classList.add('active');
    li.classList.add('submenu-open');
    active_submenu = submenu;
  }

  function mark_active_menu_items() {
    document.querySelectorAll('.nav-link.active-top, .nav-link.active').forEach(function(el) {
      el.classList.remove('active-top', 'active');
    });
    
    var active_parents = new Set();
    
    submenus.forEach(function(submenu) {
      var submenu_links = submenu.querySelectorAll('.nav-link');
      var has_active_child = false;
      
      submenu_links.forEach(function(link) {
        if (link.href && link.href !== '#' && link.href !== '' && !link.href.endsWith('#')) {
          try {
            var link_url = new URL(link.href);
            var link_path = link_url.pathname;
            
            if (link_path === current_path) {
              link.classList.add('active');
              has_active_child = true;
            }
          } catch (e) {
            console.error('Error processing URL:', link.href, e);
          }
        }
      });
      
      if (has_active_child && submenu._parent_li) {
        active_parents.add(submenu._parent_li);
      }
    });
    
    document.querySelectorAll('nav.horizontal-menu-wrapper .horizontal-menu > li.nav-item')
      .forEach(function(top_item) {
        var top_link = top_item.querySelector('.nav-link');
        var should_be_active = false;
        
        if (active_parents.has(top_item)) {
          should_be_active = true;
        }
        
        if (!top_item.classList.contains('toogle-sidebar-submenu') &&
            top_link.href && 
            top_link.href !== '#' && 
            top_link.href !== '' && 
            !top_link.href.endsWith('#') &&
            top_link.getAttribute('href') !== '#' &&
            top_link.getAttribute('href') !== '') {
          try {
            var top_link_path = new URL(top_link.href).pathname;
            if (top_link_path === current_path && top_link.href.indexOf('#') === -1) {
              should_be_active = true;
            }
          } catch (e) {
            console.error('Error processing top link URL:', top_link.href, e);
          }
        }
        
        if (should_be_active) {
          top_link.classList.add('active-top');
        }
      });
  }
  
  document.querySelectorAll('nav.horizontal-menu-wrapper .horizontal-menu > li.nav-item')
    .forEach(function(li) {
      var submenu = li.querySelector('.side-submenu');
      if (!submenu) return;
      
      document.body.appendChild(submenu);
      submenus.push(submenu);
      submenu._parent_li = li;
      
      li.querySelector('.nav-link').addEventListener('click', function(e) {
        if (li.classList.contains('toogle-sidebar-submenu')) {
          e.preventDefault();
          e.stopPropagation();
          
          if (active_submenu === submenu) {
            close_all_submenus();
          } else {
            open_submenu(li, submenu);
          }
        }
      });
    });
  
  document.addEventListener('click', function(e) {
    if (!e.target.closest('.side-submenu') &&
        !e.target.closest('nav.horizontal-menu-wrapper')) {
      close_all_submenus();
    }
  });
  
  window.addEventListener('resize', function() {
    close_all_submenus();
    
    nav.classList.remove('sticky');
    nav.style.top = '';
    document.body.classList.remove('nav-sticky');
    document.body.style.setProperty('--nav-height', '');
    
    nav.offsetHeight;
    nav_original_offset_top = nav.offsetTop;
    
    handle_scroll();
  });
  
  if (window.visualViewport) {
    window.visualViewport.addEventListener('resize', function() {
      if (nav.classList.contains('sticky')) {
        var devConsoleOffset = getDevConsoleOffset();
        nav.style.top = devConsoleOffset + 'px';
      } else {
        handle_scroll();
      }
    });
  }
  
  window.addEventListener('scroll', handle_scroll);
  
  window.addEventListener('scroll', function() {
    if (active_submenu) {
      var parent_li = active_submenu._parent_li;
      if (parent_li) {
        position_submenu(parent_li, active_submenu);
      }
    }
  });
  
  nav.querySelector('.scroll-container').addEventListener('scroll', function() {
    if (active_submenu) {
      var parent_li = active_submenu._parent_li;
      if (parent_li) {
        position_submenu(parent_li, active_submenu);
      }
    }
  });
  
  mark_active_menu_items();
});
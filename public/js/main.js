// Close all menus function
function closeAllMenus() {
  const menus = document.querySelectorAll('.open-menu, .open-notification, .open-table-menu');
  menus.forEach(menu => {
    menu.classList.remove('open-menu', 'open-notification', 'open-table-menu');
  });
}

// Notification
let notification = document.getElementById("notification");

 function notificationOpen(event) {
    event.stopPropagation();
    if (notification.classList.contains('open-notification')) {
      notification.classList.remove('open-notification');
    } else {
      closeAllMenus();
      notification.classList.add('open-notification');
      loadNotifications();
    }
  }

// Load notifications via AJAX
function loadNotifications() {
        $('.load_more_li').addClass('hide');
        var this_link = $(this);
        var href = '/load-more-notifications?page=1';
        $('span.notifications_count').html(__fa_awesome());
        $.ajax({
            url: href,
            dataType: 'html',
            success: function(result) {
                $('.notification-li').remove();
                $('#notifications_list').prepend(result);
                $('span.notifications_count').text('');
                $('.load_more_li').removeClass('hide');
            },
        });
}

// Table dropdown option
let tableSubMenu = document.getElementById("tableSubMenu");

function tabletoggleMenu(event) {
  event.stopPropagation();
  if (tableSubMenu.classList.contains('open-table-menu')) {
    tableSubMenu.classList.remove('open-table-menu');
  } else {
    closeAllMenus();
    tableSubMenu.classList.add('open-table-menu');
  }
}

// Topbar Submenu
let subMenu = document.getElementById("subMenu");

function toggleMenu(event) {
  event.stopPropagation();
  if (subMenu.classList.contains('open-menu')) {
    subMenu.classList.remove('open-menu');
  } else {
    closeAllMenus();
    subMenu.classList.add('open-menu');
  }
}

// Topbar quick
let homeSubMenu = document.getElementById("homeSubMenu");

function toggleHomeMenu(event) {
  event.stopPropagation();
  if (homeSubMenu.classList.contains('open-menu')) {
    homeSubMenu.classList.remove('open-menu');
  } else {
    closeAllMenus();
    homeSubMenu.classList.add('open-menu');
  }
}

document.addEventListener('DOMContentLoaded', function() {
  document.addEventListener('click', function() {
    closeAllMenus();
  });




  // Submenu Slide
  let currentScrollPosition = 0;
  let scrollAmount = 150;
  const sCont = document.querySelector(".storys-container");
  const hScroll = document.querySelector(".horizontal-scroll");
  const btnScrollLeft = document.querySelector("#btn-scroll-left");
  const btnScrollRight = document.querySelector("#btn-scroll-right");

  if (btnScrollLeft) {
    btnScrollLeft.style.opacity = "0";
  }

  if (sCont && hScroll) {
    let maxScroll = -sCont.offsetWidth + hScroll.offsetWidth;

    function scrollHorizontally(val) {
      currentScrollPosition += (val * scrollAmount);

      if (currentScrollPosition >= 0) {
        currentScrollPosition = 0;
        if (btnScrollLeft) btnScrollLeft.style.opacity = "0";
      } else {
        if (btnScrollLeft) btnScrollLeft.style.opacity = "1";
      }

      if (currentScrollPosition <= maxScroll) {
        currentScrollPosition = maxScroll;
        if (btnScrollRight) btnScrollRight.style.opacity = "0";
      } else {
        if (btnScrollRight) btnScrollRight.style.opacity = "1";
      }

      sCont.style.left = currentScrollPosition + "px";
    }
  }

  const invoiceDropdownBtn = document.getElementById("invoice-btn");
  const invoiceDropdownMenu = document.getElementById("invoice-dropdown");

  if (invoiceDropdownBtn && invoiceDropdownMenu) {
    const toggleDropdown = function() {
      invoiceDropdownMenu.classList.toggle("show");
    };

    invoiceDropdownBtn.addEventListener("click", function(event) {
      event.stopPropagation();
      toggleDropdown();
    });

    document.documentElement.addEventListener("click", function() {
      if (invoiceDropdownMenu.classList.contains("show")) {
        toggleDropdown();
      }
    });
  }

  function addReminderToggle() {
    const reminderForm = document.getElementById("reminder-form");
    if (reminderForm) {
      reminderForm.classList.toggle("show-reminder-form");
    }
  }
  
  let switchBtn = document.getElementById('switchBtn');

  // accordion
  const accordionTitles = document.querySelectorAll(".accordionTitle");

  accordionTitles.forEach((accordionTitle) => {
    accordionTitle.addEventListener("click", function(event) {
      event.stopPropagation();
      if (accordionTitle.classList.contains("is-open")) {
        accordionTitle.classList.remove("is-open");
      } else {
        const accordionTitlesWithIsOpen = document.querySelectorAll(".is-open");
        accordionTitlesWithIsOpen.forEach((accordionTitleWithIsOpen) => {
          accordionTitleWithIsOpen.classList.remove("is-open");
        });
        accordionTitle.classList.add("is-open");
      }
    });
  });

  // Modal
  let modalBtn = document.querySelector('.add-user-modal-btn');
  let modalBg = document.querySelector('.add-user-modal-bg');
  let modalClose = document.querySelector('.add-user-modal-close');

  if (modalBtn && modalBg && modalClose) {
    modalBtn.addEventListener('click', function(event) {
      event.stopPropagation();
      modalBg.classList.add('add-user-bg-active');
    });

    modalClose.addEventListener('click', function(event) {
      event.stopPropagation();
      modalBg.classList.remove('add-user-bg-active');
    });
  }

  // Filter Modal
  let filterModalBtn = document.querySelector('.filter-modal-btn');
  let filterModalBG = document.querySelector('.filter-modal-bg');
  let filterModalClose = document.querySelector('.filter-modal-close');

  if (filterModalBtn && filterModalBG && filterModalClose) {
    filterModalBtn.addEventListener('click', function(event) {
      event.stopPropagation();
      filterModalBG.classList.add('filter-modal-bg-active');
    });

    filterModalClose.addEventListener('click', function(event) {
      event.stopPropagation();
      filterModalBG.classList.remove('filter-modal-bg-active');
    });
  }

  // Switch Profit Button
  function leftClick() {
    if (switchBtn) {
      switchBtn.style.left = '0';
    }
  }

  function rightClick() {
    if (switchBtn) {
      switchBtn.style.left = '137px';
    }
  }

  // Fort Modal
  let fortModalBtn = document.getElementById("fort-modal-btn");
  let fortModal = document.querySelector(".fort-modal");
  let fortCloseBtn = document.querySelector(".fort-close-btn");

  if (fortModalBtn && fortModal && fortCloseBtn) {
    fortModalBtn.onclick = function() {
      fortModal.style.display = "block";
    }
    fortCloseBtn.onclick = function() {
      fortModal.style.display = "none";
    }
    window.onclick = function(e) {
      if (e.target == fortModal) {
        fortModal.style.display = "none";
      }
    }
  }

  // product dropdown
  const dropdownBtn = document.getElementById("btnCustom");
  const dropdownMenu = document.getElementById("dropdownCustom");

  if (dropdownBtn && dropdownMenu) {
    const toggleProductDropdown = function() {
      dropdownMenu.classList.toggle("show");
    };

    dropdownBtn.addEventListener("click", function(e) {
      e.stopPropagation();
      toggleProductDropdown();
    });

    document.documentElement.addEventListener("click", function() {
      if (dropdownMenu.classList.contains("show")) {
        toggleProductDropdown();
      }
    });
  }
});

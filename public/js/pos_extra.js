//Code Related to Currency Exchange Rate Module:
document.addEventListener('DOMContentLoaded', function() {
    const exchangeRateSelect = document.getElementById('exchange_rate_id');
    const exchangeRateInput = document.getElementById('currency_exchange_rate');

    // Check if the elements exist
    if (exchangeRateSelect && exchangeRateInput) {
        exchangeRateSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const exchangeRate = selectedOption.getAttribute('data-rate');
            if (exchangeRate) {
                exchangeRateInput.value = exchangeRate;
            } else {
                exchangeRateInput.value = ''; 
                updateCurrencyValues();
            }
        });
        exchangeRateSelect.dispatchEvent(new Event('change'));
    } else {
        //
    }
});

function adjustTbodyScrollHeight() {
    var footerHeight = document.querySelector('.pos-form-actions') ? document.querySelector('.pos-form-actions').offsetHeight : 0;
    var tbodyScroll = document.querySelector('.tbody-scroll');
    var headerHeight = document.querySelector('.pos-header') ? document.querySelector('.pos-header').offsetHeight : 0;
    var pos_heading = document.querySelector('.pos-heading') ? document.querySelector('.pos-heading').offsetHeight : 0;

    var isMobile = window.innerWidth <= 768;
    var additionalHeight = isMobile ? 90 : 100;

    if (tbodyScroll) {
        // Adjust tbody-scroll height
        tbodyScroll.style.height = 'calc(100vh - ' + (footerHeight + headerHeight + pos_heading + additionalHeight) + 'px)';
        
        if (document.body.classList.contains('repair-sub-type')) {
            var posWrapper = document.querySelector('.pos-wrapper');
            if (posWrapper) {
                posWrapper.style.minHeight = document.body.scrollHeight + 'px';
            }
        }
    }
}

function setupMutationObserver() {
    var targetNode = document.body;
    if (targetNode) {
        var observer = new MutationObserver(function(mutationsList, observer) {
            mutationsList.forEach(function(mutation) {
                if (mutation.type === 'childList') {
                    if (mutation.addedNodes.length > 0) {
                        adjustTbodyScrollHeight();
                    }
                }
            });
        });

        var config = { childList: true, subtree: true };
        observer.observe(targetNode, config);
    }
}

window.addEventListener('load', function() {
    adjustTbodyScrollHeight();
    setupMutationObserver();
    window.addEventListener('resize', adjustTbodyScrollHeight);
});

if (window.location.href.includes('/pos/create?sub_type=repair')) {
    document.body.classList.add('repair-sub-type');
  }
  
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.main-category-div').forEach((category) => {
        category.addEventListener('mouseenter', function () {
            const subCategoryDropdown = category.querySelector('.sub-category-dropdown');

            if (subCategoryDropdown) {
                const categoryRect = category.getBoundingClientRect();
                const windowWidth = window.innerWidth;

                if (windowWidth - categoryRect.right > subCategoryDropdown.offsetWidth) {
                    subCategoryDropdown.style.left = `${categoryRect.width}px`; 
                    subCategoryDropdown.style.right = 'auto';
                } else {
                    subCategoryDropdown.style.right = `${categoryRect.width}px`;
                    subCategoryDropdown.style.left = 'auto';
                }
                subCategoryDropdown.style.display = 'block';
            }
        });

        category.addEventListener('mouseleave', function () {
            const subCategoryDropdown = category.querySelector('.sub-category-dropdown');
            if (subCategoryDropdown) {
                subCategoryDropdown.style.display = 'none';
            }
        });
    });

    const categoryDrawerToggle = document.getElementById('category-drawer-toggle');
    const brandDrawerToggle = document.getElementById('brand-drawer-toggle');
    const categoryDrawer = document.getElementById('category-drawer');
    const brandDrawer = document.getElementById('brand-drawer');
    document.addEventListener('click', function (event) {
        if (categoryDrawerToggle.checked && !categoryDrawer.contains(event.target) && event.target.id !== 'category-drawer-toggle') {
            categoryDrawerToggle.checked = false;
        }
        if (brandDrawerToggle.checked && !brandDrawer.contains(event.target) && event.target.id !== 'brand-drawer-toggle') {
            brandDrawerToggle.checked = false;
        }
    });
});

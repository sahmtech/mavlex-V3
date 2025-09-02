

window.POS_InstantCache = {
    products: {},
    brands: {},
    taxes: {},
    sub_units: {},
    settings: {},
    business: {},
    permissions: {},
    common_settings: {},
    enabled_modules: [],
    group_prices: {},
    lot_numbers: {},
    waiters: {},
    warranties: {},
    initialized: false,

    initialize: function(locationId) {
        if (this.initialized) return Promise.resolve();

        if (!window.POS_APP_SETTINGS || !window.POS_APP_SETTINGS.enable_instant_pos) {
            return Promise.resolve();
        }

        this.showLoadingIndicator();
        this.disablePosInterface();
        
        const requestData = { location_id: locationId };
        
        if (window.POS_APP_SETTINGS && window.POS_APP_SETTINGS.pos_max_cached_products && window.POS_APP_SETTINGS.pos_max_cached_products > 0) {
            requestData.limit = window.POS_APP_SETTINGS.pos_max_cached_products;
        }
        
        return $.ajax({
            url: '/sells/pos/get-product-data-for-instant-row',
            method: 'GET',
            data: requestData,
            dataType: 'json'
        }).done((response) => {
            this.products = response.products || {};
            this.brands = response.brands || {};
            this.taxes = response.taxes || {};
            this.sub_units = response.sub_units || {};
            this.settings = response.pos_settings || {};
            this.business = response.business_details || {};
            this.permissions = response.permissions || {};
            this.common_settings = response.common_settings || {};
            this.enabled_modules = response.enabled_modules || [];
            this.allowed_group_prices = response.allowed_group_prices || [];
            this.group_prices = response.group_prices || {};
            this.lot_numbers = response.lot_numbers || {};
            this.waiters = response.waiters || {};
            this.warranties = response.warranties || {};
            this.initialized = true;
            this.hideLoadingIndicator();
            this.enablePosInterface();
        }).fail((xhr) => {
            this.hideLoadingIndicator();
            this.enablePosInterface();
            this.showErrorMessage(window.POS_APP_SETTINGS?.messages?.failed_to_load_cache || 'Failed to load product cache. POS functionality may be limited.');
        });
    },

    getProduct: function(variationId) {
        return this.products[variationId] || null;
    },

    getGroupPrice: function(variationId, priceGroupId) {
        if (this.group_prices[variationId] && this.group_prices[variationId][priceGroupId]) {
            return this.group_prices[variationId][priceGroupId].price_inc_tax;
        }
        return null;
    },

    getCurrentPriceGroup: function() {
        const priceGroupSelect = $('#price_group');
        if (priceGroupSelect.length && priceGroupSelect.val()) {
            return priceGroupSelect.val();
        }
        return null;
    },

    getLotNumbers: function(variationId) {
        return this.lot_numbers[variationId] || [];
    },

    searchProducts: function(term, searchFields = ['name', 'sku']) {
        if (!term || term.length < 2) return [];
        
        const searchTerm = term.toLowerCase();
        const results = [];
        
        Object.values(this.products).forEach(product => {
            let matches = false;
            
            if (searchFields.includes('name') && product.product_name.toLowerCase().includes(searchTerm)) {
                matches = true;
            }
            
            if (searchFields.includes('sku') && product.sub_sku.toLowerCase().includes(searchTerm)) {
                matches = true;
            }
            
            if (matches) {
                const brandName = product.brand_id && this.brands[product.brand_id] ? this.brands[product.brand_id] : '';
                const productName = product.product_name + (brandName ? ' ' + brandName : '');
                
                let selling_price = parseFloat(product.sell_price_inc_tax || product.default_sell_price);
                
                const currentPriceGroup = this.getCurrentPriceGroup();
                let variation_group_price = null;
                if (currentPriceGroup) {
                    variation_group_price = this.getGroupPrice(product.variation_id, currentPriceGroup);
                }
                
                results.push({
                    variation_id: product.variation_id,
                    name: productName,
                    type: product.product_type === 'single' ? 'single' : 'variable',
                    variation: product.variation_name !== 'DUMMY' ? product.variation_name : '',
                    sub_sku: product.sub_sku,
                    selling_price: selling_price,
                    variation_group_price: variation_group_price,
                    enable_stock: product.enable_stock,
                    qty_available: product.qty_available === null ? 999999 : parseFloat(product.qty_available || 0),
                    unit: product.unit,
                    purchase_line_id: null,
                    lot_number: null
                });
            }
        });
        
        results.sort((a, b) => {
            const aExact = a.name.toLowerCase().startsWith(searchTerm) || a.sub_sku.toLowerCase().startsWith(searchTerm);
            const bExact = b.name.toLowerCase().startsWith(searchTerm) || b.sub_sku.toLowerCase().startsWith(searchTerm);
            
            if (aExact && !bExact) return -1;
            if (!aExact && bExact) return 1;
            return a.name.localeCompare(b.name);
        });
        
        return results.slice(0, 20); 
    },

    refreshCache: function(locationId) {
        this.showRefreshIndicator();
        
        const requestData = { location_id: locationId };
        
        if (window.POS_APP_SETTINGS && window.POS_APP_SETTINGS.pos_max_cached_products && window.POS_APP_SETTINGS.pos_max_cached_products > 0) {
            requestData.limit = window.POS_APP_SETTINGS.pos_max_cached_products;
        }
        
        return $.ajax({
            url: '/sells/pos/get-product-data-for-instant-row',
            method: 'GET',
            data: requestData,
            dataType: 'json'
        }).done((response) => {
            this.products = response.products || {};
            this.brands = response.brands || {};
            this.taxes = response.taxes || {};
            this.sub_units = response.sub_units || {};
            this.settings = response.pos_settings || {};
            this.business = response.business_details || {};
            this.permissions = response.permissions || {};
            this.common_settings = response.common_settings || {};
            this.enabled_modules = response.enabled_modules || [];
            this.allowed_group_prices = response.allowed_group_prices || [];
            this.group_prices = response.group_prices || {};
            this.lot_numbers = response.lot_numbers || {};
            
            this.hideRefreshIndicator();
        }).fail((xhr) => {
            this.hideRefreshIndicator();
        });
    },

    forceRefresh: function() {
        const locationId = $('input#location_id').val();
        if (locationId) {
            if (!window.pos_restoring_customer) {
                reset_pos_form();
            } else {
            }
            return this.refreshCache(locationId);
            
        } else {
            return Promise.reject('No location ID');
        }
    },

    showLoadingIndicator: function() {
        this.hideLoadingIndicator();
        
        const loadingHtml = `
            <div id="pos-cache-loader" style="
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.7);
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 18px;
            ">
                <div style="text-align: center;">
                    <div style="margin-bottom: 20px;">
                        <i class="fa fa-spinner fa-spin fa-3x"></i>
                    </div>
                    <div>${window.POS_APP_SETTINGS?.messages?.loading_products || 'Loading Products...'}</div>
                    <div style="font-size: 14px; margin-top: 10px; opacity: 0.8;">
                        ${window.POS_APP_SETTINGS?.messages?.please_wait_while_products_load || 'Please wait while products load'}
                    </div>
                </div>
            </div>
        `;
        
        $('body').append(loadingHtml);
    },

    hideLoadingIndicator: function() {
        $('#pos-cache-loader').remove();
    },

    disablePosInterface: function() {
        $('#search_product').prop('disabled', true);
        
        $('.pos-processing, .pos-controls, .btn').not('#pos-cache-loader *').prop('disabled', true);
    },

    enablePosInterface: function() {
        $('#search_product').prop('disabled', false);
        
        $('.pos-processing, .pos-controls, .btn').prop('disabled', false);
    },

    showErrorMessage: function(message) {
        if (typeof toastr !== 'undefined') {
            toastr.error(message);
        } else {
            alert(message);
        }
    },

    showRefreshIndicator: function() {
        this.hideRefreshIndicator();
        
        const refreshHtml = `
            <div id="pos-cache-refresh" style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: var(--primary-color);
                color: white;
                padding: 10px 15px;
                border-radius: 5px;
                z-index: 1000;
                font-size: 14px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            ">
                <i class="fa fa-refresh fa-spin"></i> ${window.POS_APP_SETTINGS?.messages?.updating_stock || 'Updating stock...'}
            </div>
        `;
        
        $('body').append(refreshHtml);
    },

    hideRefreshIndicator: function() {
        $('#pos-cache-refresh').fadeOut(300, function() {
            $(this).remove();
        });
    }
};
function clearCart() {
    let cart = $('.cart-details'); 
    cart.empty(); 
    cart.append(`<div>${LANG.no_items_in_cart}</div>`);
}
function reset_pos_form(){
   
    

	if($('form#edit_pos_sell_form').length > 0){
		setTimeout(function() {
			window.location = $("input#pos_redirect_url").val();
		}, 4000);
		return true;
	}
	
    if ($("#repair_defects").length > 0) {
        tagify_repair_defects.removeAllTags();
    }

	if(pos_form_obj[0]){
		pos_form_obj[0].reset();
	}
	if(sell_form[0]){
		sell_form[0].reset();
	}
	
	
	if (!window.pos_customer_selection_triggered_reset) {
		set_default_customer();
	} else {
		window.pos_customer_selection_triggered_reset = false;
	}
	set_location();

	$('tr.product_row').remove();
	$('span.total_quantity, span.price_total, span#total_discount, span#order_tax, span#total_payable, span#shipping_charges_amount').text(0);
	$('span.total_payable_span', 'span.total_paying', 'span.balance_due').text(0);

	$('#modal_payment').find('.remove_payment_row').each( function(){
		$(this).closest('.payment_row').remove();
	});

    if ($('#is_credit_sale').length) {
        $('#is_credit_sale').val(0);
    }

	__write_number($('input#discount_amount'), $('input#discount_amount').data('default'));
	$('input#discount_type').val($('input#discount_type').data('default'));

	$('input#tax_rate_id').val($('input#tax_rate_id').data('default'));
	__write_number($('input#tax_calculation_amount'), $('input#tax_calculation_amount').data('default'));

	$('select.payment_types_dropdown').val('cash').trigger('change');
    $('#price_group').trigger('change.reset_form');
	
	if (window.pos_selected_customer_data && !window.pos_ajax_triggered_reset) {
		var customerData = window.pos_selected_customer_data;
		
		window.pos_customer_restoration_in_progress = true;
		
		var $customerSelect = $('#customer_id');
		if ($customerSelect.find('option[value="' + customerData.id + '"]').length === 0) {
			$customerSelect.append(new Option(customerData.text, customerData.id, false, false));
		}
		$customerSelect.val(customerData.id).trigger('change.select2');
		
		$('#advance_balance_text').text(__currency_trans_from_en(customerData.balance || 0), true);
		$('#advance_balance').val(customerData.balance || 0);
		
		if (customerData.price_calculation_type == 'selling_price_group') {
			$('#price_group').val(customerData.selling_price_group_id);
			$('input#hidden_price_group').val(customerData.selling_price_group_id);
			$('#price_group').trigger('change.select2');
		} else if (customerData.price_calculation_type == 'percentage') {
			$('#price_group').val('0');
			$('input#hidden_price_group').val('0');
			$('#price_group').trigger('change.select2');
			window.pos_customer_group_discount = Math.abs(parseFloat(customerData.discount_percent)) || 0;
		}
		
		
		setTimeout(function() {
			window.pos_customer_restoration_in_progress = false;
		}, 100);
	} else if (window.pos_ajax_triggered_reset) {
		window.pos_customer_group_discount = 0;
		window.pos_selected_customer_data = null;
		window.pos_ajax_triggered_reset = false;
	}

	__write_number($('input#shipping_charges'), $('input#shipping_charges').data('default'));
	$('input#shipping_details').val($('input#shipping_details').data('default'));
    $('input#shipping_address, input#shipping_status, input#delivered_to', 'input#delivery_person', 'input#delivery_person_modal').val('');
	if($('input#is_recurring').length > 0){
		$('input#is_recurring').iCheck('update');
	};
    if($('#invoice_layout_id').length > 0){
        $('#invoice_layout_id').trigger('change');
    };
    $('span#round_off_text').text(0);

    if ($('#repair_device_id').length > 0) {
        $('#repair_device_id').val('').trigger('change');
    }

    if ($('#status').length > 0 && $('#status').is(":visible")) {
        $('#status').val('').trigger('change');
    }
    if ($('#transaction_date').length > 0) {
        $('#transaction_date').data("DateTimePicker").date(moment());
    }
    if ($('.paid_on').length > 0) {
        $('.paid_on').data("DateTimePicker").date(moment());
    }
    if ($('#commission_agent').length > 0) {
        $('#commission_agent').val('').trigger('change');
    } 

    $('.contact_due_text').find('span').text('');
    $('.contact_due_text').addClass('hide');

    $(document).trigger('sell_form_reset');


    localStorage.removeItem('posData');
    localStorage.setItem('posDataCleared', 'true');
    clearCart();
}
window.POS_FormatHelpers = {
    formatCurrency: function(amount) {
        const symbol = POS_InstantCache.business.currency_symbol || '$';
        const precision = parseInt($('#__precision').val()) || 2;
        return symbol + parseFloat(amount).toFixed(precision);
    },
    
    formatQuantity: function(qty) {
        const precision = parseInt($('#__quantity_precision').val()) || 2;
        return parseFloat(qty).toFixed(precision);
    }
};

window.POS_RowGenerator = {
    
    asset: function(path) {
        return window.location.origin + path;
    },
    
    num_format: function(number, decimals = 2) {
        return parseFloat(number || 0).toFixed(decimals);
    },
    
    format_quantity: function(quantity) {
        const precision = parseInt($('#__quantity_precision').val()) || 2;
        return parseFloat(quantity || 0).toFixed(precision);
    },
    
    format_currency: function(amount) {
        const symbol = POS_InstantCache.business.currency_symbol || '$';
        const precision = POS_InstantCache.business.currency_precision || 2;
        return symbol + parseFloat(amount || 0).toFixed(precision);
    },
    
    lang: function(key) {
        if (typeof window.POS_TRANSLATIONS === 'object' && window.POS_TRANSLATIONS !== null) {
            const keyMappings = {
                'lang_v1.pos_edit_product_price_help': 'pos_edit_product_price_help',
                'lang_v1.in_stock': 'in_stock',
                'lang_v1.item_out_of_stock': 'item_out_of_stock',
                'lang_v1.decimal_value_not_allowed': 'decimal_value_not_allowed',
                'validation.custom-messages.this_field_is_required': 'this_field_is_required',
                'validation.custom-messages.quantity_not_available': 'quantity_not_available',
                'lang_v1.quantity_error_msg_in_lot': 'quantity_error_msg_in_lot',
                'lang_v1.lot_n_expiry': 'lot_n_expiry',
                'product.exp_date': 'exp_date',
                'report.expired': 'expired',
                'lang_v1.sell_line_description_help': 'sell_line_description_help',
                'restaurant.select_service_staff': 'select_service_staff',
                'lang_v1.prev_unit_price': 'prev_unit_price',
                'lang_v1.prev_discount': 'prev_discount',
                'lang_v1.fixed': 'fixed',
                'lang_v1.percentage': 'percentage',
                'lang_v1.applied_discount_text': 'applied_discount_text',
                'messages.please_select': 'please_select',
                'lang_v1.quantity_in_second_unit': 'quantity_in_second_unit',
                'lang_v1.minimum_selling_price_error_msg': 'minimum_selling_price_error_msg',
                'sale.unit_price': 'unit_price',
                'sale.discount_type': 'discount_type',
                'sale.discount_amount': 'discount_amount',
                'sale.tax': 'tax',
                'lang_v1.warranty': 'warranty',
                'lang_v1.description': 'description',
                'messages.close': 'close',
                'lang_v1.no_products_found': 'no_products_found',
                'lang_v1.out_of_stock': 'out_of_stock'
            };
            
            const simpleKey = keyMappings[key];
            if (simpleKey && window.POS_TRANSLATIONS.hasOwnProperty(simpleKey)) {
                return window.POS_TRANSLATIONS[simpleKey];
            }
        }
        
        if (typeof window.__trans === 'function') {
            return window.__trans(key);
        }
        
        if (typeof window.LANG === 'object' && window.LANG !== null) {
            const keys = key.split('.');
            let value = window.LANG;
            
            for (let k of keys) {
                if (value && typeof value === 'object' && value.hasOwnProperty(k)) {
                    value = value[k];
                } else {
                    value = null;
                    break;
                }
            }
            
            if (value && typeof value === 'string') {
                return value;
            }
        }
        
        return key;
    },
    
    validateProductAddition: function(product, quantity = 1) {
        if (!product) {
            return { valid: false, message: 'Product not found' };
        }

        const isOverselling = POS_InstantCache.settings.allow_overselling == '1';
        const isDraft = $('input#status').length && $('input#status').val() == 'draft';
        const forSo = false; 
        
        let qty_available;
        if (product.qty_available === null) {
            const formatted_qty = parseFloat(product.formatted_qty_available || 0);
            qty_available = formatted_qty > 0 ? Infinity : 0;
        } else {
            qty_available = parseFloat(product.qty_available || 0);
        }
        
        if (qty_available > 0 || isOverselling || forSo || isDraft) {
            return { valid: true };
        } else {
            return { 
                valid: false, 
                message: this.lang('lang_v1.item_out_of_stock')
            };
        }
    },

    generateProductRow: function(variationId, quantity = 1, rowCount = null, options = {}) {
        const product = POS_InstantCache.getProduct(variationId);
        if (!product) {
            return null;
        }
       
        if (!rowCount) {
            rowCount = parseInt($('input#product_row_count').val()) + 1;
        }

        const so_line = options.so_line || null;
        const discount = options.discount || null;
        const is_direct_sell = options.is_direct_sell || ($('input[name="is_direct_sale"]').length > 0 && $('input[name="is_direct_sale"]').val() == 1);
        const is_sales_order = options.is_sales_order || false;
        const action = options.action || '';
        const purchase_line_id = options.purchase_line_id || null;
        const warranties = options.warranties || POS_InstantCache.warranties || {};
        const waiters = options.waiters || POS_InstantCache.waiters || {};
        const last_sell_line = options.last_sell_line || null;
        const combo_products = options.combo_products || product.combo_products || [];
        const common_settings = POS_InstantCache.common_settings;
        
        let multiplier = 1;
        
        const image_url = product.image_url || this.asset('/img/default.png');
        const sub_units = POS_InstantCache.sub_units[product.unit_id] || {};
        Object.keys(sub_units).forEach(key => {
            const value = sub_units[key];
            if (product.sub_unit_id && product.sub_unit_id == key) {
                multiplier = value.multiplier;
            }
        });

        const product_name = product.product_name + (product.brand_id && POS_InstantCache.brands[product.brand_id] ? ' ' + POS_InstantCache.brands[product.brand_id] : '');

        let hide_tax = 'hide';
        if (POS_InstantCache.business.enable_inline_tax) {
            hide_tax = '';
        }
        
        let tax_id = product.tax_id || null;
        let item_tax = 0;
        let unit_price_inc_tax = parseFloat(product.sell_price_inc_tax || product.default_sell_price);
        
        const currentPriceGroup = POS_InstantCache.getCurrentPriceGroup();
        if (currentPriceGroup) {
            const groupPrice = POS_InstantCache.getGroupPrice(product.variation_id, currentPriceGroup);
            if (groupPrice) {
                unit_price_inc_tax = parseFloat(groupPrice);
            }
        }
        
        if (window.pos_customer_group_discount && window.pos_customer_group_discount > 0) {
            const discountAmount = (unit_price_inc_tax * window.pos_customer_group_discount) / 100;
            unit_price_inc_tax = unit_price_inc_tax - discountAmount;
        }

        if (tax_id && POS_InstantCache.taxes && POS_InstantCache.taxes.attributes && POS_InstantCache.taxes.attributes[tax_id]) {
            const tax_rate = parseFloat(POS_InstantCache.taxes.attributes[tax_id]['data-rate'] || 0);
            const default_price = parseFloat(product.default_sell_price || 0);
            item_tax = (default_price * tax_rate) / 100;
        }

        if (hide_tax == 'hide') {
            tax_id = null;
            unit_price_inc_tax = parseFloat(product.default_sell_price || 0);
        }

        if (so_line && action !== 'edit') {
            tax_id = so_line.tax_id;
            item_tax = so_line.item_tax;
            unit_price_inc_tax = so_line.unit_price_inc_tax;
        }

        let discount_type = product.line_discount_type || 'fixed';
        let discount_amount = product.line_discount_amount || 0;
        
        if (discount) {
            discount_type = discount.discount_type;
            discount_amount = discount.discount_amount;
        }

        if (so_line && action !== 'edit') {
            discount_type = so_line.line_discount_type;
            discount_amount = so_line.line_discount_amount;
        }

        let sell_line_note = '';
        if (product.sell_line_note) {
            sell_line_note = product.sell_line_note;
        }
        if (so_line) {
            sell_line_note = so_line.sell_line_note;
        }

        const warranty_id = (action == 'edit' && product.warranties && product.warranties.length > 0) ? product.warranties[0].id : (product.warranty_id || '');

        if (discount_type == 'fixed') {
            discount_amount = discount_amount * multiplier;
        }

        let max_quantity;
        if (product.qty_available === null) {
            const formatted_qty = parseFloat(product.formatted_qty_available || 0);
            max_quantity = formatted_qty > 0 ? 999999 : 0;
        } else {
            max_quantity = parseFloat(product.qty_available || 0);
        }
        let formatted_max_quantity = this.format_quantity(max_quantity);

        if (action == 'edit') {
            if (so_line) {
                const qty_available = so_line.quantity - so_line.so_quantity_invoiced + (product.quantity_ordered || 1);
                max_quantity = qty_available;
                formatted_max_quantity = this.format_quantity(qty_available);
            }
        } else {
            if (so_line && so_line.qty_available <= max_quantity) {
                max_quantity = so_line.qty_available;
                formatted_max_quantity = this.format_quantity(so_line.qty_available);
            }
        }

        let max_qty_rule = max_quantity;
        
        let effective_stock_for_msg = max_quantity;
        if (product.enable_stock == 1 && POS_InstantCache.settings.allow_overselling != '1' && !is_sales_order) {
            effective_stock_for_msg = this.getEffectiveStockForValidation(product);
        }
        
        let max_qty_msg = this.lang('validation.custom-messages.quantity_not_available').replace(':qty', this.format_quantity(effective_stock_for_msg)).replace(':unit', product.unit);

        const quantity_ordered = quantity || 1;

        let allow_decimal = true;
        if (product.unit_allow_decimal != 1) {
            allow_decimal = false;
        }

        Object.keys(sub_units).forEach(key => {
            const value = sub_units[key];
            if (product.sub_unit_id && product.sub_unit_id == key) {
                max_qty_rule = max_qty_rule / multiplier;
                const unit_name = value.name;
                max_qty_msg = this.lang('validation.custom-messages.quantity_not_available').replace(':qty', max_qty_rule).replace(':unit', unit_name);

                if (product.lot_no_line_id) {
                    max_qty_msg = this.lang('lang_v1.quantity_error_msg_in_lot').replace(':qty', max_qty_rule).replace(':unit', unit_name);
                }

                if (value.allow_decimal) {
                    allow_decimal = true;
                }
            }
        });

        let pos_unit_price = product.unit_price_before_discount || product.default_sell_price;
        
        if (currentPriceGroup) {
            const groupPrice = POS_InstantCache.getGroupPrice(product.variation_id, currentPriceGroup);
            if (groupPrice) {
                pos_unit_price = parseFloat(groupPrice);
            }
        }
        
        let final_pos_unit_price = pos_unit_price;
        if (so_line) {
            final_pos_unit_price = so_line.unit_price_before_discount;
        }

        const edit_price = POS_InstantCache.permissions.edit_price;
        const edit_discount = POS_InstantCache.permissions.edit_discount;

        const html = `
            <tr class="product_row" data-row_index="${rowCount}"${so_line ? ` data-so_id="${so_line.transaction_id}"` : ''}>
                <input type="hidden" name="row_id" id="row_${rowCount}" value="${rowCount}">
                <input type="hidden" name="quantity_cd[${rowCount}]" id="quantity_cd" value="${this.format_quantity(quantity_ordered)}">
                
                <td><img src="${image_url}" alt="product-img" loading="lazy" style="height: auto;display: inline;margin-left: 3px; border: black;border-radius: 5px; margin-top: 5px; width: 50px;object-fit: cover;"></td>
                <td style="width: 25%">
                    ${so_line ? `<input type="hidden" name="products[${rowCount}][so_line_id]" value="${so_line.id}">` : ''}
                    
                    <input type="hidden" name="item_name[${rowCount}]" id="item_name" value="${product_name}">

                    ${(edit_price || edit_discount) && !is_direct_sell ? `
                    <div title="${this.lang('lang_v1.pos_edit_product_price_help')}">
                        <span class="text-link text-info cursor-pointer" data-toggle="modal" data-target="#row_edit_product_price_modal_${rowCount}">
                            ${product_name}
                            &nbsp;<i class="fa fa-info-circle"></i>
                        </span>
                    </div>` : product_name}
                    
                    <input type="hidden" class="enable_sr_no" value="${product.enable_sr_no || 0}">
                    <input type="hidden" class="product_type" name="products[${rowCount}][product_type]" value="${product.product_type || 'single'}">

                    <input type="hidden" name="discount_cd[${rowCount}]" id="discount_cd" value="${discount_amount}">
                    ${discount ? `<input type="hidden" name="products[${rowCount}][discount_id]" value="${discount.id}">` : ''}

                    ${!is_direct_sell ? `
                    <div class="modal fade row_edit_product_price_model" id="row_edit_product_price_modal_${rowCount}" tabindex="-1" role="dialog">
                        ${this.generateEditModal(rowCount, product, pos_unit_price, unit_price_inc_tax, discount_type, discount_amount, tax_id, item_tax, sell_line_note, warranty_id, warranties, discount, common_settings)}
                    </div>` : ''}
                    
                    ${this.generateStockInfo(product)}
                    
                    <!-- Description modal end -->
                    <div class="modifiers_html">
                        ${this.generateModifiers(product, rowCount)}
                    </div>
                    <div class="selected_modifiers"></div>
                    
                    ${this.generateComboProducts(combo_products, rowCount)}
                    
                    ${this.generateLotNumbers(product, rowCount, max_qty_rule, max_qty_msg, purchase_line_id)}
                    
                    ${is_direct_sell ? `
                    <br>
                    <textarea class="form-control" name="products[${rowCount}][sell_line_note]" rows="2">${sell_line_note}</textarea>
                    <p class="help-block"><small>${this.lang('lang_v1.sell_line_description_help')}</small></p>` : ''}
                </td>

                <td class="unit-quantity-flex" style="max-width:17%">
                    ${product.transaction_sell_lines_id ? `<input type="hidden" name="products[${rowCount}][transaction_sell_lines_id]" class="form-control" value="${product.transaction_sell_lines_id}">` : ''}

                    <input type="hidden" name="products[${rowCount}][product_id]" class="form-control product_id" value="${product.product_id}">
                    <input type="hidden" value="${product.variation_id}" name="products[${rowCount}][variation_id]" class="row_variation_id">
                    <input type="hidden" value="${product.enable_stock}" name="products[${rowCount}][enable_stock]">

                    <div class="input-group input-number">
                        <span class="input-group-btn"><button type="button" class="btn btn-default btn-flat quantity-down"><i class="fa fa-minus text-danger"></i></button></span>
                        <input type="text" data-min="1"
                            class="form-control pos_quantity input_number mousetrap input_quantity width-100"
                            value="${this.format_quantity(quantity_ordered)}" 
                            name="products[${rowCount}][quantity]" 
                            data-allow-overselling="${POS_InstantCache.settings.allow_overselling == '1' ? 'true' : 'false'}"
                            ${allow_decimal ? 'data-decimal="1"' : 'data-decimal="0" data-rule-abs_digit="true" data-msg-abs_digit="' + this.lang('lang_v1.decimal_value_not_allowed') + '"'}
                            data-rule-required="true"
                            data-msg-required="${this.lang('validation.custom-messages.this_field_is_required')}"
                            ${product.enable_stock == 1 && POS_InstantCache.settings.allow_overselling != '1' && !is_sales_order ? `data-rule-max-value="${this.getEffectiveStockForValidation(product)}" data-qty_available="${product.original_qty_available || product.qty_available}" data-msg-max-value="${max_qty_msg}" data-msg_max_default="${max_qty_msg}"` : ''}>
                        <span class="input-group-btn"><button type="button" class="btn btn-default btn-flat quantity-up"><i class="fa fa-plus text-success"></i></button></span>
                    </div>

                    <input type="hidden" name="products[${rowCount}][product_unit_id]" value="${product.unit_id}">
                    ${this.generateUnitSelect(sub_units, product, rowCount)}

                    ${product.second_unit ? `
                    <br>
                    <span style="white-space: nowrap;">
                        ${this.lang('lang_v1.quantity_in_second_unit').replace('{unit}', product.second_unit)}*:</span><br>
                    <input type="text"
                        name="products[${rowCount}][secondary_unit_quantity]"
                        value="${this.format_quantity(product.secondary_unit_quantity || 0)}"
                        class="form-control input-sm input_number"
                        required>` : ''}

                    <input type="hidden" class="base_unit_multiplier" name="products[${rowCount}][base_unit_multiplier]" value="${multiplier}">
                    <input type="hidden" class="hidden_base_unit_sell_price" value="${product.default_sell_price / multiplier}">

                    ${this.generateComboHiddenFields(product, rowCount, action)}
                </td>
                
                ${this.generateDirectSellColumns(is_direct_sell, waiters, rowCount, product, final_pos_unit_price, last_sell_line, edit_price, edit_discount, discount_amount, discount_type, discount, common_settings, warranties, warranty_id)}
                
                ${this.generateNonDirectSellColumns(is_direct_sell, waiters, rowCount, product, hide_tax, item_tax, unit_price_inc_tax, edit_price, common_settings, warranties, warranty_id)}

                <td class="text-center">
                    <input type="${POS_InstantCache.settings.is_pos_subtotal_editable == '1' ? 'text' : 'hidden'}" 
                           style="height: 30px; line-height: 30px;" 
                           class="form-control input-sm pos_line_total${POS_InstantCache.settings.is_pos_subtotal_editable == '1' ? ' input_number' : ''}" 
                           value="${this.num_format(quantity_ordered * unit_price_inc_tax)}">
                    <span class="display_currency pos_line_total_text${POS_InstantCache.settings.is_pos_subtotal_editable == '1' ? ' hide' : ''}" 
                          data-currency_symbol="true">${this.format_currency(quantity_ordered * unit_price_inc_tax)}</span>
                </td>
                <td class="text-center v-center">
                    <i class="fa fa-times text-danger pos_remove_row cursor-pointer" aria-hidden="true"></i>
                </td>
            </tr>`;

        return html;
    },

    getEffectiveStockForValidation: function(product) {
        const lot_numbers = POS_InstantCache.getLotNumbers(product.variation_id);
        const actual_lots = lot_numbers ? lot_numbers.filter(lot => lot.lot_number && lot.lot_number !== null && lot.lot_number.trim() !== '') : [];
        const has_lots = product.has_lots || actual_lots.length > 0;
        
        if ((POS_InstantCache.business.enable_lot_number || POS_InstantCache.business.enable_product_expiry) && has_lots) {
            if (product.has_mixed_stock) {
                const effective_stock = parseFloat(product.original_qty_available !== undefined ? product.original_qty_available : product.qty_available || 0);
                return effective_stock;
            } else {
                const effective_stock = parseFloat(product.original_qty_available !== undefined ? product.original_qty_available : 0);
                return effective_stock;
            }
        } else {
            const effective_stock = parseFloat(product.qty_available || 0);
            return effective_stock;
        }
    },

    generateStockInfo: function(product) {
        if (product.enable_stock == 1) {
            const lot_numbers = POS_InstantCache.getLotNumbers(product.variation_id);
            const actual_lots = lot_numbers ? lot_numbers.filter(lot => lot.lot_number && lot.lot_number !== null && lot.lot_number.trim() !== '') : [];
            const has_lots = product.has_lots || actual_lots.length > 0;
            
            if ((POS_InstantCache.business.enable_lot_number || POS_InstantCache.business.enable_product_expiry) && has_lots) {
                if (product.has_mixed_stock) {
                    qty_available = parseFloat(product.original_qty_available !== undefined ? product.original_qty_available : product.qty_available || 0);
                    
                    let stockText = `${this.format_quantity(qty_available)} ${product.unit}`;
                    
                    if (qty_available > 0) {
                        stockText += ` ${this.lang('lang_v1.in_stock')}`;
                    } else {
                        stockText += ` ${this.lang('lang_v1.item_out_of_stock')}`;
                    }
                    
                    stockText += ` <span class="text-info">(or select lot)</span>`;
                    
                    return `<small class="text-muted p-1 stock-info" data-variation-id="${product.variation_id}">${stockText}</small>`;
                } else {
                    qty_available = parseFloat(product.original_qty_available !== undefined ? product.original_qty_available : 0);
                    
                    let stockText = `${this.format_quantity(qty_available)} ${product.unit}`;
                    
                    if (qty_available > 0) {
                        stockText += ` ${this.lang('lang_v1.in_stock')}`;
                    } else {
                        stockText += ` ${this.lang('lang_v1.item_out_of_stock')}`;
                    }
                    
                    stockText += ` <span class="text-info">Please select lot</span>`;
                    
                    return `<small class="text-muted p-1 stock-info" data-variation-id="${product.variation_id}">${stockText}</small>`;
                }
            } else {
                if (product.qty_available === null) {
                    const formatted_qty = parseFloat(product.formatted_qty_available || 0);
                    qty_available = formatted_qty;
                } else {
                    qty_available = parseFloat(product.qty_available || 0);
                }
                
                let stockText = `${this.format_quantity(qty_available)} ${product.unit}`;
                
                if (qty_available > 0) {
                    stockText += ` ${this.lang('lang_v1.in_stock')}`;
                } else {
                    stockText += ` ${this.lang('lang_v1.item_out_of_stock')}`;
                }
                
                return `<small class="text-muted p-1">${stockText}</small>`;
            }
        } else if (product.manage_stock == 0) {
            return '<small class="text-muted p-1">~</small>';
        }
        return '';
    },

    updateStockDisplay: function(row, selected_lot_id, qty_available, selected_text, product_data, fallback_variation_id) {
        let stock_info = row.find('.stock-info');
        
        if (stock_info.length === 0) {
            const alt_stock = row.find('small.text-muted.p-1');
            if (alt_stock.length > 0) {
                alt_stock.addClass('stock-info');
                stock_info = alt_stock.first();
            } else {
                return;
            }
        }
        
        if (!product_data) {
            return;
        }
        
        let stockText;
        
        if (selected_lot_id && qty_available > 0) {
            stockText = `${this.format_quantity(qty_available)} ${product_data.unit} ${this.lang('lang_v1.in_stock')}`;
            
            const lot_match = selected_text.match(/^(\w+)/);
            const lot_number = lot_match ? lot_match[1] : 'Selected';
            
            stockText += ` <span class="text-info">(Lot ${lot_number}: ${this.format_quantity(qty_available)} total)</span>`;
        } else if (selected_lot_id && qty_available <= 0) {
            stockText = `0.000 ${product_data.unit} ${this.lang('lang_v1.item_out_of_stock')} <span class="text-warning">(Selected lot out of stock)</span>`;
        } else {
            const lot_numbers = POS_InstantCache.getLotNumbers(product_data.variation_id);
            const actual_lots = lot_numbers ? lot_numbers.filter(lot => lot.lot_number && lot.lot_number !== null && lot.lot_number.trim() !== '') : [];
            
            const original_qty = parseFloat(product_data.original_qty_available !== undefined ? product_data.original_qty_available : product_data.qty_available || 0);
            
            
            if (actual_lots.length > 0) {
                if (product_data.has_mixed_stock) {
                    const display_qty = parseFloat(product_data.qty_available || 0);
                    stockText = `${this.format_quantity(display_qty)} ${product_data.unit}`;
                    
                    if (display_qty > 0) {
                        stockText += ` ${this.lang('lang_v1.in_stock')}`;
                    } else {
                        stockText += ` ${this.lang('lang_v1.item_out_of_stock')}`;
                    }
                    
                    stockText += ` <span class="text-info">(or select lot)</span>`;
                } else {
                    stockText = `${this.format_quantity(original_qty)} ${product_data.unit}`;
                    
                    if (original_qty > 0) {
                        stockText += ` ${this.lang('lang_v1.in_stock')}`;
                    } else {
                        stockText += ` ${this.lang('lang_v1.item_out_of_stock')}`;
                    }
                    
                    stockText += ` <span class="text-info">Please select lot</span>`;
                }
            } else {
                stockText = `${this.format_quantity(original_qty)} ${product_data.unit}`;
                
                if (original_qty > 0) {
                    stockText += ` ${this.lang('lang_v1.in_stock')}`;
                } else {
                    stockText += ` ${this.lang('lang_v1.item_out_of_stock')}`;
                }
            }
        }
        
        stock_info.html(stockText);
    },

    generateModifiers: function(product, rowCount) {
        if (!POS_InstantCache.enabled_modules.includes('modifiers') || !product.product_ms || product.product_ms.length === 0) {
            return '';
        }

        const modal_id = `modifier_${rowCount}_${product.variation_id || ''}_${Date.now()}`;
        const modifierId = `modifiers_${rowCount}_${Date.now()}`;
        
        let html = `
            <div class="standard_modifiers">
                <button type="button" class="btn btn-xs btn-default modifiers-toggle-btn" data-toggle="collapse" data-target="#${modifierId}" aria-expanded="false">
                    <i class="fa fa-plus"></i> <span class="modifiers-count">${product.product_ms.length}</span> Modifier Sets
                </button>
                <div class="collapse" id="${modifierId}">
                    <div style="margin: 5px 0; padding: 3px; border-left: 3px solid #ddd;">
                        <span class="selected_modifiers" id="selected_modifiers_${modal_id}">
                            <button type="button" class="btn btn-sm btn-outline-secondary select-modifiers-btn" 
                                    title="Click to select modifiers" data-toggle="modal" data-target="#${modal_id}">
                                <i class="fa fa-plus-circle"></i> Add Modifiers
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="modal fade modifier_modal" id="${modal_id}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Modifiers for product: <span class="text-success">${product.product_name}</span></h4>
                        </div>
                        
                        <div class="modal-body">
                            <div class="panel-group" id="accordion${modal_id}" role="tablist" aria-multiselectable="true">
        `;

        product.product_ms.forEach((modifier_set, setIndex) => {
            const collapse_id = `collapse${modifier_set.id}_${modal_id}`;
            const isFirstSet = setIndex === 0;
            
            html += `
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion${modal_id}" 
                               href="#${collapse_id}" aria-expanded="${isFirstSet}" aria-controls="${collapse_id}">
                                ${modifier_set.name}
                            </a>
                        </h4>
                    </div>
                    
                    <div id="${collapse_id}" class="panel-collapse collapse ${isFirstSet ? 'in' : ''}" 
                         role="tabpanel">
                        <div class="panel-body">
                            <div class="btn-group" data-toggle="buttons">
            `;
            
            if (modifier_set.variations && modifier_set.variations.length > 0) {
                modifier_set.variations.forEach(modifier => {
                    const modifier_price = parseFloat(modifier.sell_price_inc_tax || modifier.default_sell_price || modifier.price || 0);
                    
                    html += `
                        <label class="btn btn-outline-primary modifier-btn" data-modifier-id="${modifier.id}">
                            <input type="checkbox" autocomplete="off" value="${modifier.id}" data-price="${modifier_price}" data-modifier-set-id="${modifier_set.id}" style="display: none;"> 
                            <i class="fa fa-square-o modifier-icon"></i>
                            ${modifier.name}
                        </label>
                    `;
                });
            }
            
            html += `
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        html += `
                            </div>
                        </div>
                        
                        <input type="hidden" class="modifiers_exist" value="true">
                        <input type="hidden" class="index" value="${rowCount}">
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary add_modifier" data-dismiss="modal">
                                <i class="fa fa-check"></i> Add Selected
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <i class="fa fa-times"></i> Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <style>
                .modifier-btn {
                    margin: 2px;
                    transition: all 0.3s ease;
                    border: 2px solid #007bff;
                }
                .modifier-btn:hover {
                    transform: scale(1.05);
                    box-shadow: 0 2px 8px rgba(0,123,255,0.3);
                }
                .modifier-btn.btn-success {
                    background-color: #28a745;
                    border-color: #28a745;
                    color: white;
                }
                .modifier-btn .modifier-icon {
                    margin-right: 5px;
                }
            </style>
        `;

        return html;
    },

    generateModifierModal: function(combo_product, modal_id, rowCount, combo_index, instance_index) {
        
        const modifier_data = combo_product.modifier_sets || combo_product.modifiers || [];
        
        if (!POS_InstantCache.enabled_modules.includes('modifiers') || !modifier_data || modifier_data.length === 0) {
            return '';
        }

        let html = `<div class="modal fade modifier_modal" id="${modal_id}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Modifiers for product: <span class="text-success">${combo_product.product_name}</span></h4>
                        </div>
                        
                        <div class="modal-body">
                            <div class="panel-group" id="accordion${modal_id}" role="tablist" aria-multiselectable="true">`;

        modifier_data.forEach((modifier_set, setIndex) => {
            const collapse_id = `collapse${modifier_set.id}${modal_id}`;
            const isFirstSet = setIndex === 0;
            
            html += `
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion${modal_id}" 
                               href="#${collapse_id}" aria-expanded="true" aria-controls="collapseOne">
                                ${modifier_set.name}
                            </a>
                        </h4>
                    </div>
                    <input type="hidden" class="modifiers_exist" value="true">
                    <input type="hidden" class="index" value="${rowCount}">
                    <input type="hidden" class="combo_index" value="${combo_index}">
                    <input type="hidden" class="instance_index" value="${instance_index}">
                    
                    <div id="${collapse_id}" class="panel-collapse collapse ${isFirstSet ? 'in' : ''}" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="btn-group" data-toggle="buttons">`;
            
            const variations = modifier_set.variations || [];
            
            if (variations && variations.length > 0) {
                variations.forEach(modifier => {
                    const modifier_price = parseFloat(modifier.sell_price_inc_tax || modifier.default_sell_price || modifier.price || 0);
                    
                    html += `
                        <label class="btn btn-outline-primary modifier-btn" data-modifier-id="${modifier.id}">
                            <input type="checkbox" autocomplete="off" value="${modifier.id}" data-combo-id="${combo_product.variation_id}" data-price="${modifier_price}" data-modifier-set-id="${modifier_set.id}"> 
                            <i class="fa fa-square-o modifier-icon"></i>
                            ${modifier.name}
                        </label>`;
                });
            } else {
                html += `<p>No modifiers available for this set</p>`;
            }
            
            html += `
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        html += `
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary add_modifier" data-dismiss="modal">
                                Add
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        html += `
            <script type="text/javascript">
            if( typeof $ !== 'undefined'){
                if (typeof window.modalCounter === 'undefined') {
                    window.modalCounter = 0;
                }
                window.modalCounter++;
                
                var delayTime = window.modalCounter * 500; 
                
                setTimeout(function(){
                    var modalElement = $('#${modal_id}');
                    
                    if (modalElement.length > 0) {
                        var existingModifiers = $('#selected_modifiers_${modal_id}').find('input[name$="[modifier][]"]').map(function() {
                            return $(this).val();
                        }).get();
                        
                        
                        existingModifiers.forEach(function(modifierId) {
                            var checkbox = modalElement.find('input[value="' + modifierId + '"]');
                            var label = checkbox.closest('.modifier-btn');
                            var icon = label.find('.modifier-icon');
                            
                            if (checkbox.length > 0) {
                                checkbox.prop('checked', true);
                                label.removeClass('btn-outline-primary').addClass('btn-success');
                                icon.removeClass('fa-square-o').addClass('fa-check-square');
                            }
                        });
                        
                        if (modalElement.parent().prop('tagName') !== 'BODY') {
                            modalElement.appendTo('body');
                        }
                        
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        
                        modalElement.modal({
                            backdrop: true,
                            keyboard: true,
                            show: true
                        });
                    } else {
                    }
                }, delayTime);
            }
            
            $('#${modal_id}').on('hidden.bs.modal', function() {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            });
            
            $('#${modal_id}').on('click', '.modifier-btn', function(e) {
                e.preventDefault();
                var label = $(this);
                var checkbox = label.find('input[type="checkbox"]');
                var icon = label.find('.modifier-icon');
                
                checkbox.prop('checked', !checkbox.prop('checked'));
                
                if (checkbox.prop('checked')) {
                    label.removeClass('btn-outline-primary').addClass('btn-success');
                    icon.removeClass('fa-square-o').addClass('fa-check-square');
                } else {
                    label.removeClass('btn-success').addClass('btn-outline-primary');
                    icon.removeClass('fa-check-square').addClass('fa-square-o');
                }
            });
            </script>
            
            <script>
            $(document).ready(function() {
                $('#${modal_id} .add_modifier').click(function() {
                    var modal = $(this).closest('.modal');
                    var row_count = modal.find('.index').val();
                    var combo_index = modal.find('.combo_index').val();
                    var instance_index = modal.find('.instance_index').val();
                    
                    var selected_modifiers = [];

                    modal.find('input[type="checkbox"]:checked').each(function() {
                        selected_modifiers.push($(this).val());
                    });

                    var modifier_html = '';
                    var modifier_set_id = '';
                    
                    selected_modifiers.forEach(function(modifier_id) {
                        var checkbox = modal.find('input[value="' + modifier_id + '"]');
                        var modifier_name = checkbox.closest('label').contents().filter(function() {
                            return this.nodeType === 3;
                        }).text().trim();
                        var modifier_price = parseFloat(checkbox.data('price') || 0);
                        modifier_set_id = checkbox.data('modifier-set-id') || '';
                        
                        modifier_html += \`
                            <div class="product_modifier" style="background: #f8f9fa; border-left: 3px solid #28a745; padding: 5px; margin: 2px 0; border-radius: 3px;">
                                <div class="modifier_name" style="font-weight: bold; color: #28a745;">
                                    <i class="fa fa-check-circle text-success"></i> \${modifier_name}
                                </div>
                                <small class="text-muted">
                                    (<span class="modifier_price_text">\${modifier_price.toFixed(3)}</span> X <span class="modifier_qty_text">1.000</span>)
                                </small>
                                <input type="hidden" name="products[\${row_count}][modifier][]" value="\${modifier_id}">
                                <input type="hidden" class="modifiers_price" name="products[\${row_count}][modifier_price][]" value="\${modifier_price.toFixed(3)}">
                                <input type="hidden" class="modifiers_quantity" name="products[\${row_count}][modifier_quantity][]" value="1">
                                <input type="hidden" name="products[\${row_count}][modifier_set_id][]" value="\${modifier_set_id}">
                            </div>
                        \`;
                    });
                    
                    $('#selected_modifiers_${modal_id}').html(modifier_html);
                    
                    var productRow = $('tr[data-row_index="' + row_count + '"]');
                    if (productRow.length > 0) {
                        var quantityInput = productRow.find('.pos_quantity');
                        if (quantityInput.length > 0) {
                            quantityInput.trigger('change');
                        }
                    }
                    
                });
            });
            </script>
        `;
        
        return html;
    },

    generateComboProducts: function(combo_products, rowCount) {
        if (!combo_products || combo_products.length === 0) return '';
        
        
        const comboId = `combo_${rowCount}_${Date.now()}`;
        let html = `
            <div class="combo_modifiers">
                <button type="button" class="btn btn-xs btn-default combo-toggle-btn" data-toggle="collapse" data-target="#${comboId}" aria-expanded="false">
                    <i class="fa fa-plus"></i> <span class="combo-count">${combo_products.length}</span> Combo Items
                </button>
                <div class="collapse" id="${comboId}">
        `;
        
        combo_products.forEach((combo_product, index) => {
            
            const quantity = combo_product.qty_required || combo_product.quantity || 1;
            
            const effectiveQuantity = Math.min(quantity, 3); 
            
            for (let i = 0; i < effectiveQuantity; i++) {
                const instance_index = `${rowCount}_${index}_${i}`;
                const modal_id = `modifier_${instance_index}_${combo_product.variation_id || ''}_${Date.now()}`;

                const hasModifiers = combo_product.modifier_sets && combo_product.modifier_sets.length > 0;
                const productDisplayName = `${combo_product.product_name}${effectiveQuantity > 1 ? ' #' + (i + 1) : ''}`;
                
                html += `<div class="combo-item" style="margin: 5px 0; padding: 3px; border-left: 3px solid #ddd;">`;
                
                if (hasModifiers) {
                    html += `
                        <span class="combo-product-name text-primary cursor-pointer" data-toggle="modal" data-target="#${modal_id}" title="Click to modify">
                            <i class="fa fa-cog text-muted"></i> ${productDisplayName}
                        </span>
                        <br><span class="selected_modifiers" id="selected_modifiers_${modal_id}"></span>
                    `;
                } else {
                    html += `<span class="combo-product-name">${productDisplayName}</span>`;
                }
                
                html += `</div>
                <input type="hidden" name="products[${rowCount}][combo][${index}][product_id]" value="${combo_product.product_id}">
                <input type="hidden" name="products[${rowCount}][combo][${index}][variation_id]" value="${combo_product.variation_id}">
                <input type="hidden" class="combo_product_qty" name="products[${rowCount}][combo][${index}][quantity]" data-unit_quantity="${combo_product.qty_required || 1}" value="${combo_product.qty_required || 1}">
                <input type="hidden" class="instance_index" value="${instance_index}">
                `;
                
                if (combo_product.modifier_sets && combo_product.modifier_sets.length > 0) {
                    html += this.generateModifierModal(combo_product, modal_id, rowCount, index, instance_index);
                } else {
                }
            }
        });
        
        html += `
                </div>
            </div>
            <script>
            $(document).ready(function() {
                $('.combo-toggle-btn').off('click.combo-toggle').on('click.combo-toggle', function(e) {
                    e.preventDefault();
                    var icon = $(this).find('i');
                    var target = $(this).data('target');
                    var isExpanded = $(this).attr('aria-expanded') === 'true';
                    
                    if (isExpanded) {
                        icon.removeClass('fa-minus').addClass('fa-plus');
                        $(this).attr('aria-expanded', 'false');
                    } else {
                        icon.removeClass('fa-plus').addClass('fa-minus');
                        $(this).attr('aria-expanded', 'true');
                    }
                });
                
                $('.modifiers-toggle-btn').off('click.modifiers-toggle').on('click.modifiers-toggle', function(e) {
                    e.preventDefault();
                    var icon = $(this).find('i');
                    var target = $(this).data('target');
                    var isExpanded = $(this).attr('aria-expanded') === 'true';
                    
                    if (isExpanded) {
                        icon.removeClass('fa-minus').addClass('fa-plus');
                        $(this).attr('aria-expanded', 'false');
                    } else {
                        icon.removeClass('fa-plus').addClass('fa-minus');
                        $(this).attr('aria-expanded', 'true');
                    }
                });
            });
            </script>
        `;
        
        return html;
    },

    generateLotNumbers: function(product, rowCount, max_qty_rule, max_qty_msg, purchase_line_id) {
        if (POS_InstantCache.business.enable_lot_number || POS_InstantCache.business.enable_product_expiry) {
            const lot_numbers = POS_InstantCache.getLotNumbers(product.variation_id);
            const actual_lots = lot_numbers ? lot_numbers.filter(lot => lot.lot_number && lot.lot_number !== null && lot.lot_number.trim() !== '') : [];
            const has_lots = product.has_lots || actual_lots.length > 0;
            
            if (has_lots && lot_numbers && lot_numbers.length > 0 && !product.is_sales_order) {
                let html = `<select class="form-control lot_number input-sm" name="products[${rowCount}][lot_no_line_id]"${product.transaction_sell_lines_id ? ' disabled' : ''}>`;
                html += `<option value="">${this.lang('lang_v1.lot_n_expiry')}</option>`;
                
                lot_numbers.forEach(lot_number => {
                    let selected = '';
                    if (lot_number.purchase_line_id == (product.lot_no_line_id || purchase_line_id)) {
                        selected = 'selected';
                    }
                    
                    let expiry_text = '';
                    if (POS_InstantCache.business.enable_product_expiry && lot_number.exp_date) {
                        const exp_date = new Date(lot_number.exp_date);
                        const current_date = new Date();
                        if (current_date > exp_date) {
                            expiry_text = ` (${this.lang('report.expired')})`;
                        }
                    }
                    
                    html += `<option value="${lot_number.purchase_line_id}" data-qty_available="${lot_number.qty_available}" data-exp_date="${lot_number.exp_date || ''}" data-msg-max="${this.lang('lang_v1.quantity_error_msg_in_lot').replace(':qty', lot_number.qty_formated).replace(':unit', product.unit)}" ${selected}>`;
                    
                    if (lot_number.lot_number && POS_InstantCache.business.enable_lot_number) {
                        html += lot_number.lot_number;
                    }
                    if (POS_InstantCache.business.enable_lot_number && POS_InstantCache.business.enable_product_expiry) {
                        html += ' - ';
                    }
                    if (POS_InstantCache.business.enable_product_expiry && lot_number.exp_date) {
                        html += `${this.lang('product.exp_date')}: ${lot_number.exp_date}`;
                    }
                    html += expiry_text + '</option>';
                });
                
                html += '</select>';
                return html;
            }
        }
        return '';
    },

    generateUnitSelect: function(sub_units, product, rowCount) {
        if (Object.keys(sub_units).length > 0) {
            let html = `<select name="products[${rowCount}][sub_unit_id]" class="form-control input-sm sub_unit">`;
            Object.keys(sub_units).forEach(key => {
                const value = sub_units[key];
                const selected = product.sub_unit_id == key ? 'selected' : '';
                html += `<option value="${key}" data-multiplier="${value.multiplier}" data-unit_name="${value.name}" data-allow_decimal="${value.allow_decimal}" ${selected}>${value.name}</option>`;
            });
            html += '</select>';
            return html;
        } else {
            return product.unit || 'Pc(s)';
        }
    },

    generateComboHiddenFields: function(product, rowCount, action) {
        if (product.product_type == 'combo' && product.combo_products) {
            let html = '';
            product.combo_products.forEach((combo_product, k) => {
                let qty_total;
                if (action == 'edit') {
                    combo_product.qty_required = combo_product.quantity / product.quantity_ordered;
                    qty_total = combo_product.quantity;
                } else {
                    qty_total = combo_product.qty_required;
                }

                html += `
                    <input type="hidden" name="products[${rowCount}][combo][${k}][product_id]" value="${combo_product.product_id}">
                    <input type="hidden" name="products[${rowCount}][combo][${k}][variation_id]" value="${combo_product.variation_id}">
                    <input type="hidden" class="combo_product_qty" name="products[${rowCount}][combo][${k}][quantity]" data-unit_quantity="${combo_product.qty_required}" value="${qty_total}">
                `;

                if (action == 'edit') {
                    html += `<input type="hidden" name="products[${rowCount}][combo][${k}][transaction_sell_lines_id]" value="${combo_product.id}">`;
                }
            });
            return html;
        }
        return '';
    },

    generateDirectSellColumns: function(is_direct_sell, waiters, rowCount, product, pos_unit_price, last_sell_line, edit_price, edit_discount, discount_amount, discount_type, discount, common_settings, warranties, warranty_id) {
        if (!is_direct_sell) return '';

        let html = '';
        
        if (POS_InstantCache.settings.inline_service_staff == '1' || POS_InstantCache.settings.inline_service_staff == 1) {
            html += `
                <td>
                    <div class="form-group">
                        <div class="input-group">
                            <select name="products[${rowCount}][res_service_staff_id]" class="form-control input-sm select2 order_line_service_staff" ${POS_InstantCache.settings.is_service_staff_required == '1' || POS_InstantCache.settings.is_service_staff_required == 1 ? 'required' : ''}>
                                <option value="">${this.lang('restaurant.select_service_staff')}</option>
                                ${Object.keys(waiters).map(id => `<option value="${id}" ${product.res_service_staff_id == id ? 'selected' : ''}>${waiters[id]}</option>`).join('')}
                            </select>
                        </div>
                    </div>
                </td>`;
        }

        html += `
            <td class="${edit_price ? '' : 'hide'}">
                <input type="text" name="products[${rowCount}][unit_price]" class="form-control input-sm pos_unit_price input_number mousetrap" value="${this.num_format(pos_unit_price)}" ${POS_InstantCache.settings.enable_msp == '1' ? `data-rule-min-value="${pos_unit_price}" data-msg-min-value="${this.lang('lang_v1.minimum_selling_price_error_msg').replace('{price}', this.num_format(pos_unit_price))}"` : ''}>
                ${last_sell_line ? `
                <br>
                <small class="text-muted">${this.lang('lang_v1.prev_unit_price')}: ${this.format_currency(last_sell_line.unit_price_before_discount)}</small>
                <br>
                <small class="text-muted">
                    ${this.lang('lang_v1.prev_discount')}:
                    ${last_sell_line.line_discount_type == 'percentage' ? this.num_format(last_sell_line.line_discount_amount) + '%' : this.format_currency(last_sell_line.line_discount_amount)}
                </small>` : ''}
            </td>

            <td class="${edit_discount ? '' : 'hide'}">
                <input type="text" name="products[${rowCount}][line_discount_amount]" class="form-control input-sm input_number row_discount_amount" value="${this.num_format(discount_amount)}"><br>
                <select name="products[${rowCount}][line_discount_type]" class="form-control input-sm row_discount_type">
                    <option value="fixed" ${discount_type == 'fixed' ? 'selected' : ''}>${this.lang('lang_v1.fixed')}</option>
                    <option value="percentage" ${discount_type == 'percentage' ? 'selected' : ''}>${this.lang('lang_v1.percentage')}</option>
                </select>
                ${discount ? `<p class="help-block">${this.lang('lang_v1.applied_discount_text').replace('{discount_name}', discount.name).replace('{starts_at}', discount.formated_starts_at).replace('{ends_at}', discount.formated_ends_at)}</p>` : ''}
            </td>

            <td class="text-center ${POS_InstantCache.business.enable_inline_tax ? '' : 'hide'}">
                <input type="hidden" name="products[${rowCount}][item_tax]" class="item_tax" value="${this.num_format(product.item_tax || 0)}">
                <select name="products[${rowCount}][tax_id]" class="form-control input-sm tax_id width-100">
                    <option value="">Select</option>
                    ${this.generateTaxOptions(product.tax_id)}
                </select>
            </td>`;
        
        if (common_settings.enable_product_warranty == '1') {
            html += `
                <td>
                    <select name="products[${rowCount}][warranty_id]" class="form-control input-sm">
                        <option value="">${this.lang('messages.please_select')}</option>
                        ${Object.keys(warranties).map(id => `<option value="${id}" ${warranty_id == id ? 'selected' : ''}>${warranties[id]}</option>`).join('')}
                    </select>
                </td>`;
        }

        return html;
    },

    generateNonDirectSellColumns: function(is_direct_sell, waiters, rowCount, product, hide_tax, item_tax, unit_price_inc_tax, edit_price, common_settings, warranties, warranty_id) {
        if (is_direct_sell) return '';

        let html = '';
        
        if (POS_InstantCache.settings.inline_service_staff == '1' || POS_InstantCache.settings.inline_service_staff == 1) {
            html += `
                <td>
                    <div class="form-group">
                        <div class="input-group">
                            <select name="products[${rowCount}][res_service_staff_id]" class="form-control input-sm select2 order_line_service_staff" ${POS_InstantCache.settings.is_service_staff_required == '1' || POS_InstantCache.settings.is_service_staff_required == 1 ? 'required' : ''}>
                                <option value="">${this.lang('restaurant.select_service_staff')}</option>
                                ${Object.keys(waiters).map(id => `<option value="${id}" ${product.res_service_staff_id == id ? 'selected' : ''}>${waiters[id]}</option>`).join('')}
                            </select>
                        </div>
                    </div>
                </td>`;
        }

        html += `
            <td class="text-center ${hide_tax}">
                <input type="hidden" name="products[${rowCount}][item_tax]" class="item_tax" value="${this.num_format(item_tax)}">
                <select name="products[${rowCount}][tax_id]" class="form-control input-sm tax_id width-100">
                    <option value="">Select</option>
                    ${this.generateTaxOptions(product.tax_id)}
                </select>
            </td>
            <td class="${hide_tax}">
                <input type="hidden" name="item_price[${rowCount}]" id="item_price" value="${this.num_format(unit_price_inc_tax)}">
                <input type="text" name="products[${rowCount}][unit_price_inc_tax]" style="height: 30px; line-height: 30px;" class="form-control input-sm pos_unit_price_inc_tax input_number" value="${this.num_format(unit_price_inc_tax)}" ${!edit_price ? 'readonly' : ''} ${POS_InstantCache.settings.enable_msp == '1' ? `data-rule-min-value="${unit_price_inc_tax}" data-msg-min-value="${this.lang('lang_v1.minimum_selling_price_error_msg').replace('{price}', this.num_format(unit_price_inc_tax))}"` : ''}>
            </td>`;


        return html;
    },

    generateTaxOptions: function(selected_tax_id) {
        let options = '';
        if (POS_InstantCache.taxes && POS_InstantCache.taxes.tax_rates) {
            Object.keys(POS_InstantCache.taxes.tax_rates).forEach(key => {
                const taxName = POS_InstantCache.taxes.tax_rates[key];
                const selected = selected_tax_id == key ? 'selected' : '';
                const attributes = POS_InstantCache.taxes.attributes && POS_InstantCache.taxes.attributes[key] ? 
                    Object.entries(POS_InstantCache.taxes.attributes[key]).map(([attr, val]) => `${attr}="${val}"`).join(' ') : '';
                options += `<option value="${key}" ${selected} ${attributes}>${taxName}</option>`;
            });
        }
        return options;
    },

    generateEditModal: function(rowCount, product, pos_unit_price, unit_price_inc_tax, discount_type, discount_amount, tax_id, item_tax, sell_line_note, warranty_id, warranties, discount, common_settings) {
        
        
        const brandName = product.brand_id ? (POS_InstantCache.brands[product.brand_id] || '') : '';
        const productDisplayName = product.product_name + (brandName ? ' ' + brandName : '');
        
        return `
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">${productDisplayName} - ${product.sub_sku}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-xs-12 ${POS_InstantCache.permissions.edit_price ? '' : 'hide'}">
                                <label>${this.lang('sale.unit_price')}</label>
                                <input type="text" name="products[${rowCount}][unit_price]" class="form-control pos_unit_price input_number mousetrap" value="${this.num_format(pos_unit_price)}" ${POS_InstantCache.settings.enable_msp == '1' ? `data-rule-min-value="${pos_unit_price}" data-msg-min-value="${this.lang('lang_v1.minimum_selling_price_error_msg').replace('{price}', this.num_format(pos_unit_price))}"` : ''}>
                            </div>
                            ${!POS_InstantCache.permissions.edit_price ? `
                            <div class="form-group col-xs-12">
                                <strong>${this.lang('sale.unit_price')}:</strong> ${this.format_currency(pos_unit_price)}
                            </div>` : ''}
                            <div class="form-group col-xs-12 col-sm-6 ${POS_InstantCache.permissions.edit_discount ? '' : 'hide'}">
                                <label>${this.lang('sale.discount_type')}</label>
                                <select name="products[${rowCount}][line_discount_type]" class="form-control row_discount_type">
                                    <option value="fixed" ${discount_type == 'fixed' ? 'selected' : ''}>${this.lang('lang_v1.fixed')}</option>
                                    <option value="percentage" ${discount_type == 'percentage' ? 'selected' : ''}>${this.lang('lang_v1.percentage')}</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 ${POS_InstantCache.permissions.edit_discount ? '' : 'hide'}">
                                <label>${this.lang('sale.discount_amount')}</label>
                                <input type="text" name="products[${rowCount}][line_discount_amount]" class="form-control input_number row_discount_amount" value="${this.num_format(discount_amount)}">
                            </div>
                            ${discount ? `
                            <div class="form-group col-xs-12">
                                <p class="help-block">${this.lang('lang_v1.applied_discount_text').replace('{discount_name}', discount.name).replace('{starts_at}', discount.formated_starts_at).replace('{ends_at}', discount.formated_ends_at)}</p>
                            </div>` : ''}
                            <div class="form-group col-xs-12 ${POS_InstantCache.business.enable_inline_tax ? '' : 'hide'}">
                                <label>${this.lang('sale.tax')}</label>
                                <input type="hidden" name="products[${rowCount}][item_tax]" class="item_tax" value="${this.num_format(item_tax)}">
                                <select name="products[${rowCount}][tax_id]" class="form-control tax_id">
                                    <option value="">Select</option>
                                    ${this.generateTaxOptions(tax_id)}
                                </select>
                            </div>
                            ${(() => {
                                return (common_settings?.enable_product_warranty == '1' && Object.keys(POS_InstantCache.warranties || {}).length > 0) ? `
                                <div class="form-group col-xs-12">
                                    <label>${this.lang('lang_v1.warranty')}</label>
                                    <select name="products[${rowCount}][warranty_id]" class="form-control">
                                        <option value="">${this.lang('messages.please_select')}</option>
                                        ${Object.keys(POS_InstantCache.warranties || {}).map(id => `<option value="${id}" ${warranty_id == id ? 'selected' : ''}>${POS_InstantCache.warranties[id]}</option>`).join('')}
                                    </select>
                                </div>` : '';
                            })()}
                            <div class="form-group col-xs-12">
                                <label>${this.lang('lang_v1.description')}</label>
                                <textarea class="form-control" name="products[${rowCount}][sell_line_note]" rows="3">${sell_line_note}</textarea>
                                <p class="help-block">${this.lang('lang_v1.sell_line_description_help')}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">${this.lang('messages.close')}</button>
                    </div>
                </div>
            </div>`;
    },

    syncTax: function(rowCount, sourceType = 'row') {
        const rowSelector = `tr:has(input[name="products[${rowCount}][quantity]"])`;
        const modalSelector = `#row_edit_product_price_modal_${rowCount}`;
        
        const $row = $(rowSelector);
        const $modal = $(modalSelector);
        
        if ($row.length && $modal.length) {
            let sourceTaxId, sourceItemTax;
            
            if (sourceType === 'row') {
                
                const $rowTaxSelect = $row.find('select[name="products[' + rowCount + '][tax_id]"]');
                const $rowTaxInput = $row.find('input[name="products[' + rowCount + '][item_tax]"]');
                
                
                sourceTaxId = $rowTaxSelect.val();
                sourceItemTax = $rowTaxInput.val();
                
                
                const $modalTaxSelect = $modal.find('select[name="products[' + rowCount + '][tax_id]"]');
                const $modalTaxInput = $modal.find('input[name="products[' + rowCount + '][item_tax]"]');
                
                
                if ($modalTaxSelect.length > 0) {
                    $modalTaxSelect.val(sourceTaxId);
                }
                
                if ($modalTaxInput.length > 0) {
                    $modalTaxInput.val(sourceItemTax);
                }
            } else {
                sourceTaxId = $modal.find('select[name="products[' + rowCount + '][tax_id]"]').val();
                sourceItemTax = $modal.find('input[name="products[' + rowCount + '][item_tax]"]').val();
                
                $row.find('select[name="products[' + rowCount + '][tax_id]"]').val(sourceTaxId);
                $row.find('input[name="products[' + rowCount + '][item_tax]"]').val(sourceItemTax);
            }
        }
    },

    syncTaxToModal: function(rowCount) {
        this.syncTax(rowCount, 'row');
    },

    syncTaxWithValues: function(rowCount, sourceType, taxId, taxAmount) {
        const rowSelector = `tr:has(input[name="products[${rowCount}][quantity]"])`;
        const modalSelector = `#row_edit_product_price_modal_${rowCount}`;
        
        const $row = $(rowSelector);
        const $modal = $(modalSelector);
        
        if ($row.length && $modal.length) {
            if (sourceType === 'row') {
                
                const $modalTaxSelect = $modal.find('select[name="products[' + rowCount + '][tax_id]"]');
                const $modalTaxInput = $modal.find('input[name="products[' + rowCount + '][item_tax]"]');
                
                if ($modalTaxSelect.length > 0) {
                    $modalTaxSelect.val(taxId);
                }
                
                if ($modalTaxInput.length > 0) {
                    $modalTaxInput.val(taxAmount);
                }
            } else {
                const $rowTaxSelect = $row.find('select[name="products[' + rowCount + '][tax_id]"]');
                const $rowTaxInput = $row.find('input[name="products[' + rowCount + '][item_tax]"]');
                
                if ($rowTaxSelect.length > 0) {
                    $rowTaxSelect.val(taxId);
                }
                
                if ($rowTaxInput.length > 0) {
                    $rowTaxInput.val(taxAmount);
                }
            }
        }
    }
};

window.pos_customer_group_discount = 0;
window.pos_selected_customer_data = null;

$(document).ready(function() {
    setTimeout(function() {
        if (typeof window.pos_product_row === 'function') {
            window.original_pos_product_row = window.pos_product_row;
        }

        window.pos_product_row = function(variation_id = null, purchase_line_id = null, weighing_scale_barcode = null, quantity = 1) {
           
            if (window.pos_processing && window.pos_processing === variation_id) {
                return;
            }
            
            window.pos_processing = variation_id;
            setTimeout(() => {
                window.pos_processing = null;
            }, 500);

            if (!POS_InstantCache.initialized || !POS_InstantCache.getProduct(variation_id)) {
                window.pos_processing = null;
                if (window.original_pos_product_row) {
                    return window.original_pos_product_row(variation_id, purchase_line_id, weighing_scale_barcode, quantity);
                }
                return;
            }

            var item_addtn_method = 0;
            var add_via_instant = true;

            if (variation_id != null && $('#item_addition_method').length) {
                item_addtn_method = $('#item_addition_method').val();
            }

            if (item_addtn_method == 0) {
                add_via_instant = true;
            } else {
                var is_added = false;
                $('#pos_table tbody').find('tr').each(function() {
                    var row_v_id = $(this).find('.row_variation_id').val();
                    var enable_sr_no = $(this).find('.enable_sr_no').val();
                    var modifiers_exist = $(this).find('input.modifiers_exist').length > 0;

                    if (row_v_id == variation_id && enable_sr_no !== '1' && !modifiers_exist && !is_added) {
                        add_via_instant = false;
                        is_added = true;
                        var qty_element = $(this).find('.pos_quantity');
                        var qty = parseFloat(qty_element.val()) || 0;
                        var new_qty = qty + parseFloat(quantity);
                        qty_element.val(new_qty);
                        qty_element.trigger('change');
                        
                        $('input#search_product').focus().select();
                        window.pos_processing = null;
                    }
                });
            }

            if (add_via_instant) {
                const product = POS_InstantCache.getProduct(variation_id);
                if (!product) {
                    if (window.original_pos_product_row) {
                        window.original_pos_product_row(variation_id, purchase_line_id, weighing_scale_barcode, quantity);
                    }
                    window.pos_processing = null;
                    return;
                }

                const validation = POS_RowGenerator.validateProductAddition(product, quantity);
                if (!validation.valid) {
                    toastr.error(validation.message);
                    $('input#search_product').focus().select();
                    window.pos_processing = null;
                    return;
                }

                try {
                    var product_row_count = parseInt($('input#product_row_count').val()) || 0;
                    var new_row_count = product_row_count + 1;
                    
                    var html = POS_RowGenerator.generateProductRow(variation_id, quantity, new_row_count, {
                        purchase_line_id: purchase_line_id
                    });
                    
                    if (html) {
                        $('table#pos_table tbody').append(html);
                        $('input#product_row_count').val(new_row_count);
                        
                        var new_row = $('table#pos_table tbody tr:last');
                        new_row.find('.pos_quantity').trigger('change');
                        
                        if (typeof POS_RowGenerator !== 'undefined' && POS_RowGenerator.initializeModifierHandlers) {
                            POS_RowGenerator.initializeModifierHandlers();
                        }
                        
                        if (product.product_ms && product.product_ms.length > 0 && !window.pos_customer_selection_triggered_reset) {
                            setTimeout(function() {
                                const modifierButton = new_row.find('.select-modifiers-btn');
                                if (modifierButton.length > 0) {
                                    modifierButton.click();
                                }
                            }, 300); 
                        }
                        
                        $('input#search_product').focus().select();
                        
                        
                    } else {
                        throw new Error('Failed to generate product row HTML');
                    }
                    
                } catch (error) {
                    if (window.original_pos_product_row) {
                        window.original_pos_product_row(variation_id, purchase_line_id, weighing_scale_barcode, quantity);
                    }
                }
            }
            
            window.pos_processing = null;
        };


        if (window.POS_APP_SETTINGS && window.POS_APP_SETTINGS.enable_instant_search) {
            if ($('#search_product').length && $('#search_product').hasClass('ui-autocomplete-input')) {
                $('#search_product').autocomplete('destroy');
            }

            if ($('#search_product').length) {
            $('#search_product').autocomplete({
                delay: 100,
                source: function(request, response) {
                    if (!POS_InstantCache.initialized) {
                        response([]);
                        return;
                    }

                    var search_fields = [];
                    $('.search_fields:checked').each(function(i){
                        search_fields[i] = $(this).val();
                    });
                    
                    if (search_fields.length === 0) {
                        search_fields = ['name', 'sku']; 
                    }

                    const results = POS_InstantCache.searchProducts(request.term, search_fields);
                    response(results);
                },
                minLength: 2,
                response: function(event, ui) {
                    if (ui.content.length == 1) {
                        ui.item = ui.content[0];

                        var is_overselling_allowed = $('input#is_overselling_allowed').length > 0;
                        var for_so = $('#sale_type').length && $('#sale_type').val() == 'sales_order';

                        if ((ui.item.enable_stock == 1 && ui.item.qty_available > 0) || 
                                (ui.item.enable_stock == 0) || is_overselling_allowed || for_so) {
                            $(this)
                                .data('ui-autocomplete')
                                ._trigger('select', 'autocompleteselect', ui);
                            $(this).autocomplete('close');
                        }
                    } else if (ui.content.length == 0) {
                        if (typeof LANG !== 'undefined' && LANG.no_products_found) {
                            toastr.error(LANG.no_products_found);
                        } else {
                            toastr.error('No products found');
                        }
                        $('input#search_product').select();
                    }
                },
                focus: function(event, ui) {
                    if (ui.item.qty_available <= 0) {
                        return false;
                    }
                },
                select: function(event, ui) {
                    var searched_term = $(this).val();
                    var is_overselling_allowed = $('input#is_overselling_allowed').length > 0;
                    var for_so = $('#sale_type').length && $('#sale_type').val() == 'sales_order';
                    var is_draft = $('input#status').length && 
                        ($('input#status').val() == 'quotation' || $('input#status').val() == 'draft');

                    if (ui.item.enable_stock != 1 || ui.item.qty_available > 0 || is_overselling_allowed || for_so || is_draft) {
                        $(this).val(null);

                        var purchase_line_id = ui.item.purchase_line_id && searched_term == ui.item.lot_number ? ui.item.purchase_line_id : null;
                        
                        pos_product_row(ui.item.variation_id, purchase_line_id);
                    } else {
                        if (typeof LANG !== 'undefined' && LANG.out_of_stock) {
                            alert(LANG.out_of_stock);
                        } else {
                            alert('Out of stock');
                        }
                    }
                }
            }).autocomplete('instance')._renderItem = function(ul, item) {
                var is_overselling_allowed = $('input#is_overselling_allowed').length > 0;
                var for_so = $('#sale_type').length && $('#sale_type').val() == 'sales_order';
                var is_draft = $('input#status').length && 
                    ($('input#status').val() == 'quotation' || $('input#status').val() == 'draft');

                const formatCurrency = window.POS_FormatHelpers.formatCurrency;
                const formatQuantity = window.POS_FormatHelpers.formatQuantity;

                if (item.enable_stock == 1 && item.qty_available <= 0 && !is_overselling_allowed && !for_so && !is_draft) {
                    var string = '<li class="ui-state-disabled">' + item.name;
                    if (item.type == 'variable' && item.variation) {
                        string += '-' + item.variation;
                    }
                    
                    var selling_price = item.variation_group_price || item.selling_price;
                    string += ' (' + item.sub_sku + ')' + '<br> Price: ' + formatCurrency(selling_price) + ' (Out of stock) </li>';
                    return $(string).appendTo(ul);
                } else {
                    var string = '<div>' + item.name;
                    if (item.type == 'variable' && item.variation) {
                        string += '-' + item.variation;
                    }

                    var selling_price = item.variation_group_price || item.selling_price;
                    string += ' (' + item.sub_sku + ')' + '<br> Price: ' + formatCurrency(selling_price);
                    
                    if (item.enable_stock == 1 && item.qty_available !== 999999) {
                        var qty_available = (item.qty_available);
                        string += ' - ' + qty_available + ' ' + item.unit;
                    }
                    string += '</div>';

                    return $('<li>').append(string).appendTo(ul);
                }
            };

            }
        } else {
        }

        $(document).on('change', 'select#price_group', function(e) {
            if (e.namespace === 'reset_form') {
                return;
            }
            var selectedValue = $(this).val();
            var selectedText = $(this).find('option:selected').text();
            
            $('input#hidden_price_group').val(selectedValue);
            
            if (e.namespace === 'customer_group_update') {
                return;
            }
            
            if (window.pos_customer_selection_in_progress) {
                return;
            }
            
            if ($('table#pos_table tbody tr.product_row').length > 0) {
                window.pos_customer_selection_triggered_reset = true;
                
                reset_pos_form();
                
                
                if (typeof toastr !== 'undefined') {
                    toastr.info('Price group changed to: ' + selectedText + '. Cart has been cleared.');
                }
            }
        });
        var locationId = $('input#location_id').val();
        if (locationId) {
            POS_InstantCache.initialize(locationId).then(() => {
            });
        }

        $('#customer_id').off('select2:select');
        
        $(document).on('select2:select', '#customer_id', function(e) {
            var data = e.params.data;
            
            if (window.pos_customer_restoration_in_progress) {
                return;
            }
            
            window.pos_customer_selection_in_progress = true;
            
            e.stopImmediatePropagation();
            
            var hasProductsInCart = $('table#pos_table tbody tr.product_row').length > 0;
            
            if (hasProductsInCart) {
                window.pos_selected_customer_data = {
                    id: data.id,
                    text: data.text,
                    price_calculation_type: data.price_calculation_type,
                    selling_price_group_id: data.selling_price_group_id,
                    discount_percent: data.discount_percent
                };
                
                if (data.price_calculation_type == 'selling_price_group') {
                    $('#price_group').val(data.selling_price_group_id);
                    $('input#hidden_price_group').val(data.selling_price_group_id);
                    $('#price_group').trigger('change.customer_group_update');
                    window.pos_customer_group_discount = 0;
                } else if (data.price_calculation_type == 'percentage' && data.discount_percent) {
                    $('#price_group').val('0');
                    $('input#hidden_price_group').val('0');
                    $('#price_group').trigger('change.customer_group_update');
                    window.pos_customer_group_discount = Math.abs(parseFloat(data.discount_percent)) || 0;
                } else {
                    $('#price_group').val('0');
                    $('input#hidden_price_group').val('0');
                    $('#price_group').trigger('change.customer_group_update');
                    window.pos_customer_group_discount = 0;
                }
                
                if (data.pay_term_number) {
                    $('input#pay_term_number').val(data.pay_term_number);
                } else {
                    $('input#pay_term_number').val('');
                }

                if (data.pay_term_type) {
                    $('#add_sell_form select[name="pay_term_type"]').val(data.pay_term_type);
                    $('#edit_sell_form select[name="pay_term_type"]').val(data.pay_term_type);
                } else {
                    $('#add_sell_form select[name="pay_term_type"]').val('');
                    $('#edit_sell_form select[name="pay_term_type"]').val('');
                }
                
                if (typeof update_shipping_address === 'function') {
                    update_shipping_address(data);
                }
                
                $('#advance_balance_text').text(__currency_trans_from_en(data.balance), true);
                $('#advance_balance').val(data.balance);
                
                if ($('.contact_due_text').length) {
                    get_contact_due(data.id);
                }
                
                var default_customer_id = $('#default_customer_id').val();
                if (data.id == default_customer_id) {
                    if ($('#rp_redeemed_modal').length) {
                        $('#rp_redeemed_modal').val('');
                        $('#rp_redeemed_modal').trigger('change');
                        $('#rp_redeemed_modal').attr('disabled', true);
                        $('#available_rp').text('');
                        if (typeof updateRedeemedAmount === 'function') {
                            updateRedeemedAmount();
                        }
                        if (typeof pos_total_row === 'function') {
                            pos_total_row();
                        }
                    }
                } else {
                    if ($('#rp_redeemed_modal').length) {
                        $('#rp_redeemed_modal').removeAttr('disabled');
                    }
                }
                
                
                window.pos_processing_customer_group = false;
                
                reset_pos_form();
                
            } else {
                
                window.pos_processing_customer_group = true;
                
                window.pos_selected_customer_data = {
                    id: data.id,
                    text: data.text,
                    price_calculation_type: data.price_calculation_type,
                    selling_price_group_id: data.selling_price_group_id,
                    discount_percent: data.discount_percent
                };
                
                if (data.price_calculation_type == 'selling_price_group') {
                    $('#price_group').val(data.selling_price_group_id);
                    $('input#hidden_price_group').val(data.selling_price_group_id);
                    $('#price_group').trigger('change');
                    window.pos_customer_group_discount = 0;
                    
                } else if (data.price_calculation_type == 'percentage' && data.discount_percent) {
                    $('#price_group').val('0');
                    $('input#hidden_price_group').val('0');
                    $('#price_group').trigger('change');
                    window.pos_customer_group_discount = Math.abs(parseFloat(data.discount_percent)) || 0;
                    
                } else {
                    $('#price_group').val('0');
                    $('input#hidden_price_group').val('0');
                    $('#price_group').trigger('change');
                    window.pos_customer_group_discount = 0;
                }
                
                
                if (data.pay_term_number) {
                    $('input#pay_term_number').val(data.pay_term_number);
                } else {
                    $('input#pay_term_number').val('');
                }

                if (data.pay_term_type) {
                    $('#add_sell_form select[name="pay_term_type"]').val(data.pay_term_type);
                    $('#edit_sell_form select[name="pay_term_type"]').val(data.pay_term_type);
                } else {
                    $('#add_sell_form select[name="pay_term_type"]').val('');
                    $('#edit_sell_form select[name="pay_term_type"]').val('');
                }
                
                if (typeof update_shipping_address === 'function') {
                    update_shipping_address(data);
                }
                
                $('#advance_balance_text').text(__currency_trans_from_en(data.balance), true);
                $('#advance_balance').val(data.balance);
                
                if ($('.contact_due_text').length) {
                    get_contact_due(data.id);
                }
                
                var default_customer_id = $('#default_customer_id').val();
                if (data.id == default_customer_id) {
                    if ($('#rp_redeemed_modal').length) {
                        $('#rp_redeemed_modal').val('');
                        $('#rp_redeemed_modal').trigger('change');
                        $('#rp_redeemed_modal').attr('disabled', true);
                        $('#available_rp').text('');
                        if (typeof updateRedeemedAmount === 'function') {
                            updateRedeemedAmount();
                        }
                        if (typeof pos_total_row === 'function') {
                            pos_total_row();
                        }
                    }
                } else {
                    if ($('#rp_redeemed_modal').length) {
                        $('#rp_redeemed_modal').removeAttr('disabled');
                    }
                }
                
                
                setTimeout(function() {
                    window.pos_processing_customer_group = false;
                    window.pos_customer_selection_in_progress = false;
                }, 1000);
            }
            
            setTimeout(function() {
                window.pos_customer_selection_in_progress = false;
            }, 2000);
        });
        
            

        $(document).on('pos_sale_completed', function(e, data) {
            POS_InstantCache.forceRefresh();
        });

        if (typeof window.finalizeSale === 'function') {
            const originalFinalizeSale = window.finalizeSale;
            window.finalizeSale = function() {
                const result = originalFinalizeSale.apply(this, arguments);
                
                setTimeout(() => {
                    POS_InstantCache.forceRefresh();
                }, 1000);
                
                return result;
            };
        }

        $(document).ajaxSuccess(function(event, xhr, settings) {
            if (settings.url && settings.type === 'POST' && (
             
                settings.url.endsWith('/pos')
               
            )) {
                
                try {
                    const response = JSON.parse(xhr.responseText);
                    if ((response.success === 1 || response.success === true) || response.status === 'success') {
                        setTimeout(() => {
                            POS_InstantCache.forceRefresh();
                          
                        }, 1000);
                        window.pos_ajax_triggered_reset = true;
                        set_default_customer();
                    } else {
                    }
                } catch (e) {
                }
            }
        });

        $(document).on('change', 'select.lot_number', function() {
            var qty_available = parseFloat($(this).find('option:selected').data('qty_available')) || 0;
            var selected_lot_id = $(this).val();
            var selected_text = $(this).find('option:selected').text();
            var exp_date_str = $(this).find('option:selected').data('exp_date');
            var row = $(this).closest('tr');
            var qty_input = row.find('.pos_quantity');
            var current_qty = parseFloat(qty_input.val()) || 0;
            var variation_id = row.find('.row_variation_id').val();
            
            
            if (selected_lot_id && exp_date_str) {
                var validation_result = window.validateLotStopSellingPeriod(exp_date_str, selected_text);
                if (!validation_result.valid) {
                    if (typeof toastr !== 'undefined') {
                        toastr.warning(validation_result.message);
                    } else {
                        alert(validation_result.message);
                    }
                    
                }
            }
            
            var product_data = null;
            if (variation_id) {
                product_data = POS_InstantCache.getProduct(variation_id);
                
                if (!product_data) {
                    return; 
                }
            }
            
            if (!product_data) {
                return;
            }
            
            var effective_stock = 0;
            var validation_message = '';
            
            if (selected_lot_id && qty_available > 0) {
                effective_stock = qty_available;
                validation_message = $(this).find('option:selected').data('msg-max') || 
                    POS_RowGenerator.lang('validation.custom-messages.quantity_not_available')
                        .replace(':qty', POS_RowGenerator.format_quantity(qty_available))
                        .replace(':unit', product_data ? product_data.unit : 'unit');
                
            } else if (selected_lot_id && qty_available <= 0) {
                effective_stock = 0;
                validation_message = POS_RowGenerator.lang('lang_v1.item_out_of_stock');
            } else if (!selected_lot_id && product_data) {
                effective_stock = parseFloat(product_data.original_qty_available !== undefined ? product_data.original_qty_available : product_data.qty_available || 0);
                validation_message = POS_RowGenerator.lang('validation.custom-messages.quantity_not_available')
                    .replace(':qty', POS_RowGenerator.format_quantity(effective_stock))
                    .replace(':unit', product_data.unit || 'unit');
                
            }
            
            if (effective_stock > 0) {
                qty_input.attr('data-rule-max-value', effective_stock);
                qty_input.attr('data-msg-max-value', validation_message);
                qty_input.removeAttr('disabled');
                
                qty_input.rules('remove', 'max-value');
                qty_input.rules('add', {
                    'max-value': effective_stock,
                    messages: {
                        'max-value': validation_message
                    }
                });
                
                if (current_qty > effective_stock) {
                    qty_input.val(POS_RowGenerator.format_quantity(effective_stock));
                    qty_input.trigger('change');
                }
            } else {
                qty_input.attr('data-rule-max-value', 0);
                qty_input.attr('data-msg-max-value', validation_message);
                
                qty_input.rules('remove', 'max-value');
                qty_input.rules('add', {
                    'max-value': 0,
                    messages: {
                        'max-value': validation_message || POS_RowGenerator.lang('lang_v1.item_out_of_stock')
                    }
                });
                
                if (current_qty > 0) {
                    qty_input.val('0');
                    qty_input.trigger('change');
                }
            }
            
            qty_input.valid();
            
            try {
                POS_RowGenerator.updateStockDisplay(row, selected_lot_id, qty_available, selected_text, product_data);
            } catch (error) {
            }
            
            qty_input.valid();
        });

    }, 1000);
});

window.refreshPOSCache = function() {
    return POS_InstantCache.forceRefresh();
};

window.validateLotStopSellingPeriod = function(exp_date_str, lot_text) {
    if (!exp_date_str) {
        return { valid: true, message: '' };
    }
    
    var business = window.POS_InstantCache && window.POS_InstantCache.business;
    
    var expiry_enabled = business && (business.enable_product_expiry === true || business.enable_product_expiry == 1);
    var stop_selling_enabled = expiry_enabled && business.on_product_expiry == 'stop_selling';
    var stop_selling_days = 0;
    
    
    if (stop_selling_enabled) {
        
        if (business.stop_selling_before) {
            stop_selling_days = parseInt(business.stop_selling_before) || 0;
        }
    } else if (expiry_enabled && (!business.on_product_expiry || business.on_product_expiry === undefined)) {
    } else if (business) {
    } else {
    }
    
    
    if (!stop_selling_enabled) {
        return { valid: true, message: '' }; 
    }
    
    if (stop_selling_days <= 0) {
        var exp_date = new Date(exp_date_str);
        var current_date = new Date();
        
        if (current_date > exp_date) {
            return {
                valid: false,
                message: `Cannot sell ${lot_text || 'this lot'}. Product has expired on ${exp_date_str}.`
            };
        }
        return { valid: true, message: '' }; 
    }
    
    try {
        var exp_date = new Date(exp_date_str);
        var current_date = new Date();
        
        var stop_selling_date = new Date(exp_date);
        stop_selling_date.setDate(stop_selling_date.getDate() - stop_selling_days);
        
        var days_until_expiry = Math.ceil((exp_date - current_date) / (1000 * 60 * 60 * 24));
        
        if (current_date >= stop_selling_date) {
            return {
                valid: false,
                message: `Cannot sell ${lot_text || 'this lot'}. Stop selling period reached (${stop_selling_days} days before expiry). Expires in ${days_until_expiry} day(s).`
            };
        }
        
        var warning_date = new Date(stop_selling_date);
        warning_date.setDate(warning_date.getDate() + 1);
        if (current_date >= warning_date) {
        }
        
        return { valid: true, message: '' };
        
    } catch (e) {
        return { valid: true, message: '' }; 
    }
};

$(document).ready(function() {
    setTimeout(function() {
        if (window.POS_InstantCache && window.POS_InstantCache.initialized) {
            
            if (window.POS_InstantCache.business) {
                var business = window.POS_InstantCache.business;
                
                
                var expiry_enabled = (business.enable_product_expiry === true || business.enable_product_expiry == 1);
                var stop_selling_enabled = expiry_enabled && business.on_product_expiry == 'stop_selling';
                
                if (stop_selling_enabled && business.stop_selling_before) {
                } else if (stop_selling_enabled) {
                } else {
                    
                    if (!expiry_enabled) {
                    } else if (business.on_product_expiry !== 'stop_selling') {
                    }
                }
            }
        }
    }, 3000);
    
    
    setTimeout(function() {    
        if (typeof POS_RowGenerator !== 'undefined' && POS_RowGenerator.initializeModifierHandlers) {
            POS_RowGenerator.initializeModifierHandlers();
        }
        
        setupTaxSyncHandlers();
        
    }, 2000);
    
    function setupTaxSyncHandlers() {
        $(document).on('show.bs.modal', '[id^="row_edit_product_price_modal_"]', function() {
            const modalId = $(this).attr('id');
            const rowCount = modalId.replace('row_edit_product_price_modal_', '');
            if (typeof POS_RowGenerator !== 'undefined' && POS_RowGenerator.syncTax) {
                POS_RowGenerator.syncTax(rowCount, 'row');
            }
        });
        
        $(document).on('change', '#pos_table tbody select.tax_id', function() {
            const $tr = $(this).parents('tr');
            const name = $(this).attr('name');
            const match = name.match(/products\[(\d+)\]\[tax_id\]/);
            
            if (match) {
                const rowCount = match[1];
                
                const tax_rate = parseFloat($(this).find(':selected').data('rate')) || 0;
                let unit_price_inc_tax = parseFloat($tr.find('input.pos_unit_price_inc_tax').val()) || 0;
                const quantity = parseFloat($tr.find('input.pos_quantity').val()) || 1;
                
                let tax_amount = 0;
                let unit_price = 0;
                
                if (tax_rate > 0 && unit_price_inc_tax > 0) {
                    unit_price = unit_price_inc_tax / (1 + (tax_rate / 100));
                    tax_amount = unit_price_inc_tax - unit_price;
                    
                    $tr.find('input.pos_unit_price').val(unit_price.toFixed(2));
                } else {
                    unit_price = unit_price_inc_tax;
                    tax_amount = 0;
                }
                
                $tr.find('input.item_tax').val(tax_amount.toFixed(2));
                
                const line_total = quantity * unit_price_inc_tax;
                $tr.find('input.pos_line_total').val(line_total.toFixed(2));
                $tr.find('span.pos_line_total_text').text(line_total.toFixed(2));
                
                if (typeof pos_total_row === 'function') {
                    pos_total_row();
                }
                
                const changedTaxId = $(this).val(); 
                setTimeout(function() {
                    if (typeof POS_RowGenerator !== 'undefined' && POS_RowGenerator.syncTaxWithValues) {
                        const calculatedTaxAmount = $tr.find('input.item_tax').val();
                        POS_RowGenerator.syncTaxWithValues(rowCount, 'row', changedTaxId, calculatedTaxAmount);
                    }
                }, 100);
            }
        });
        
        $(document).on('change', '[id^="row_edit_product_price_modal_"] select[name*="[tax_id]"]', function() {
            const name = $(this).attr('name');
            const match = name.match(/products\[(\d+)\]\[tax_id\]/);
            if (match) {
                const rowCount = match[1];
                const $this = $(this);
                
                $this.trigger('quickprod_added');
                
                setTimeout(function() {
                    if (typeof POS_RowGenerator !== 'undefined' && POS_RowGenerator.syncTax) {
                        POS_RowGenerator.syncTax(rowCount, 'modal');
                    }
                    
                    const $rowTaxSelect = $(`#pos_table select[name="products[${rowCount}][tax_id]"]`);
                    if ($rowTaxSelect.length) {
                        $rowTaxSelect.trigger('quickprod_added');
                    }
                }, 150);
            }
        });
    }
});

$(document).ready(function() {
    window.modalCounter = 0;
    
    $(document).off('click.global-modifiers-toggle', '.modifiers-toggle-btn').on('click.global-modifiers-toggle', '.modifiers-toggle-btn', function(e) {
        e.preventDefault();
        var icon = $(this).find('i');
        var isExpanded = $(this).attr('aria-expanded') === 'true';
        
        if (isExpanded) {
            icon.removeClass('fa-minus').addClass('fa-plus');
            $(this).attr('aria-expanded', 'false');
        } else {
            icon.removeClass('fa-plus').addClass('fa-minus');
            $(this).attr('aria-expanded', 'true');
        }
    });
    
    $(document).off('click.standard-modifier-add', '.add_modifier').on('click.standard-modifier-add', '.add_modifier', function(e) {
        var modal = $(this).closest('.modal');
        
        if (modal.find('.instance_index').length > 0) {
            return; 
        }
        
        
        var row_count = modal.find('.index').val();
        
        var selected_modifiers = [];
        modal.find('input[type="checkbox"]:checked').each(function() {
            selected_modifiers.push($(this).val());
        });
        
        
        var modifier_html = '';
        selected_modifiers.forEach(function(modifier_id) {
            var checkbox = modal.find('input[value="' + modifier_id + '"]');
            var modifier_name = checkbox.closest('label').contents().filter(function() {
                return this.nodeType === 3;
            }).text().trim();
            var modifier_price = parseFloat(checkbox.data('price') || 0);
            var modifier_set_id = checkbox.data('modifier-set-id') || '';
            
            modifier_html += `
                <div class="product_modifier" style="background: #f8f9fa; border-left: 3px solid #28a745; padding: 5px; margin: 2px 0; border-radius: 3px;">
                    <div class="modifier_name" style="font-weight: bold; color: #28a745;">
                        <i class="fa fa-check-circle text-success"></i> ${modifier_name}
                    </div>
                    <small class="text-muted">
                        (<span class="modifier_price_text">${modifier_price.toFixed(3)}</span> X <span class="modifier_qty_text">1.000</span>)
                    </small>
                    <input type="hidden" name="products[${row_count}][modifier][]" value="${modifier_id}">
                    <input type="hidden" class="modifiers_price" name="products[${row_count}][modifier_price][]" value="${modifier_price.toFixed(3)}">
                    <input type="hidden" class="modifiers_quantity" name="products[${row_count}][modifier_quantity][]" value="1">
                    <input type="hidden" name="products[${row_count}][modifier_set_id][]" value="${modifier_set_id}">
                </div>
            `;
        });
        
        var productRow = $('tr[data-row_index="' + row_count + '"]');
        var modalId = modal.attr('id');
        var modalSpecificContainer = $('#selected_modifiers_' + modalId);
        var fallbackContainer = productRow.find('.modifiers_html .selected_modifiers').last();
        
        var modifiersContainer = modalSpecificContainer.length > 0 ? modalSpecificContainer : fallbackContainer;
        
        if (modifiersContainer.length > 0) {
            if (selected_modifiers.length > 0) {
                modifiersContainer.html(modifier_html);
            } else {
                modifiersContainer.html(`
                    <button type="button" class="btn btn-sm btn-outline-secondary select-modifiers-btn" 
                            title="Click to select modifiers" data-toggle="modal" data-target="#${modalId}">
                        <i class="fa fa-plus-circle"></i> Add Modifiers
                    </button>
                `);
            }
            
            var quantityInput = productRow.find('.pos_quantity');
            if (quantityInput.length > 0) {
                quantityInput.trigger('change');
            }
        } else {
        }
        
    });
    
    $(document).off('click.standard-modifier-btn', '.modifier-btn').on('click.standard-modifier-btn', '.modifier-btn', function(e) {
        var modal = $(this).closest('.modal');
        
        if (modal.find('.instance_index').length > 0) {
            return; 
        }
        
        e.preventDefault();
        var label = $(this);
        var checkbox = label.find('input[type="checkbox"]');
        var icon = label.find('.modifier-icon');
        
        checkbox.prop('checked', !checkbox.prop('checked'));
        
        if (checkbox.prop('checked')) {
            label.removeClass('btn-outline-primary').addClass('btn-success');
            icon.removeClass('fa-square-o').addClass('fa-check-square');
        } else {
            label.removeClass('btn-success').addClass('btn-outline-primary');
            icon.removeClass('fa-check-square').addClass('fa-square-o');
        }
    });
});

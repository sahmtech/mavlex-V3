function price_check_product_row(variation_id = null, purchase_line_id = null, weighing_scale_barcode = null, quantity = 1) {
    var add_via_ajax = true;
    var item_addtn_method = 0;

    if (variation_id != null && $('#item_addition_method').length) {
        item_addtn_method = $('#item_addition_method').val();
    }

    if (item_addtn_method == 0) {
        add_via_ajax = true;
    } else {
        var is_added = false;

        $('#pos_table tbody')
            .find('tr')
            .each(function() {
                var row_v_id = $(this).find('.row_variation_id').val();
                var enable_sr_no = $(this).find('.enable_sr_no').val();
                var modifiers_exist = false;
                if ($(this).find('input.modifiers_exist').length > 0) {
                    modifiers_exist = true;
                }
                if (row_v_id == variation_id && enable_sr_no !== '1' && !modifiers_exist && !is_added) {
                    add_via_ajax = false;
                    is_added = true;
                    $('input#search_product')
                        .focus()
                        .select();
                }
        });
    }

    if (add_via_ajax) {
        $('input#search_product').val('').focus();
        $('#product-details').empty();

        var product_row = $('input#product_row_count').val();
        var location_id = $('input#location_id').val();
        
        $.ajax({
            method: 'GET',
            url: '/price-check/get_product_row/' + variation_id + '/' + location_id,
            async: false,
            data: {
                product_row: product_row,

            },
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('#product-details').html(result.html_content);
                    $('input#product_row_count').val(parseInt(product_row) + 1);

                    var this_row = $('#product-details').find('.product-card').last();
                    pos_each_row(this_row);
                    pos_total_row();
                    __currency_convert_recursively(this_row);

                    $('input#search_product').focus().select();
                } else {
                    toastr.error(result.msg);
                    $('input#search_product').focus().select();
                }
            },
        });
    }
}

if ($('#search_product').length) {
    $('#search_product')
        .autocomplete({
            delay: 1000,
            source: function(request, response) {
      
                var search_fields = [];
                $('.search_fields:checked').each(function(i){
                    search_fields[i] = $(this).val();
                });

                
                $.getJSON(
                    '/products/list',
                    {
                        location_id: $('input#location_id').val(),
                        term: request.term,
                        search_fields: search_fields
                    },
                    response
                );
            },
            minLength: 2,
            response: function(event, ui) {
                if (ui.content.length === 1) {
                    var item = ui.content[0];

                    if ((item.enable_stock == 1) || (item.enable_stock == 0) || is_overselling_allowed || for_so) {
                        price_check_product_row(item.variation_id, null);
                        $(this).autocomplete('close');
                    } else {
                        toastr.error(LANG.out_of_stock);
                        $('input#search_product').select();
                    }
                } else if (ui.content.length == 0) {
                    toastr.error(LANG.no_products_found);
                    $('input#search_product').select();
                } else {
                    response(ui.content);
                }
            },
            focus: function(event, ui) {
                if (ui.item.qty_available <= 0) {
                    return false;
                }
            },
            select: function(event, ui) {
                var searched_term = $(this).val();
                $(this).val(null);
                var purchase_line_id = ui.item.purchase_line_id && searched_term == ui.item.lot_number ? ui.item.purchase_line_id : null;
                price_check_product_row(ui.item.variation_id, purchase_line_id);
            },
        })
        .autocomplete('instance')._renderItem = function(ul, item) {
            var string = '<div>' + item.name;
            if (item.type == 'variable') {
                string += '-' + item.variation;
            }
            var selling_price = item.selling_price;
            if (item.variation_group_price) {
                selling_price = item.variation_group_price;
            }
            string += ' (' + item.sub_sku + ')' + '<br> Price: ' + selling_price;
            if (item.enable_stock == 1) {
                var qty_available = __currency_trans_from_en(item.qty_available, false, false, __currency_precision, true);
                string += ' - ' + qty_available + item.unit;
            }
            string += '</div>';

            return $('<li>').append(string).appendTo(ul);
        };

}if ($('#search_product').length) {
    $('#search_product')
        .autocomplete({
            delay: 1000,
            source: function(request, response) {
               
                var search_fields = [];
                $('.search_fields:checked').each(function(i){
                    search_fields[i] = $(this).val();
                });
                $.getJSON(
                    '/products/list',
                    {
                        location_id: $('input#location_id').val(),
                        term: request.term,
                        search_fields: search_fields
                    },
                    response 
                );
            },
            minLength: 2,
            response: function(event, ui) {
                if (ui.content.length === 1) {
                    var item = ui.content[0];
                    if ((item.enable_stock == 1) ||
                        (item.enable_stock == 0) || is_overselling_allowed || for_so) {
                        price_check_product_row(item.variation_id, null);
                        $(this).autocomplete('close');
                    } else {
                        toastr.error(LANG.out_of_stock);
                        $('input#search_product').select();
                    }
                } else if (ui.content.length == 0) {
                    toastr.error(LANG.no_products_found);
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
                    $(this).val(null);
                    var purchase_line_id = ui.item.purchase_line_id && searched_term == ui.item.lot_number ? ui.item.purchase_line_id : null;
                    price_check_product_row(ui.item.variation_id, purchase_line_id);
                
            },
        })
        .autocomplete('instance')._renderItem = function(ul, item) {
                var string = '<div>' + item.name;
                if (item.type == 'variable') {
                    string += '-' + item.variation;
                }

                var selling_price = item.selling_price;
                if (item.variation_group_price) {
                    selling_price = item.variation_group_price;
                }

                string += ' (' + item.sub_sku + ')' + '<br> Price: ' + selling_price;
                if (item.enable_stock == 1) {
                    var qty_available = __currency_trans_from_en(item.qty_available, false, false, __currency_precision, true);
                    string += ' - ' + qty_available + item.unit;
                }
                string += '</div>';

                return $('<li>')
                    .append(string)
                    .appendTo(ul);
            
        };
}
$('#select_location_id').on('change', function() {
    var selectedLocationId = $(this).val();
    $('#location_id').val(selectedLocationId);
    $('#product-details').empty();
    $('input#search_product').val('').focus();
    
});
function checkWidth() {
    if ($(window).width() < 768) {
        $('.location-group').removeClass('pull-right');
    } else {
        $('.location-group').addClass('pull-right');
    }
}

checkWidth();

$(window).resize(function() {
    checkWidth(); 
    
});
$('input#search_product').select();


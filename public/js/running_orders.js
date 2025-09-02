var isSearching = false; 
    $('.flip-btn').click(function(e) {
        e.stopPropagation();
        var card = $(this).closest('.card');
        card.toggleClass('flipped');
        var card_back = card.find('.card-back');
        var card_front = card.find('.card-front');
        var menu = card.find('.dropdown-toggle')
        card_back.toggleClass('hide');
        card_front.toggleClass('hide');
        menu.toggleClass('hide');
    });

    $('#search-input').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        isSearching = true;
    
        $('.card-wrapper').filter(function() {
            var cardText = $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            if (cardText) {
                $('#search-orders').append($(this)); 
            }
        });
        if (value === '') {
            isSearching = false;
            categorizeOrders();
        }
    });
    
    var serverTime = new Date($('#server-time').val()); 
    var browserTime = new Date();
    var timeOffset = browserTime.getTime() - serverTime.getTime(); 
    
    function update_elapsed_time() {
        if (isSearching) return;
    
        $('.elapsed-time').each(function() {
            var start_time = new Date($(this).data('start-time')); 
            var current_time = new Date(new Date().getTime() - timeOffset); 
            var elapsed_time = current_time - start_time;

    var days = Math.floor(elapsed_time / (1000 * 60 * 60 * 24));
    var hours = Math.floor((elapsed_time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((elapsed_time % (1000 * 60 * 60)) / (1000 * 60));

    var formatted_time = '';
    if (days >= 1) {
        formatted_time = days + 'd ' + hours + 'h ' + minutes + 'm';
    } else {
        formatted_time = hours + 'h ' + minutes + 'm';
    }

    $(this).text(formatted_time);

    var elapsed_minutes = Math.floor(elapsed_time / (1000 * 60));
    $(this).removeClass('green yellow orange red');
    if (elapsed_minutes <= 15) {
        $(this).addClass('green');
    } else if (elapsed_minutes <= 45) {
        $(this).addClass('yellow');
    } else if (elapsed_minutes <= 59) {
        $(this).addClass('orange');
    } else {
        $(this).addClass('red');
    }
});
}

    function sort_cards() {
        
        var cards = $('.card-wrapper').toArray();
        cards.sort(function(a, b) {
            var dateA = new Date($(a).find('.elapsed-time').data('start-time'));
            var dateB = new Date($(b).find('.elapsed-time').data('start-time'));
            return dateB - dateA;
        });
        $('#cards-container').append(cards);
    }
    
function categorizeOrders() {
    if (isSearching) return;
    let newCount = 0, delayedCount = 0, oldCount = 0;
    
    $('.card-wrapper').each(function() {
        var start_time = new Date($(this).find('.elapsed-time').data('start-time'));
        var current_time = new Date();
        var elapsed_hours = Math.floor((current_time - start_time) / (1000 * 60 * 60));
        if (elapsed_hours < 1) {
            $('#new-orders').append($(this));
            newCount++;
        } else if (elapsed_hours >= 1 && elapsed_hours <= 23) {
            $('#delayed-orders').append($(this));
            delayedCount++;
        } else {
            $('#old-orders').append($(this));
            oldCount++;
        }
    });

    $('#new-count').text(newCount > 99 ? '99+' : newCount);
    $('#delayed-count').text(delayedCount > 99 ? '99+' : delayedCount);
    $('#old-count').text(oldCount > 99 ? '99+' : oldCount);
}
setInterval(update_elapsed_time, 60000);
update_elapsed_time();
sort_cards();
categorizeOrders();
setInterval(categorizeOrders, 60000);
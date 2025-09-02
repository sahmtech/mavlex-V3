@php
  $all_notifications = auth()->user()->notifications;
  $unread_notifications = $all_notifications->where('read_at', null);
  $total_unread = count($unread_notifications);
@endphp


<!-- Notification -->
<div class="notification-wrap" id="notification">
    
    <div class="notification-list">
        <div class="notification-heading">
            <h3>@lang('lang_v1.notifications')</h3>
        </div>

        <div class="notification-items" id="notifications_list">
            
        </div>

        @if(count($all_notifications) > 10)
          <div class="notifaction-footer load_more_li">
                <a href="#" class="load_more_notifications">@lang('lang_v1.load_more')</a>
          </div>
        @endif
        
        
    </div>
</div>
<!-- End of Notification -->

<input type="hidden" id="notification_page" value="1">
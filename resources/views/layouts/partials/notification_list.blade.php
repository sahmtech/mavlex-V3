@if(!empty($notifications_data))
  @foreach($notifications_data as $notification_data)
    
    <a href="{{$notification_data['link'] ?? '#'}}" 
      @if(isset($notification_data['show_popup'])) class="show-notification-in-popup list-of-notification" @endif class="list-of-notification">
        <i class="notif-icon {{$notification_data['icon_class'] ?? ''}}"></i>

        <div class="notificiation-content">
            <span class="text">{!! $notification_data['msg'] ?? '' !!}</span>

            <span class="time">{{$notification_data['created_at']}}</span>

        </div>
    </a>
  @endforeach
@else
  <a href="#" class="text-center no-notification notification-li">
    @lang('lang_v1.no_notifications_found')
  </a>
@endif
<div class="box @if(!empty($class)) {{$class}} @else box-solid @endif" id="accordion">
  
  @php
   $closed = true;
  @endphp
  <div id="collapseFilter" class="panel-collapse active collapse @if(empty($closed)) in @endif" aria-expanded="true">
    <div class="box-header with-border" style="cursor: pointer;">
    <h3 class="box-title">
      @if(!empty($icon)) {!! $icon !!} @else @endif {{$title ?? ''}}
    </h3>
  </div>
    <div class="box-body">
      {{$slot}}
    </div>

    <div class="box-footer">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFilter" class="btn bg-navy pull-right">
        <i class="fa fa-times" aria-hidden="true"></i> Close Filter
      </a>
    </div>
  </div>
</div>
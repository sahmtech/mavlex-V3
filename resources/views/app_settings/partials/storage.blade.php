@php $current_disk = $app_settings->storage_default_disk ?? 'local'; $disk = $current_disk; $saved = $app_settings->storage_disks ?? []; @endphp
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('storage_default_disk', __('settings.default_storage_disk')) !!}
            @show_tooltip(__('settings.default_storage_disk_help'))
            <br>
            {!! Form::select(
                'storage_default_disk',
                [
                    'local' => 'local',
                    's3' => 'AWS S3',
                    'wasabi' => 'Wasabi',
                    'r2' => 'Cloudflare R2',
                    'spaces' => 'DigitalOcean Spaces',
                    'minio' => 'MinIO',
                    'b2' => 'Backblaze B2',
                    'linode' => 'Akamai/Linode',
                    'vultr' => 'Vultr',
                    'idrive' => 'IDrive e2',
                    'ovh' => 'OVHcloud',
                    'scaleway'=> 'Scaleway',
                    'hetzner' => 'Hetzner',
                    'exoscale'=> 'Exoscale',
                    'upcloud' => 'UpCloud',
                    'ionos' => 'IONOS',
                    'dreamobjects' => 'DreamObjects',
                    'yandex' => 'Yandex Cloud',
                    'selectel'=> 'Selectel',
                    'lyve' => 'Seagate Lyve Cloud',
                    'contabo' => 'Contabo',
                    'custom' => 'Custom (S3‑compatible)',
                ],
                $current_disk,
                ['id' => 'storage_default_disk', 'class' => 'form-select']
            ) !!}
              </div>
    </div>

    <style>#s3_generic_panel { display: none; }</style>

    <div id="s3_generic_panel" class="col-sm-12 disk-panel s3-generic" data-disk-type="s3" style="display:none">
        <h5 class="mt-4 mb-2">@lang('settings.s3_compatible_settings') (<span id="provider_label">{{ $disk }}</span>)</h5>

        <div id="custom_label_row" class="row g-3" style="display:none">
            <div class="col-sm-4">
                {!! Form::label('s3_label', __('settings.display_label_optional')) !!}
                {!! Form::text("storage_disks[$disk][label]", data_get($saved, "$disk.label"), ['class'=>'form-control','id'=>'s3_label','placeholder'=>__('settings.placeholder_my_s3_provider'),'data-field'=>'label']) !!}
                <small class="text-muted">@lang('settings.display_only_admin_ui')</small>
            </div>
        </div>

            <div class="col-sm-4">
                <div class="form-group">
                {!! Form::label('s3_key', __('settings.access_key')) !!}
                {!! Form::text("storage_disks[$disk][key]", data_get($saved, "$disk.key"), ['class'=>'form-control','id'=>'s3_key','data-field'=>'key']) !!}
            </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                {!! Form::label('s3_secret', __('settings.secret_key')) !!}
                {!! Form::text("storage_disks[$disk][secret]", data_get($saved, "$disk.secret"), ['class'=>'form-control','id'=>'s3_secret','data-field'=>'secret']) !!}
            </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                {!! Form::label('s3_region', __('settings.region')) !!}
                {!! Form::text("storage_disks[$disk][region]", data_get($saved, "$disk.region", 'us-east-1'), ['class'=>'form-control','id'=>'s3_region','data-field'=>'region']) !!}
            </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                {!! Form::label('s3_bucket', __('settings.bucket')) !!}
                {!! Form::text("storage_disks[$disk][bucket]", data_get($saved, "$disk.bucket"), ['class'=>'form-control','id'=>'s3_bucket','data-field'=>'bucket']) !!}
            </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                {!! Form::label('s3_endpoint', __('settings.endpoint')) !!}
                {!! Form::text("storage_disks[$disk][endpoint]", data_get($saved, "$disk.endpoint"), ['class'=>'form-control','id'=>'s3_endpoint','data-field'=>'endpoint','placeholder'=>'https://s3.example.com']) !!}
            </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                {!! Form::label('s3_url', __('settings.cdn_or_custom_domain_optional')) !!}
                {!! Form::text("storage_disks[$disk][url]", data_get($saved, "$disk.url"), ['class'=>'form-control','id'=>'s3_url','data-field'=>'url']) !!}
            </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper d-flex gap-2 mt-4">
                        <p>@lang('settings.disable_http_verify') @show_tooltip(__('settings.disable_http_verify_help'))</p>
                        {{-- hidden fallback so unchecked submits 0 --}}
<input type="hidden" id="http_verify_hidden" name="storage_disks[{{ $disk }}][disable_http_verify]" value="0">

<label class="switch" for="http_verify">
  {!! Form::checkbox("storage_disks[$disk][disable_http_verify]", 1,
      (bool) data_get($saved, "$disk.disable_http_verify", false),
      ['id'=>'http_verify','data-field'=>'disable_http_verify']) !!}
  <div class="sliderCheckbox round"></div>
</label>

                        </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper d-flex gap-2 mt-4">
                        <p>@lang('settings.path_style_endpoint')</p>
                        <label class="switch" for="s3_path">{!! Form::checkbox("storage_disks[$disk][use_path_style_endpoint]", 1, (bool) data_get($saved, "$disk.use_path_style_endpoint", false), ['id'=>'s3_path','data-field'=>'use_path_style_endpoint']) !!}<div class="sliderCheckbox round"></div></label>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper d-flex gap-2 mt-4">
                        <p>@lang('settings.use_signed_urls') @show_tooltip(__('settings.use_signed_urls_help'))</p>
                        <label class="switch" for="s3_signed_urls">{!! Form::checkbox("storage_disks[$disk][signed_urls]", 1, (bool) data_get($saved, "$disk.signed_urls", false), ['id'=>'s3_signed_urls','data-field'=>'signed_urls']) !!}<div class="sliderCheckbox round"></div></label>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                 <div class="form-group">
                {!! Form::label('s3_signed_ttl', __('settings.signed_url_ttl_minutes')) !!}
                {!! Form::number("storage_disks[$disk][signed_ttl]", (int) data_get($saved, "$disk.signed_ttl", 10), ['class'=>'form-control','id'=>'s3_signed_ttl','min'=>1,'data-field'=>'signed_ttl']) !!}
            </div>
            </div>
   
    </div>
</div>

<script>window.BARDPOS_STORAGE_SAVED=@json($saved, JSON_UNESCAPED_SLASHES);window.bardpos_storage_saved=window.BARDPOS_STORAGE_SAVED;</script>

<script>
(function(){
    var provider_presets={s3:{region:'ap-south-1',endpoint:'',path:true},wasabi:{region:'ap-northeast-1',endpoint:'https://s3.ap-northeast-1.wasabisys.com',path:true},r2:{region:'auto',endpoint:'https://<ACCOUNT_ID>.r2.cloudflarestorage.com',path:true},spaces:{region:'nyc3',endpoint:'https://nyc3.digitaloceanspaces.com',path:false},minio:{region:'us-east-1',endpoint:'http://127.0.0.1:9000',path:true},b2:{region:'us-west-000',endpoint:'https://s3.us-west-000.backblazeb2.com',path:true},linode:{region:'us-east-1',endpoint:'https://us-east-1.linodeobjects.com',path:false},vultr:{region:'ewr1',endpoint:'https://ewr1.vultrobjects.com',path:false},idrive:{region:'us-east-1',endpoint:'https://<region>.e2.idrivee2-<cc>.com',path:true},ovh:{region:'gra',endpoint:'https://s3.gra.perf.cloud.ovh.net',path:true},scaleway:{region:'fr-par',endpoint:'https://s3.fr-par.scw.cloud',path:true},hetzner:{region:'fsn1',endpoint:'https://s3.<region>.hetzner.cloud',path:true},exoscale:{region:'ch-gva-2',endpoint:'https://sos-ch-gva-2.exo.io',path:true},upcloud:{region:'fi-hel1',endpoint:'https://fi-hel1.objectstorage.upcloud.com',path:true},ionos:{region:'eu-central-1',endpoint:'https://s3-eu-central-1.ionoscloud.com',path:true},dreamobjects:{region:'us-east-1',endpoint:'https://objects-us-east-1.dream.io',path:true},yandex:{region:'ru-central1',endpoint:'https://storage.yandexcloud.net',path:true},selectel:{region:'ru-1',endpoint:'https://s3.ru-1.storage.selcloud.ru',path:true},lyve:{region:'us-east-1',endpoint:'https://s3.<region>.lyvecloud.seagate.com',path:true},contabo:{region:'eu2',endpoint:'https://eu2.contabostorage.com',path:true},custom:{region:'us-east-1',endpoint:'https://s3.example.com',path:true}};
    var saved_cfg=window.bardpos_storage_saved||{};
    var cache_by_disk={};
    var field_defs=[{id:'s3_key',name:'key'},{id:'s3_secret',name:'secret'},{id:'s3_region',name:'region'},{id:'s3_bucket',name:'bucket'},{id:'s3_endpoint',name:'endpoint'},{id:'s3_url',name:'url'},{id:'s3_path',name:'use_path_style_endpoint',},{id:'http_verify',name:'disable_http_verify'},{id:'s3_signed_urls',name:'signed_urls'},{id:'s3_signed_ttl',name:'signed_ttl'}];
    function get_selected_disk(){var el=document.getElementById('storage_default_disk');return el?el.value:'local'}
    function read_panel_values(){var v={};for(var i=0;i<field_defs.length;i++){var f=field_defs[i];var el=document.getElementById(f.id);if(!el){continue}v[f.name]=f.is_checkbox?!!el.checked:(el.value||'')}return v}
    function merge_values(base,src){for(var k in src){if(src.hasOwnProperty(k)){base[k]=src[k]}}return base}
    function write_panel_values(disk){var preset=provider_presets[disk]||{};var existing=saved_cfg[disk]||{};var values={key:'',secret:'',region:'',bucket:'',endpoint:'',url:'',use_path_style_endpoint:false,disable_http_verify:false,signed_urls:false,signed_ttl:10};merge_values(values,preset);merge_values(values,existing);if(cache_by_disk[disk]){merge_values(values,cache_by_disk[disk])}for(var i=0;i<field_defs.length;i++){var f=field_defs[i];var el=document.getElementById(f.id);if(!el){continue}if(f.is_checkbox){el.checked=!!values[f.name];var hid=f.hidden_id?document.getElementById(f.hidden_id):null;if(hid){hid.value=el.checked?1:0}}else{el.value=(values[f.name]!==undefined&&values[f.name]!==null)?values[f.name]:''}}var custom_row=document.getElementById('custom_label_row');if(custom_row){custom_row.style.display=(disk==='custom')?'block':'none'}}
    function build_nested_name(disk,path){var parts=(path||'').split('.');var name='storage_disks['+disk+']';for(var i=0;i<parts.length;i++){name+='['+parts[i]+']'}return name}
    function remap_input_names(disk){for(var i=0;i<field_defs.length;i++){var f=field_defs[i];var el=document.getElementById(f.id);if(!el){continue}var new_name=build_nested_name(disk,f.name);el.setAttribute('name',new_name);if(f.hidden_id){var hid=document.getElementById(f.hidden_id);if(hid){hid.setAttribute('name',new_name)}}}var label_el=document.getElementById('s3_label');if(label_el){label_el.setAttribute('name','storage_disks['+disk+'][label]')}}
    function toggle_panel(disk){var panel=document.getElementById('s3_generic_panel');var label=document.getElementById('provider_label');if(!panel){return}if(disk==='local'){panel.style.display='none'}else{panel.style.display='block';if(label){label.textContent=disk}}}
    function on_disk_change(prev_disk,next_disk){if(prev_disk&&prev_disk!=='local'){cache_by_disk[prev_disk]=read_panel_values()}toggle_panel(next_disk);if(next_disk!=='local'){write_panel_values(next_disk);remap_input_names(next_disk)}}
    document.addEventListener('DOMContentLoaded',function(){var select_el=document.getElementById('storage_default_disk');var current_disk=select_el?select_el.value:'local';toggle_panel(current_disk);if(current_disk!=='local'){write_panel_values(current_disk);remap_input_names(current_disk)}if(select_el){select_el.addEventListener('change',function(){var next_disk=this.value;on_disk_change(current_disk,next_disk);current_disk=next_disk})}});
})();
</script>

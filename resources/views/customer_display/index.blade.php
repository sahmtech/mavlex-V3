@extends('layouts.blank')
@section('title', __('lang_v1.customer_display'))
   @php
   use App\Models\Business;
   $businessId   = session('user.business_id'); 
   $business     = Business::find($businessId);
   $pos_settings = $business
       ? (is_array($business->pos_settings) ? $business->pos_settings : json_decode($business->pos_settings, true) ?? []) : [];

   $adImages = collect(range(1, 10))
       ->map(fn ($i) => $pos_settings['carousel_image_' . $i] ?? null)
       ->filter()
       ->values();
@endphp

@section('css')
<style>
:root{
    --accent:#006eff;
    --bg-main:#fff;
    --bg-header:#f9fafb;
    --border:#e0e0e0;
    --text-muted:#666;
    --font-family:'Inter',system-ui,sans-serif;
    --label-size:.78rem;
    --value-size:1.25rem;
    --value-weight:700;
    --shadow:0 2px 6px rgba(0,0,0,.08);
}
/* ---------- base layout ---------------------------------------- */
html,body{height:100%}
body{margin:0;background:var(--bg-main);font-family:var(--font-family);overflow:hidden}

.customer-display-wrapper{display:flex;height:100vh;overflow:hidden}
.display-panel{
    flex:0 0 66%;min-width:0;display:flex;flex-direction:column;padding:1rem;border-right:1px solid var(--border)
}
.ads-overlay{
    position:fixed; top:0; right:0;width:33vw;  height:100vh; background:var(--bg-header); display:flex; align-items:flex-start;justify-content:center; 
}
.ad-placeholder{
    width:100%;height:100%;
    border:2px dashed var(--border);
    display:flex;align-items:center;justify-content:center;
    color:var(--text-muted)
}
.ads-overlay .carousel-inner>.item.active,
.ads-overlay .carousel-inner>.item.next,
.ads-overlay .carousel-inner>.item.prev{
    float:none;width:100%; height:100%;display:flex; align-items:center; justify-content:center;
}
.ads-overlay .item img{
   aspect-ratio:520 / 770; max-height:100vh;max-width:100%;width:auto; height:auto;object-fit:contain;display:block; margin:auto;
}
/* ---------- header --------------------------------------------- */
.pos-header{
    display:flex;align-items:center;margin-bottom:.75rem;
}

.heading-wrap{flex:1;text-align:start;}  

.full-screen-btn{
    padding:0;border:0;background:none;cursor:pointer;
    margin-inline-start:auto;
}

.pos-header h1{margin:.15rem 0;font-size:1.35rem}
.pos-header p {margin:0;font-size:.85rem;color:var(--text-muted)}

/* ---------- table ---------------------------------------------- */
.table-responsive{flex:1 1 auto;overflow-y:auto}
#customer-display-table{width:100%;border-collapse:collapse}
#customer-display-table thead{
    position:sticky;top:0;
    background:var(--bg-header);box-shadow:0 1px 0 var(--border)
}
#customer-display-table th,
#customer-display-table td{
    padding:.45rem .6rem;border:1px solid var(--border);
    text-align:center;font-size:.9rem
}
#customer-display-table tbody tr:nth-child(odd){background:#fcfcfc}
.modifier-details{font-size:.8rem;color:var(--text-muted)}

/* ---------- totals --------------------------------------------- */
.totals-container{margin-top:auto}
.totals-bar{
    background:var(--bg-main);box-shadow:var(--shadow);
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(120px,1fr));
    gap:.25rem;padding:.6rem .5rem .35rem
}
.totals-bar:not(:last-child){margin-bottom:.5rem}
.total-item{text-align:center;line-height:1.25}
.total-item .label{display:block;font-size:var(--label-size);font-weight:600;color:var(--text-muted)}
.total-item .value{display:block;margin-top:.12rem;font-size:var(--value-size);font-weight:var(--value-weight)}
#total_payable_big.value{font-size:calc(var(--value-size)*1.4);color:var(--accent)}


</style>
@endsection
@section('content')
@php $is_mobile = isMobile(); @endphp

<div class="customer-display-wrapper">
    <div class="display-panel">
      <header class="pos-header">
         <div class="heading-wrap">
             {!! $pos_settings['display_screen_heading'] !!}
         </div>
     
         <button  id="full_screen"
                  class="btn btn-link full-screen-btn"
                  title="{{ __('lang_v1.full_screen') }}"
                  data-toggle="tooltip" data-placement="bottom">
             <img src="{{ asset('img/icons/full-screen.svg') }}" alt=""
                  style="width:21px">
         </button>
     </header>
     

        <div class="table-responsive" id="customer-display">
            <table id="customer-display-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('lang_v1.product')</th>
                        <th>@lang('sale.price_inc_tax')</th>
                        <th>@lang('sale.discount')</th>
                        <th>@lang('sale.qty')</th>
                        <th>@lang('sale.total')</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                </tbody>
            </table>
        </div>
        <div class="totals-container">
            <div class="totals-bar">
                <div class="total-item">
                    <span class="label">@lang('sale.item')</span>
                    <span id="total_items" class="value">0</span>
                </div>
                <div class="total-item">
                    <span class="label">@lang('lang_v1.total_discount')</span>
                    <span id="total_discount" class="value">0.00</span>
                </div>
                <div class="total-item">
                    <span class="label">@lang('sale.qty')</span>
                    <span id="total_quantity" class="value">0</span>
                </div>
                <div class="total-item"> 
                  <span class="label">@lang('lang_v1.round_off')</span>
                  <span id="round_off" class="value">0</span>
              </div>
                <div class="total-item">
                    <span class="label">@lang('sale.total')</span>
                    <span id="total_amount" class="value">0.00</span>
                </div>
            </div>
            <div class="totals-bar" style="background:var(--bg-header)">
                <div class="total-item">
                    <span class="label">@lang('sale.shipping_charges')</span>
                    <span class="value">+<span id="shipping_charges">0.00</span></span>
                </div>
                <div class="total-item">
                    <span class="label">@lang('sale.order_tax')</span>
                    <span class="value">+<span id="order_tax">0.00</span></span>
                </div>
                @if(in_array('types_of_service',$enabled_modules))
                    <div class="total-item">
                        <span class="label">@lang('lang_v1.packing_charge')</span>
                        <span class="value">+<span id="packing_charge">0.00</span></span>
                    </div>
                @endif
                <div class="total-item">
                    <span class="label">@lang('lang_v1.total_discount')</span>
                    <span class="value">-<span id="total_discount_invoice">0.00</span></span>
                </div>
                <div class="total-item">
                    <span class="label">@lang('lang_v1.redeemed_amount')</span>
                    <span class="value">-<span id="rp_redeemed">0.00</span></span>
                </div>
                <div class="total-item">
                    <span class="label">@lang('sale.total_payable')</span>
                    <span id="total_payable_big" class="value">0.00</span>
                </div>
            </div>

        </div>
      </div>
      <div class="ads-overlay">
         @if ($adImages->isNotEmpty())
            <div id="adsCarousel" class="carousel slide" data-ride="carousel" data-interval="5000" data-pause="hover">
               <ol class="carousel-indicators">
                     @foreach ($adImages as $idx => $img)
                        <li data-target="#adsCarousel"
                           data-slide-to="{{ $idx }}"
                           class="{{ $idx === 0 ? 'active' : '' }}"></li>
                     @endforeach
               </ol>
               <div class="carousel-inner" role="listbox">
                     @foreach ($adImages as $idx => $img)
                        <div class="item {{ $idx === 0 ? 'active' : '' }}">
                           <img src="{{ upload_asset('uploads/carousel_images/'.$img) }}"
                                 class="ads-img" alt="Ad {{ $idx+1 }}">
                        </div>
                     @endforeach
               </div>
               <a class="left carousel-control" href="#adsCarousel" role="button" data-slide="prev">
                     <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                     <span class="sr-only">{{ __('Previous') }}</span>
               </a>
               <a class="right carousel-control" href="#adsCarousel" role="button" data-slide="next">
                     <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                     <span class="sr-only">{{ __('Next') }}</span>
               </a>
            </div>
         @else
            <div class="ad-placeholder">AD&nbsp;SPACE&nbsp;33&nbsp;%</div>
         @endif
      </div>
</div>
@endsection


@section('javascript')
<script>
      const cur = n => __currency_trans_from_en(n,true,false,2);

      function update_customer_display(data){
         const $tbody = $('#customer-display-table tbody').empty();

         if(!data.length){
            $tbody.append(`<tr><td colspan="6">@lang('lang_v1.no_items')</td></tr>`);
            return;
         }

         let t_items=0,t_disc=0,t_qty=0,t_amt=0;

         data.forEach((item,idx)=>{
            t_items++;
            const line_disc  = parseFloat(item.discount)*parseFloat(item.quantity);
            const line_price = parseFloat(item.price)*parseFloat(item.quantity);
            let mod_total=0, mod_html='';

            if(item.modifiers?.length){
                  item.modifiers.forEach(m=>{
                     const mt=m.price*m.quantity;
                     mod_total+=mt;
                     mod_html+=`<div>${m.name}: ${cur(m.price)} × ${m.quantity}</div>`;
                  });
            }

            t_disc += line_disc;
            t_qty  += parseFloat(item.quantity);
            t_amt  += line_price + mod_total;

            $tbody.prepend(`
                  <tr id="row_${item.id}">
                     <td>${idx+1}</td>
                     <td>${item.name}<div class="modifier-details">${mod_html}</div></td>
                     <td>${cur(item.price)}</td>
                     <td>${cur(line_disc)}</td>
                     <td>${item.quantity}</td>
                     <td>${cur(line_price + mod_total)}</td>
                  </tr>
            `);
         });

         $('#total_items').text(t_items);
         $('#total_discount').text(cur(t_disc));
         $('#total_quantity').text(t_qty.toFixed(2));
         $('#total_amount').text(cur(t_amt));
      }

      function update_footer_display(){
         const f = JSON.parse(localStorage.getItem('footerData'))||{};
         $('#shipping_charges').text(cur(f.shipping_charges||0));
         $('#order_tax').text(cur(f.order_tax||0));
         $('#packing_charge').text(cur(f.packing_charge||0));
         $('#total_discount_invoice').text(cur(f.discount_amount||0));
         $('#rp_redeemed').text(cur(f.rp_redeemed_amount||0));
         $('#total_payable_big').text(cur(f.total_payable||0));
         $('#round_off').text(__currency_trans_from_en(f.round_off_amount || 0, true, false, 2));
      }

      function clear_customer_display(){
         $('#customer-display-table tbody').html(`<tr><td colspan="6">@lang('lang_v1.no_items')</td></tr>`);
         ['total_items','total_discount','total_quantity','total_amount',
         'shipping_charges','order_tax','packing_charge',
         'total_discount_invoice','rp_redeemed','total_payable_big','#round_off'
         ].forEach(id=>$('#'+id).text(cur(0)));
      }

      function fetch_pos_data(){
         update_customer_display(JSON.parse(localStorage.getItem('posData'))||[]);
         update_footer_display();
      }

      window.addEventListener('storage',e=>{
         if(e.key==='posDataCleared'&&e.newValue==='true'){clear_customer_display();localStorage.removeItem('posDataCleared')}
         else if(e.key==='posDataUpdated'){fetch_pos_data()}
         else if(e.key==='footerDataUpdated'){update_footer_display()}
      });
      $(document).ready(()=>fetch_pos_data());
</script>
@endsection

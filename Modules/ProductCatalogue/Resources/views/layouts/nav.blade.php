
<div class="storys-container">
<div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'generateQr'])}}"><i class="fa fas fa-qrcode"></i> @lang('productcatalogue::lang.catalogue_qr')</a>
            </div>
</div>
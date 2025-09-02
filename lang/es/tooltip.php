<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Líneas de lenguaje para las herramientas informativas
    |--------------------------------------------------------------------------
    |
    | Las siguientes líneas de lenguaje se utilizan para diversos textos de ayuda.
    |
    */

    'product_stock_alert' => "Productos con bajo inventario.<br/><small class='text-muted'>Basado en la cantidad de alerta del producto establecida en la pantalla de agregar producto.<br> Compre estos productos antes de que se acabe el inventario.</small>",

    'payment_dues' => "Pagos pendientes para compras. <br/><small class='text-muted'>Basado en el plazo de pago del proveedor. <br/> Mostrando pagos a realizar en 7 días o menos.</small>",

    'input_tax' => 'Impuesto total recaudado por ventas durante el período de tiempo seleccionado.',

    'output_tax' => 'Impuesto total pagado por compras durante el período de tiempo seleccionado.',

    'tax_overall' => 'Diferencia entre el impuesto total recaudado y el impuesto total pagado durante el período de tiempo seleccionado.',

    'purchase_due' => 'Monto total no pagado por compras.',

    'sell_due' => 'Monto total a recibir de las ventas',

    'over_all_sell_purchase' => 'Valor negativo = Monto a pagar <br>Valor positivo = Monto a recibir',

    'no_of_products_for_trending_products' => 'Número de productos más populares a comparar en el gráfico a continuación.',

    'top_trending_products' => "Productos más vendidos de tu tienda. <br/><small class='text-muted'>Aplica filtros para conocer los productos populares por categoría, marca, ubicación del negocio, etc.</small>",

    'sku' => "ID único del producto o Unidad de Mantenimiento de Inventario (SKU) <br><br>Déjelo en blanco para generar automáticamente el SKU.<br><small class='text-muted'>Puedes modificar el prefijo del SKU en Configuración del negocio.</small>",

    'enable_stock' => "Habilitar o deshabilitar la gestión de inventario para un producto. <br><br><small class='text-muted'>La gestión de inventario debe deshabilitarse principalmente para servicios. Ejemplo: Corte de cabello, Reparación, etc.</small>",

    'alert_quantity' => "Recibe una alerta cuando el inventario del producto alcance o esté por debajo de la cantidad especificada.<br><br><small class='text-muted'>Los productos con bajo inventario se mostrarán en el tablero - Sección de Alerta de Inventario de Productos.</small>",

    'product_type' => '<b>Producto simple</b>: Producto sin variaciones.
    <br><b>Producto variable</b>: Producto con variaciones como tamaño, color, etc.
    <br><b>Producto combinado</b>: Combinación de múltiples productos, también llamado producto en paquete.',

    'profit_percent' => "Margen de ganancia predeterminado para el producto. <br><small class='text-muted'>(<i>Puedes gestionar el margen de ganancia predeterminado en Configuración del Negocio.</i>)</small>",

    'pay_term' => "Pagos a realizar por compras/ventas dentro del plazo de tiempo dado.<br/><small class='text-muted'>Todos los pagos próximos o vencidos se mostrarán en el tablero - Sección de Pagos Pendientes</small>",

    'order_status' => 'Los productos en esta compra estarán disponibles para la venta solo si el <b>Estado del Pedido</b> es <b>Artículos Recibidos</b>.',

    'purchase_location' => 'Ubicación del negocio donde el producto comprado estará disponible para la venta.',

    'sale_location' => 'Ubicación del negocio desde donde deseas vender',

    'sale_discount' => "Configura el 'Descuento de Venta Predeterminado' para todas las ventas en Configuración del Negocio. Haz clic en el ícono de edición a continuación para agregar/actualizar el descuento.",

    'sale_tax' => "Configura el 'Impuesto de Venta Predeterminado' para todas las ventas en Configuración del Negocio. Haz clic en el ícono de edición a continuación para agregar/actualizar el impuesto del pedido.",

    'default_profit_percent' => "Margen de ganancia predeterminado de un producto. <br><small class='text-muted'>Usado para calcular el precio de venta basado en el precio de compra ingresado.<br/> Puedes modificar este valor para productos individuales al agregarlos.</small>",

    'fy_start_month' => 'Mes de inicio del Año Fiscal para tu negocio',

    'business_tax' => 'Número de impuesto registrado para tu negocio.',

    'invoice_scheme' => "El esquema de facturación significa el formato de numeración de facturas. Selecciona el esquema a usar para esta ubicación del negocio.<br><small class='text-muted'><i>Puedes agregar un nuevo Esquema de Factura en Configuración de Facturas</i></small>",

    'invoice_layout' => "Diseño de factura a usar para esta ubicación del negocio.<br><small class='text-muted'>(<i>Puedes agregar un nuevo <b>Diseño de Factura</b> en <b>Configuración de Facturas</b></i>)</small>",

    'invoice_scheme_name' => 'Dale un nombre corto y significativo al Esquema de Factura.',

    'invoice_scheme_prefix' => 'Prefijo para un Esquema de Factura.<br>Un Prefijo puede ser un texto personalizado o el año actual. Ej: #XXXX0001, #2018-0002',

    'invoice_scheme_start_number' => "Número de inicio para la numeración de facturas. <br><small class='text-muted'>Puedes establecerlo en 1 u otro número desde el cual comenzará la numeración.</small>",

    'invoice_scheme_count' => 'Número total de facturas generadas para el Esquema de Factura',

    'invoice_scheme_total_digits' => 'Longitud del Número de Factura excluyendo el Prefijo de Factura',

    'tax_groups' => 'Grupo de Tasas de Impuestos - definido arriba, para ser utilizado en combinación en las secciones de Compra/Venta.',

    'unit_allow_decimal' => "Los decimales permiten vender los productos relacionados en fracciones.",

    'print_label' => 'Añade productos -> Elige la información a mostrar en las etiquetas -> Selecciona la configuración de código de barras -> Vista previa de etiquetas -> Imprimir',

    'expense_for' => 'Elige el usuario para el cual está relacionado el gasto. <i>(Opcional)</i><br/><small>Ejemplo: Salario de un empleado.</small>',
    
    'all_location_permission' => 'Si se selecciona <b>Todas las ubicaciones</b>, este rol tendrá permiso para acceder a todas las ubicaciones del negocio',

    'dashboard_permission' => 'Si no está marcado, solo se mostrará el mensaje de bienvenida en el inicio.',

    'access_locations_permission' => 'Elige todas las ubicaciones a las que este rol puede acceder. Todos los datos de la ubicación seleccionada solo se mostrarán al usuario.<br/><br/><small>Por ejemplo: Puedes usar esto para definir <i>Gerente de tienda / Cajero / Gerente de inventario / Gerente de sucursal</i> para una ubicación en particular.</small>',

    'print_receipt_on_invoice' => 'Habilitar o deshabilitar la impresión automática de la factura al finalizar',

    'receipt_printer_type' => "<i>Impresión basada en navegador</i>: Mostrar cuadro de diálogo de impresión del navegador con vista previa de la factura<br/><br/> <i>Usar impresora de recibo configurada</i>: Seleccionar una impresora de recibo/térmica configurada para imprimir",

    'adjustment_type' => '<i>Normal</i>: Ajuste por razones normales como fuga, daño, etc. <br/><br/> <i>Anormal</i>: Ajuste por razones como incendio, accidente, etc.',

    'total_amount_recovered' => 'Monto recuperado del seguro o venta de chatarra u otros',

    'express_checkout' => 'Marcar como pagado completamente y finalizar',
    'total_card_slips' => 'Número total de pagos con tarjeta utilizados en este registro',
    'total_cheques' => 'Número total de cheques utilizados en este registro',

    'capability_profile' => "El soporte para comandos y páginas de código varía entre los proveedores y modelos de impresoras. Si no estás seguro, es una buena idea usar el perfil de capacidad 'simple'",

    'purchase_different_currency' => 'Selecciona esta opción si compras en una moneda diferente a la moneda de tu negocio',

    'currency_exchange_factor' => "1 Moneda de Compra = ? Moneda Base <br> <small class='text-muted'>Puedes habilitar/deshabilitar 'Compra en otra moneda' desde la configuración del negocio.</small>",

    'accounting_method' => 'Método de contabilidad',

    'transaction_edit_days' => 'Número de días desde la fecha de la transacción hasta los cuales se puede editar una transacción.',
    'stock_expiry_alert' => "Lista de inventarios que expiran en :days días <br> <small class='text-muted'>Puedes configurar el número de días en Configuración del Negocio </small>",
    'sub_sku' => "SKU es opcional. <br><br><small>Déjelo en blanco para generar automáticamente el SKU.<small>",
    'shipping' => "Configura los detalles y cargos de envío. Haz clic en el ícono de edición a continuación para agregar/actualizar los detalles y cargos de envío."
];

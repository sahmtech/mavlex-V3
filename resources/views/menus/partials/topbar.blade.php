@php use App\Services\MenuRenderer; @endphp

<nav class="horizontal-menu-wrapper" id="mainNav">
    <div class="scroll-container">
  <ul class="horizontal-menu">
    {!! MenuRenderer::html($menus) !!}
  </ul>
    </div>
</nav>

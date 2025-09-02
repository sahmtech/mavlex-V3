@php use App\Services\MenuRenderer; @endphp

<style>
  .tw-size-5{
  width:20px;
  }
  </style>
<!-- Left side column. contains the logo and sidebar -->
<aside class="no-print main-sidebar " id="main-sidebar">
  <!-- Sidebar top -->
  <div class="top">
    <div class="logo">
     @include('layouts.partials.logo')
    </div>
    <!-- Toggle Sidebar Button -->
    <button id="close-btn">
      <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M18.4325 6.90405L6.4325 18.9041" stroke="black" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M6.4325 6.90405L18.4325 18.9041" stroke="black" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
    </button>
  </div>
  <!-- sidebar: style can be found in sidebar.less -->
<div class="sidebar">
      <ul class="links">
          {!! MenuRenderer::html($menus) !!}
      </ul>
  </div>
</aside>

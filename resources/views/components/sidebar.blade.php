<?php
$all_modules = Module::allEnabled();
$modules = array();
foreach ($all_modules as $value) {
    $modules[] = $value->getLowerName();
}
?>
    <!-- Sidebar Nav -->
<aside id="sidebar" class="js-custom-scroll side-nav">
    <ul id="sideNav" class="side-nav-menu side-nav-menu-top-level mb-0">
        @foreach($modules as $module)
            @include($module.'::layouts.sidebar')
        @endforeach
</ul>
</aside>
<!-- End Sidebar Nav -->

<?php
return [
    [
        'icon'=> 'fas fa-tachometer-alt',
        'title'=> 'Dashboard',
        'route'=> 'dashboard.dashboard',
        'badge'=> 'new',
        'active'=> 'dashboard.dashboard',
    ],
    [
        'icon'=> 'far fa-folder',
        'title'=> 'Categories',
        'route'=> 'dashboard.categories.index',
        'active'=> 'dashboard.categories.*',

    ],
    [
        'icon'=> 'far fa-folder',
        'title'=> 'Products',
        'route'=> 'dashboard.products.index',
        'active'=> 'dashboard.products.*',

    ],
];

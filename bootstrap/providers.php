<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class,
    Yajra\DataTables\DataTablesServiceProvider::class,
    Yajra\DataTables\ButtonsServiceProvider::class,
    Yajra\DataTables\HtmlServiceProvider::class,
    RealRashid\SweetAlert\SweetAlertServiceProvider::class,
    Laravel\Socialite\SocialiteServiceProvider::class, // tambahkan ini
    Creativeorange\Gravatar\GravatarServiceProvider::class
];

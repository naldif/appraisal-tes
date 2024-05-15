<?php

namespace App\Enums;

enum RequestStatus: string
{
    case Pending  = 'Menunggu Konfirmasi';
    case Verified = 'Permintaan Diterima';
    case Delivery = 'Barang sedang dikirim';
    case Done     = 'Permintaan Selesai';
}

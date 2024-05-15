<?php

use Illuminate\Support\Carbon;

/** Set Sidebar Active  */

function setSidebarActive($route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'mm-active';
            }
        }
    }
}

function generateKodeBarang() {
    $unique = Str::random(6); // Generate a random string of 6 characters
    $barangCode = 'BRG-' . strtoupper($unique); // Concatenate with 'BRG-' and convert to uppercase
    return $barangCode;
}

function generateInvoice() {
    $unique = Str::random(8); // Generate a random string of 6 characters
    $invoice = 'INV-' . strtoupper($unique); // Concatenate with 'BRG-' and convert to uppercase
    return $invoice;
}

function generateKartuStok() {
    $unique = Str::random(6); // Generate a random string of 6 characters
    $invoice = 'KSB-' . strtoupper($unique); // Concatenate with 'BRG-' and convert to uppercase
    return $invoice;
}

function uploadFile($inputName, $type, $model=null){
    try{
        if(request()->hasFile($inputName)){

            if (isset($model->{$inputName})) {
                Storage::disk('public')->delete($model->{$inputName});
            }

            $file = request()->file($inputName);
            $path = $file->store($type, 'public');

            return $path;
        }
    }catch(\Exception $e){
        throw $e;
    }
}

function avatar($fileName){
    'https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $fileName) . '&background=4e73df&color=ffffff&size=100';
}


/** Delete file */

function deleteFileIfExist($filePath){
    try{
         if ($filePath) {
            Storage::disk('public')->delete($filePath);
        }
    }catch(\Exception $e){
        throw $e;
    }
}

/** Format Uang */
function format_uang($angka)
{
    $hasil = number_format($angka,0,',','.');
    return $hasil;
}

function format_tanggal($value)
{
    $newDate = Carbon::createFromFormat('Y-m-d', $value)->format('l, d F Y');
    return $newDate;
}

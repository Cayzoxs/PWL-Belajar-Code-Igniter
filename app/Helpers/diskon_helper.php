<?php

if (!function_exists('hitung_diskon')) {
    /**
     * * @param int 
     * @return array
     */
    function hitung_diskon($total_harga)
    {
        $persen_diskon = 0;

        if ($total_harga >= 50000000) {
            $persen_diskon = 20;
        } elseif ($total_harga >= 25000000) {
            $persen_diskon = 12;
        } elseif ($total_harga >= 15000000) {
            $persen_diskon = 7;
        } elseif ($total_harga >= 5000000) {
            $persen_diskon = 3;
        } else {
            $persen_diskon = 0;
        }

        $nilai_diskon = ($persen_diskon / 100) * $total_harga;

        return [
            'persen' => $persen_diskon,
            'nilai'  => $nilai_diskon
        ];
    }
}
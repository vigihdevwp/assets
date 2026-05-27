<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Enums;

/**
 * Tipe asset
 * 
 * Enum ini mendefinisikan berbagai tipe asset yang dapat digunakan
 * dalam sistem, seperti jQuery, style, app, dan nonce-script.
 * 
 * @enum
 * @method string value() Mendapatkan value string
 */
enum AssetType: string
{
    /**
     * jQuery asset di gunakan untuk memuat jQuery.
     */
    case JQUERY_ASSET = 'jquery.asset';
    /**
     * Style asset di gunakan untuk memuat style CSS.
     */
    case STYLE_ASSET = 'style.asset';
    /**
     * App asset di gunakan untuk memuat script utama aplikasi.
     */
    case APP_ASSET = 'app.asset';
    /**
     * Nonce-script asset di gunakan untuk memuat script dengan nonce.
     */
    case NONCE_SCRIPT_ASSET = 'nonce-script.asset';
}

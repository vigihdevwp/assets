<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Support;

final class AssetHelper
{
    /**
     * Check if the path is a directory.
     * 
     * @param string $path The path to check.
     * @return bool Whether the path is a directory.
     */
    public static function isDir(string $path): bool
    {
        return is_dir($path);
    }

    /**
     * Check if the path is a file.
     * 
     * @param string $path The path to check.
     * @return bool Whether the path is a file.
     */
    public static function isFile(string $path): bool
    {
        return is_file($path) && is_readable($path);
    }

    /**
     * Check if the path is a URL.
     * 
     * @param string $path The path to check.
     * @return bool Whether the path is a URL.
     */
    public static function isUrl(string $path): bool
    {
        return filter_var($path, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Resolve the handle from the path.
     * 
     * @param string $path The path to resolve the handle from.
     * @return string The handle.
     */
    public static function resolveHandle(string $path): string
    {
        if (self::isUrl($path)) {
            $path = parse_url($path, PHP_URL_PATH);
            return (string)pathinfo($path, PATHINFO_FILENAME);
        }
        return (string)pathinfo($path, PATHINFO_FILENAME);
    }

    /**
     * Generate a unique ID from the path.
     * 
     * @param string ...$args The arguments to generate the ID.
     * @return string The unique ID.
     */
    public static function cid(...$args): string
    {
        $arg = implode('-', $args);
        return sprintf("%u", crc32($arg));
    }

    /**
     * Get the filename from the path.
     * 
     * @param string $path The path to get the filename from.
     * @return string The filename.
     */
    public static function getFilename(string $path): string
    {
        return (string)pathinfo($path, PATHINFO_FILENAME);
    }

    public static function isLocalUrl(string $url): bool
    {
        if (!self::isUrl($url)) {
            return false;
        }

        $host = parse_url($url, PHP_URL_HOST);
        $localhost = parse_url(site_url(), PHP_URL_HOST);
        return $host === $localhost;
    }
}

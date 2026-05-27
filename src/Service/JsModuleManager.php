<?php

declare(strict_types=1);

namespace VigihdevWP\Assets\Service;

use VigihdevWP\Assets\Contracts\Manager\JsModuleManagerInterface;
use VigihdevWP\Assets\Contracts\JsModuleInterface;
use VigihdevWP\Assets\DTOs\JsModuleDto;
use VigihdevWP\Assets\Exceptions\WpAssetsException;
use VigihdevWP\Assets\Support\AssetHelper;

final class JsModuleManager implements JsModuleManagerInterface
{

    /**
     * @param JsModuleDto $jsModule
     */
    public function __construct(
        private readonly JsModuleInterface $jsModule,
    ) {

        if (!AssetHelper::isDir($this->jsModule->getBasepath())) {
            throw WpAssetsException::directoryNotFound((string) $this->jsModule->getBasepath());
        }
    }

    public function publish(): void
    {

        if (empty($this->jsModule->getJs())) {
            return;
        }

        $hash = AssetHelper::cid($this->jsModule->getBasepath());
        add_action('wp_enqueue_scripts', function () use ($hash) {
            foreach ($this->jsModule->getJs() as $index => $js) {
                wp_enqueue_script(
                    handle: "{$hash}-" . (string) ($index + 1),
                    src: $this->jsModule->getBaseUrl() . "/{$js}",
                    deps: $this->jsModule->getDepends(),
                    ver: $this->jsModule->getVersion(),
                    args: $this->jsModule->getJsOptions()->toArray(),
                );
            }
        });

        add_filter('script_loader_tag', function ($tag, $handle, $src) use ($hash) {
            if (is_string($handle) && substr($handle, 0, strlen((string)$hash)) === $hash) {
                return str_replace('text/javascript', 'module', $tag);
            }
            return $tag;
        }, 10, 3);
    }
}

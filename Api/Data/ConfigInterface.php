<?php
/**
 * @category    Meilisearch
 * @package     Meilisearch_Search
 * @author      Jonatan Santos <jonatan.zarowny@gmail.com>
 */
declare(strict_types=1);

namespace Meilisearch\Search\Api\Data;

interface ConfigInterface
{
    /**
     * Return the server hostname.
     *
     * @return ?string
     **/
    public function getServerHostname(): ?string;

    /**
     * Return the server port.
     *
     * @return ?string
     **/
    public function getServerPort(): ?string;

    /**
     * Return the index prefix.
     *
     * @return ?string
     **/
    public function getIndexPrefix(): ?string;

    /**
     * Return the current index.
     *
     * @return ?string
     **/
    public function getCurrentIndex(): ?string;

    /**
     * Return if the auth is enabled or not.
     *
     * @return bool
     **/
    public function isEnableAuth(): bool;

    /**
     * Return the master key.
     *
     * @return ?string
     **/
    public function getMasterKey(): ?string;

    /**
     * Return the server timeout.
     *
     * @return ?string
     **/
    public function getServerTimeout(): ?string;
}

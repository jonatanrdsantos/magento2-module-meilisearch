<p align="center">
  <img src="https://raw.githubusercontent.com/meilisearch/integration-guides/main/assets/logos/meilisearch_magento.svg" alt="Meilisearch-Magento" width="200" height="200" />
</p>

<h1 align="center">Magento2 module Meiliserch</h1>

<h4 align="center">
  <a href="https://github.com/meilisearch/meilisearch">Meilisearch</a> |
  <a href="https://docs.meilisearch.com">Documentation</a> |
  <a href="https://discord.meilisearch.com">Discord</a> |
  <a href="https://roadmap.meilisearch.com/tabs/1-under-consideration">Roadmap</a> |
  <a href="https://www.meilisearch.com">Website</a> |
  <a href="https://docs.meilisearch.com/faq">FAQ</a>
</h4>

<p align="center">
 <!-- <a href="https://packagist.org/packages/meilisearch/meilisearch-magento"><img src="https://img.shields.io/packagist/v/meilisearch/meilisearch-magento" alt="Latest Stable Version"></a>
  <a href="https://github.com/meilisearch/meilisearch-magento/actions"><img src="https://github.com/meilisearch/meilisearch-magento/workflows/Tests/badge.svg" alt="Test"></a>
  <a href="https://github.com/meilisearch/meilisearch-magento/blob/main/LICENSE"><img src="https://img.shields.io/badge/license-MIT-informational" alt="License"></a> -->
</p>

**Meilisearch** is an open-source search engine. [Learn more about Meilisearch.](https://github.com/meilisearch/Meilisearch)

    ``meilisearch/module-search``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Search that works

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Meilisearch`
 - Enable the module by running `php bin/magento module:enable Meilisearch_Search`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require meilisearch/module-search`
 - enable the module by running `php bin/magento module:enable Meilisearch_Search`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration




## Specifications




## Attributes




<?php
/**
 * @brief related, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Pep, Nicolas Roudaire and contributors
 *
 * @copyright GPL-2.0 [https://www.gnu.org/licenses/gpl-2.0.html]
 */

declare(strict_types=1);

namespace Dotclear\Plugin\related;

use Dotclear\App;
use Dotclear\Core\Process;

class Manage extends Process
{
    private static $active_part = 'pages';

    public static function init(): bool
    {
        if (My::checkContext(My::MANAGE)) {
            $default_part                       = My::settings()->active ? 'pages' : 'order';
            self::$active_part                  = $_REQUEST['part'] ?? $default_part;
            App::backend()->related_default_tab = self::$active_part;

            if (self::$active_part === 'pages') {
                self::status(ManageRelatedPages::init());
            } elseif (self::$active_part === 'page') {
                self::status(ManagePage::init());
            } else {
                self::status(true);
            }
        }

        return self::status();
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        if (self::$active_part === 'pages') {
            self::status(ManageRelatedPages::process());
        } elseif (self::$active_part === 'page') {
            self::status(ManagePage::process());
        }

        return true;
    }

    public static function render(): void
    {
        if (!self::status()) {
            return;
        }

        if (self::$active_part === 'pages') {
            ManageRelatedPages::render();
        } elseif (self::$active_part === 'page') {
            ManagePage::render();
        }
    }
}

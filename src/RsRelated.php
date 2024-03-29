<?php
/*
 *  -- BEGIN LICENSE BLOCK ----------------------------------
 *
 *  This file is part of Related, a plugin for DotClear2.
 *
 *  Licensed under the GPL version 2.0 license.
 *  See LICENSE file or
 *  http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 *  -- END LICENSE BLOCK ------------------------------------
 */

namespace Dotclear\Plugin\related;

use Dotclear\Core\Auth;
use Dotclear\Plugin\pages\Pages;
use Dotclear\App;

class RsRelated
{
    public static function isEditable($rs): bool
    {
        if (App::auth()->check(App::auth()->makePermissions([Auth::PERMISSION_CONTENT_ADMIN]), App::blog()->id())) {
            return true;
        }

        if (!$rs->exists('user_id')) {
            return false;
        }

        if (App::auth()->check(App::auth()->makePermissions([Pages::PERMISSION_PAGES]), App::blog()->id())
            && $rs->user_id == App::auth()->userID()) {
            return true;
        }

        return false;
    }

    public static function isDeletable($rs): bool
    {
        if (App::auth()->check(App::auth()->makePermissions([Auth::PERMISSION_CONTENT_ADMIN]), App::blog()->id())) {
            return true;
        }

        if (!$rs->exists('user_id')) {
            return false;
        }

        if (App::auth()->check(App::auth()->makePermissions([Pages::PERMISSION_PAGES]), App::blog()->id())
            && $rs->user_id == App::auth()->userID()) {
            return true;
        }

        return false;
    }

    public static function getRelatedFilename($rs)
    {
        if (is_null(App::blog()->settings()->related->files_path)) {
            return false;
        }

        $meta_rs = App::meta()->getMetaRecordset($rs->post_meta, 'related_file');

        if (!$meta_rs->isEmpty()) {
            $filename = App::blog()->settings()->related->files_path . '/' . $meta_rs->meta_id;
            if (is_readable($filename)) {
                return $filename;
            } else {
                return false;
            }
        }

        return false;
    }

    public static function getPosition($rs)
    {
        if (is_null(App::blog()->settings()->related->files_path)) {
            return false;
        }

        $meta_rs = App::meta()->getMetaRecordset($rs->post_meta, 'related_position');

        if (!$meta_rs->isEmpty()) {
            return (int)$meta_rs->meta_id;
        }

        return -1;
    }
}

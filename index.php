<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of Related, a plugin for DotClear2.
#
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_CONTEXT_ADMIN')) return;

if (!empty($_REQUEST['do']) && $_REQUEST['do'] == 'edit') {
    include_once dirname(__FILE__).'/inc/page.php';
} else {
    include_once dirname(__FILE__).'/inc/panel.php';
}

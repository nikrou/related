<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
#
# This file is part of Related, a plugin for DotClear2.
#
# Copyright(c) 2014-2016 Nicolas Roudaire <nikrou77@gmail.com> http://www.nikrou.net
#
# Copyright (c) 2006-2010 Pep and contributors.
# Licensed under the GPL version 2.0 license.
# See LICENSE file or
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_RC_PATH')) return;

$self_ns = $core->blog->settings->addNamespace('related');
if ($self_ns->active) {
    $core->addBehavior('coreBlogGetPosts', array('relatedPublicBehaviors', 'coreBlogGetPosts'));
    $core->addBehavior('publicBeforeDocument', array('relatedPublicBehaviors', 'addTplPath'));
    $core->addBehavior('templateBeforeBlock', array('relatedPublicBehaviors', 'templateBeforeBlock'));
    $core->addBehavior('sitemapsURLsCollect', array('relatedPublicBehaviors', 'sitemapsURLsCollect'));
    $core->addBehavior('initWidgets', array('widgetsRelated', 'init'));

    $core->tpl->addValue('EntryContent', array('relatedTemplates', 'PageContent'));
}

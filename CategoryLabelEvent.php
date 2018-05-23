<?php

/*
 * This file is part of the CategoryLabel
 *
 * Copyright (C) 2018 StringTech Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CategoryLabel;

use Eccube\Application;
use Eccube\Event\EventArgs;

class CategoryLabelEvent
{
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param EventArgs $event
     */
    public function onFrontBlockSearchProductIndexInitialize(EventArgs $event)
    {
        $builder = $event->getArgument('builder');

        $Categories = $this->app['eccube.repository.category']->getList(null, true);

        $builder->add('category_id', 'entity', [
            'class' => 'Eccube\Entity\Category',
            'property' => 'NameWithLevel',
            'choices' => $Categories,
            'empty_value' => '全部分类',
            'empty_data' => null,
            'required' => false,
            'label' => '',
        ]);
    }
}

<?php

return array(
    'db' => array(
        'table' => 'vis_subscribe_entities',
        'order' => array(
            'priority' => 'asc',
        ),
        'pagination' => array(
            'per_page' => array(
                10 => '10',
                20 => '20',
                50 => '50',
                100 => '100',
                9999999 => 'Все'
            ),
            'uri' => '/admin/vis_subscribe_entities',
        ),
    ),
    'options' => array(
        'caption' => 'Типы подписок',
        'ident' => 'subscribe-entities',
        'form_ident' => 'subscribe-entities-form',
        'form_width' => '920px',
        'table_ident' => 'subscribe-entities-table',
        'action_url' => '/admin/handle/vis_subscribe_entities',
        'not_found' => 'NOT FOUND',
        'is_sortable' => true,
        'model' => 'Vis\SubscribeManager\SubscribeEntity',
        'handler'   => 'Vis\Builder\Helpers\SlugHandler'
    ),
    'cache' => array(
        'tags' => array('vis_subscribe_entities'),
    ),
    'fields' => array(
        'id' => array(
            'caption' => 'ID',
            'type' => 'readonly',
            'class' => 'col-id',
            'width' => '1%',
            'hide' => true,
            'is_sorting' => true
        ),
        'title' => array(
            'caption' => 'Название',
            'type' => 'text',
            'filter' => 'text',
            'is_sorting' => true,
            'field' => 'string',
            'width' => "35%",
            'tabs' => config('translations.config.languages'),
        ),
        'slug' => array(
            'caption' => 'Слаг',
            'type' => 'readonly',
            'filter' => 'text',
            'field' => 'string',
            'width' => "25%",
            'is_sorting' => true
        ),
        'is_active' => array(
            'caption' => 'Активность',
            'type' => 'checkbox',
            'options' => array(
                0 => 'Активна',
                1 => 'Неактивна',
            ),
        ),
        'created_at' => array(
            'caption' => 'Дата создания',
            'type' => 'readonly',
            'hide' => true,
            'hide_list' => true,
            'is_sorting' => true,
            'months' => 2
        ),
        'updated_at' => array(
            'caption' => 'Дата обновления',
            'type' => 'readonly',
            'hide' => true,
            'hide_list' => true,
            'is_sorting' => true,
            'months' => 2
        ),
    ),

    'filters' => array(

    ),
    'actions' => array(
        'search' => array(
            'caption' => 'Поиск',
            'check' => function() {
                return Sentinel::hasAccess('admin.vis_subscribe_entities.view');
            }
        ),
        'insert' => array(
            'caption' => 'Добавить',
            'check' => function() {
                return Sentinel::hasAccess('admin.vis_subscribe_entities.create');
            }
        ),
        'clone' => array(
            'caption' => 'Клонировать',
            'check' => function() {
                return Sentinel::hasAccess('admin.vis_subscribe_entities.create');
            }
        ),
        'update' => array(
            'caption' => 'Редактировать',
            'check' => function() {
               return Sentinel::hasAccess('admin.vis_subscribe_entities.update');
            }
        ),
        'delete' => array(
            'caption' => 'Удалить',
            'check' => function() {
                return Sentinel::hasAccess('admin.vis_subscribe_entities.delete');
            }
        ),
    ),
);

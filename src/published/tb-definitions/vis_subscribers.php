<?php

return array(
    'db' => array(
        'table' => 'vis_subscribers',
        'order' => array(
            'id' => 'desc',
        ),
        'pagination' => array(
            'per_page' => array(
                10 => '10',
                20 => '20',
                50 => '50',
                100 => '100',
                9999999 => 'Все'
            ),
            'uri' => '/admin/vis_subscribers',
        ),
    ),
    'options' => array(
        'caption' => 'Подписчики',
        'ident' => 'vis_subscribers',
        'form_ident' => 'vis_subscribers-form',
        'form_width' => '920px',
        'table_ident' => 'vis_subscribers-table',
        'action_url' => '/admin/handle/vis_subscribers',
        'not_found' => 'NOT FOUND',
        'model' => 'Vis\SubscribeManager\Subscriber',
    ),
    'cache' => array(
        'tags' => array('vis_subscribers'),
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
        'email' => array(
            'caption' => 'E-mail',
            'type' => 'text',
            'filter' => 'text',
            'is_sorting' => true,
            'field' => 'string',
            'width' => "35%",
            'readonly_for_edit' => true,
        ),
        'lang' => array(
            'caption' => 'Язык',
            'type' => 'select',
            'options' => function () {
                return array_flip(config('translations.config.alt_langs'));
            },
            'filter' => 'select',
        ),
        'many2many_entities' => array(
            'caption' => 'Подписки',
            'type' => 'many_to_many',
            'show_type' => 'checkbox',
            'divide_columns' => 3,
            'mtm_table' => 'vis_subscribers2vis_subscribe_entities',
            'mtm_key_field' => 'subscriber_id',
            'mtm_external_foreign_key_field' => 'id',
            'mtm_external_key_field' => 'subscribe_entity_id',
            'mtm_external_value_field' => 'title',
            'mtm_external_table' => 'vis_subscribe_entities',
            'additional_where' => array(
                'vis_subscribe_entities.is_active' => array(
                    'sign'  => '=',
                    'value' => '1'
                )
            ),
            'mtm_external_order' => array(
                'vis_subscribe_entities.priority' => 'ASC',
            ),
        ),
        'is_active' => array(
            'caption' => 'Подписка активна',
            'type' => 'checkbox',
            'options' => array(
                1 => 'Активные',
                0 => 'He aктивные',
            ),
            'field' => 'tinyInteger',
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
    'export' => array(
        'caption'  => 'Экспорт',
        'filename' => 'exp',
        'width'    => '300',
        'date_range_field' => 'created_at',
        'buttons' => array(
            'xls' => array(
                'caption' => 'в XLS',
            ),
        ),
        'check' => function() {
            return true;
        }
    ),
    'filters' => array(

    ),
    'actions' => array(
        'search' => array(
            'caption' => 'Поиск',
            'check' => function() {
                return Sentinel::hasAccess('admin.vis_subscribers.view');
            }
        ),
        'insert' => array(
            'caption' => 'Добавить',
            'check' => function() {
                return Sentinel::hasAccess('admin.vis_subscribers.create');
            }
        ),
        'update' => array(
            'caption' => 'Редактировать',
            'check' => function() {
                return Sentinel::hasAccess('admin.vis_subscribers.update');
            }
        ),
        'delete' => array(
            'caption' => 'Удалить',
            'check' => function() {
                return Sentinel::hasAccess('admin.vis_subscribers.delete');
            }
        ),
    ),
);

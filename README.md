Subscribing package for VIS cms

Разделы
1. [Установка](#Установка)
2. [VIS-CMS](#VIS-CMS)
3. [Настройка](#Настройка)
4. [Пример использования](#Пример-использования)
5. [Описание классов](#Описание-классов)

## Установка
Выполняем
```json
    composer require "vis/subscribe_manager_l5":"1.*"
```

Добавляем SubscribeManagerServiceProvider в массив ServiceProviders в config/app.php
```php
    Vis\SubscribeManager\SubscribeManagerServiceProvider::class,
```

Выполняем миграцию таблиц
```json
   php artisan migrate --path=vendor/vis/subscribe_manager_l5/src/Migrations
```

Публикуем view, js, config
```json
    php artisan vendor:publish --provider="Vis\SubscribeManager\SubscribeManagerServiceProvider" --force
```

Добавляем в layouts.default(или на конкретную вьюху, если подписка только на одной странице) перед закрывающим тегом body
```php
    @include('subscribe_manager::subscribe_manager')
```

## Настройка
В файле public/js/subscriber_rules.js определяем форму(ы), которая будет отправлять имейлы на подписку.
```js
SubscribeManager.setForms(['quick_subscribe']);
```

В файле public/js/subscriber_rules.js переопределяем методы и указываем в них свои действия(например, вызов попапа с кастомным сообщением) по выполнению ajax запроса
```js
SubscribeManager.successCallback = function (message) {
};

SubscribeManager.failCallback = function (message) {
};
```

## VIS-CMS
В \config\builder\admin.php дописываем массив
```php
array(
    'title' => 'Подписки',
    'icon'  => 'group',
    'check' => function() {
        return Sentinel::hasAccess('admin.vis_subscribers.view');
    },
    'submenu' => array(
        array(
            'title' => 'Подписчики',
            'link'  => '/vis_subscribers', 
            'check' => function() {
                return Sentinel::hasAccess('admin.vis_subscribers.view');
            }
        ),
        array(
            'title' => 'Типы подписок',
            'link'  => '/vis_subscribe_entities',
            'check' => function() {
                return Sentinel::hasAccess('admin.vis_subscribe_entities.view');
            }
        ),
    )
),
```

Добавляем права доступа в config/builder/tb-definitions/groups.php и добавляем их к группам.
```php
    'Подписчики' => array(
        'admin.vis_subscribers.view'   => 'Просмотр',
        'admin.vis_subscribers.create' => 'Создание',
        'admin.vis_subscribers.update' => 'Редактирование',
        'admin.vis_subscribers.delete' => 'Удаление',
    ),
    'Типы подписок' => array(
        'admin.vis_subscribe_entities.view'   => 'Просмотр',
        'admin.vis_subscribe_entities.create' => 'Создание',
        'admin.vis_subscribe_entities.update' => 'Редактирование',
        'admin.vis_subscribe_entities.delete' => 'Удаление',
    ),
```
## Пример использования
1. Создаем паршал с формой подписки, например:
```html
@if(isset($subscribeEntities) && $subscribeEntities->count())
    <section class="subscribe-block">
        <div class="container">
            <form id="quick_subscribe-form">
                <input type="text" name="email" class="input-field" placeholder="E-mail" maxlength="255">
                <select name="entity_id">
                    @foreach($subscribeEntities as $subscribeEntity)
                        <option value="{{$subscribeEntity->id}}">{{$subscribeEntity->title}}</option>
                    @endforeach
                </select>
                <button class="btn">{{__t('Підписатися')}}</button>
            </form>
        </div>
    </section>
@endif
```

2. Передаем в форму подписки список возможных сущностей на подписку через вью-композер
```php
    View::composer('partials.subscribe', function ($view) {
        $subscribeEntities = Cache::tags('vis_subscribe_entities')->rememberForever('vis_subscribe_entities', function() {
            return Vis\SubscribeManager\SubscribeEntity::active()->get();
        });
    
        $view->with('subscribeEntities', $subscribeEntities);
    });
```


Если нужно использовать в каких-то своих целях
```php
    use Vis\SubscribeManager\Subscriber;
```

Получить список подписчиков на определенную сущность на выбранном языке:.
```php
   $subscribers = Subscriber::filterEntitySlug($entitySlug)->filterLang($lang)->active->get();
```

## Описание классов
1. Vis\SubscribeManager\SubscribeEntity <br>
Класс сущностей подписки, наследует Eloquent\Model и использует Vis\Builder\Helpers\Traits\TranslateTrait <br>
```php
    namespace Vis\SubscribeManager;
    
    use Illuminate\Database\Eloquent\Model;
    
    class SubscribeEntity extends Model
    {
        use \Vis\Builder\Helpers\Traits\TranslateTrait;
       
        protected $table = 'vis_subscribe_entities';
    }
```

**Описание свойств:**

Имя используемой таблицы </br> 
Значение: строка'
```php
	protected $table = 'vis_subscribe_entities';
```

**Описание методов:**

Метод Eloquent ManyToMany связи с подписчиками</br>
Возвращаемое значение: коллекция связанных с сущностью подписчиков
```php
    public function subscribers()
```

Метод фильтр по слагу</br>
```php
    public function scopeFilterSlug($query, $slug)
```

Метод фильтр по активности записей</br>
```php
    public function scopeActive($query)
```


2. Vis\SubscribeManager\Subscriber <br>
Класс сущностей подписки, наследует Eloquent\Model и использует Vis\Builder\Helpers\Traits\TranslateTrait <br>
```php
    
    namespace Vis\SubscribeManager;

    use Illuminate\Database\Eloquent\Model;
    
    class Subscriber extends Model
    {   
       protected $table = 'vis_subscribers';
    }
```

**Описание свойств:**

Имя используемой таблицы </br> 
Значение: строка'
```php
	protected $table = 'vis_subscribers';
```

**Описание методов:**

Метод Eloquent ManyToMany связи с сущностями подписки</br>
Возвращаемое значение: коллекция связанных сущностей к подписчику
```php
    public function entities()
```

Метод фильтр по слагу</br>
```php
    public function scopeFilterEntitySlug($query, $entitySlug)
```

Метод фильтр по активности подписки</br>
```php
    public function scopeActive($query)
```

Метод фильтр по языку подписки</br>
```php
    public function scopeFilterLang($query, $lang)
```

Метод фильтр по имейлу подписки</br>
```php
    public function scopeFilterEmail($query, $email)
```

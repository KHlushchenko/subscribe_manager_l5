{!!  Minify::javascript(array(
    '/packages/vis/subscribe_manager/subscribe_manager.js',
    '/js/subscribe_manager_rules.js'
))  !!}

<script>
    SubscribeManager.setLangPrefix('{{App::getLocale() !== config('translations.config.def_locale') ? "/" . App::getLocale() : ''}}')

    $(document).ready(function () {
        SubscribeManager.init();
    });
</script>

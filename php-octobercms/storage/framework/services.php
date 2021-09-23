<?php return array (
  'providers' => 
  array (
    0 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    1 => 'Illuminate\\Bus\\BusServiceProvider',
    2 => 'Illuminate\\Cache\\CacheServiceProvider',
    3 => 'Illuminate\\Cookie\\CookieServiceProvider',
    4 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
    5 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
    6 => 'Illuminate\\Hashing\\HashServiceProvider',
    7 => 'Illuminate\\Pagination\\PaginationServiceProvider',
    8 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
    9 => 'Illuminate\\Queue\\QueueServiceProvider',
    10 => 'Illuminate\\Redis\\RedisServiceProvider',
    11 => 'Illuminate\\Session\\SessionServiceProvider',
    12 => 'Illuminate\\Validation\\ValidationServiceProvider',
    13 => 'Illuminate\\View\\ViewServiceProvider',
    14 => 'Jenssegers\\Date\\DateServiceProvider',
    15 => 'Laravel\\Tinker\\TinkerServiceProvider',
    16 => 'Carbon\\Laravel\\ServiceProvider',
    17 => 'Laravel\\Tinker\\TinkerServiceProvider',
    18 => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    19 => 'October\\Rain\\Database\\DatabaseServiceProvider',
    20 => 'October\\Rain\\Halcyon\\HalcyonServiceProvider',
    21 => 'October\\Rain\\Filesystem\\FilesystemServiceProvider',
    22 => 'October\\Rain\\Parse\\ParseServiceProvider',
    23 => 'October\\Rain\\Html\\HtmlServiceProvider',
    24 => 'October\\Rain\\Html\\UrlServiceProvider',
    25 => 'October\\Rain\\Network\\NetworkServiceProvider',
    26 => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
    27 => 'October\\Rain\\Flash\\FlashServiceProvider',
    28 => 'October\\Rain\\Mail\\MailServiceProvider',
    29 => 'October\\Rain\\Argon\\ArgonServiceProvider',
    30 => 'System\\ServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Illuminate\\Cookie\\CookieServiceProvider',
    1 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
    2 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
    3 => 'Illuminate\\Pagination\\PaginationServiceProvider',
    4 => 'Illuminate\\Session\\SessionServiceProvider',
    5 => 'Illuminate\\View\\ViewServiceProvider',
    6 => 'Jenssegers\\Date\\DateServiceProvider',
    7 => 'Carbon\\Laravel\\ServiceProvider',
    8 => 'October\\Rain\\Database\\DatabaseServiceProvider',
    9 => 'October\\Rain\\Halcyon\\HalcyonServiceProvider',
    10 => 'October\\Rain\\Filesystem\\FilesystemServiceProvider',
    11 => 'October\\Rain\\Html\\UrlServiceProvider',
    12 => 'October\\Rain\\Network\\NetworkServiceProvider',
    13 => 'October\\Rain\\Scaffold\\ScaffoldServiceProvider',
    14 => 'October\\Rain\\Flash\\FlashServiceProvider',
    15 => 'October\\Rain\\Argon\\ArgonServiceProvider',
    16 => 'System\\ServiceProvider',
  ),
  'deferred' => 
  array (
    'Illuminate\\Broadcasting\\BroadcastManager' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Contracts\\Broadcasting\\Factory' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Contracts\\Broadcasting\\Broadcaster' => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
    'Illuminate\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'Illuminate\\Contracts\\Bus\\Dispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'Illuminate\\Contracts\\Bus\\QueueingDispatcher' => 'Illuminate\\Bus\\BusServiceProvider',
    'cache' => 'Illuminate\\Cache\\CacheServiceProvider',
    'cache.store' => 'Illuminate\\Cache\\CacheServiceProvider',
    'memcached.connector' => 'Illuminate\\Cache\\CacheServiceProvider',
    'hash' => 'Illuminate\\Hashing\\HashServiceProvider',
    'Illuminate\\Contracts\\Pipeline\\Hub' => 'Illuminate\\Pipeline\\PipelineServiceProvider',
    'queue' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.worker' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.listener' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.failer' => 'Illuminate\\Queue\\QueueServiceProvider',
    'queue.connection' => 'Illuminate\\Queue\\QueueServiceProvider',
    'redis' => 'Illuminate\\Redis\\RedisServiceProvider',
    'redis.connection' => 'Illuminate\\Redis\\RedisServiceProvider',
    'validator' => 'Illuminate\\Validation\\ValidationServiceProvider',
    'validation.presence' => 'Illuminate\\Validation\\ValidationServiceProvider',
    'command.tinker' => 'Laravel\\Tinker\\TinkerServiceProvider',
    'command.cache.clear' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.cache.forget' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.clear-compiled' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.config.cache' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.config.clear' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.down' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.environment' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.key.generate' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.optimize' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.package.discover' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.failed' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.flush' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.forget' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.listen' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.restart' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.retry' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.queue.work' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.cache' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.clear' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.route.list' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'Illuminate\\Console\\Scheduling\\ScheduleFinishCommand' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'Illuminate\\Console\\Scheduling\\ScheduleRunCommand' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.seed' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.storage.link' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.up' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.view.clear' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.app.name' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.serve' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'command.vendor.publish' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migrator' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migration.repository' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'migration.creator' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'composer' => 'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider',
    'parse.markdown' => 'October\\Rain\\Parse\\ParseServiceProvider',
    'parse.yaml' => 'October\\Rain\\Parse\\ParseServiceProvider',
    'parse.twig' => 'October\\Rain\\Parse\\ParseServiceProvider',
    'parse.ini' => 'October\\Rain\\Parse\\ParseServiceProvider',
    'html' => 'October\\Rain\\Html\\HtmlServiceProvider',
    'form' => 'October\\Rain\\Html\\HtmlServiceProvider',
    'block' => 'October\\Rain\\Html\\HtmlServiceProvider',
    'mailer' => 'October\\Rain\\Mail\\MailServiceProvider',
    'swift.mailer' => 'October\\Rain\\Mail\\MailServiceProvider',
    'swift.transport' => 'October\\Rain\\Mail\\MailServiceProvider',
    'Illuminate\\Mail\\Markdown' => 'October\\Rain\\Mail\\MailServiceProvider',
  ),
  'when' => 
  array (
    'Illuminate\\Broadcasting\\BroadcastServiceProvider' => 
    array (
    ),
    'Illuminate\\Bus\\BusServiceProvider' => 
    array (
    ),
    'Illuminate\\Cache\\CacheServiceProvider' => 
    array (
    ),
    'Illuminate\\Hashing\\HashServiceProvider' => 
    array (
    ),
    'Illuminate\\Pipeline\\PipelineServiceProvider' => 
    array (
    ),
    'Illuminate\\Queue\\QueueServiceProvider' => 
    array (
    ),
    'Illuminate\\Redis\\RedisServiceProvider' => 
    array (
    ),
    'Illuminate\\Validation\\ValidationServiceProvider' => 
    array (
    ),
    'Laravel\\Tinker\\TinkerServiceProvider' => 
    array (
    ),
    'October\\Rain\\Foundation\\Providers\\ConsoleSupportServiceProvider' => 
    array (
    ),
    'October\\Rain\\Parse\\ParseServiceProvider' => 
    array (
    ),
    'October\\Rain\\Html\\HtmlServiceProvider' => 
    array (
    ),
    'October\\Rain\\Mail\\MailServiceProvider' => 
    array (
    ),
  ),
);
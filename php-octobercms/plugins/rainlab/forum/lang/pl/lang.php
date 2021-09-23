<?php

return [
    'topics' => [
        'component_name' => 'Lista tematów',
        'component_description' => 'Wyświetla listę wszystkich tematów.',
        'per_page' => 'Liczba tematów na stronie',
        'per_page_validation' => 'Niepoprawny format liczby tematów na stronie'
    ],
    'topic' => [
        'page_name' => 'Strona tematu',
        'page_help' => 'Nazwa strony wyświetlającej się po kliknięciu w temat.'
    ],
    'member' => [
        'page_name' => 'Strona użytkownika',
        'page_help' => 'Nazwa strony wyświetlającej się po kliknięciu w użytkownika.'
    ],
    'channel' => [
        'component_name' => 'Kanał',
        'component_description' => 'Wyświetla listę postów należących do kanału.',
        'page_name' => 'Strona kanału',
        'page_help' => 'Nazwa strony wyświetlającej się po kliknięciu w kanał.'
    ],
    'channels' => [
        'new_channel' => 'Nowy kanał',
        'delete_selected_confirm' => 'Jesteś pewien?',
        'delete' => 'Usuń',
        'manage' => 'Ustaw kolejność kanałów',
        'return' => 'Wróć do kanałów',
        'name' => 'Kanały',
        'create' => 'Stwórz kanały',
        'update' => 'Edytuj kanały',
        'preview' => 'Podejrzyj kanały',
        'manage' => 'Zarządzaj kanałami',
        'creating' => 'Tworzenie kanału...',
        'create' => 'Stwórz',
        'createnclose' => 'Stwórz i zamknij',
        'cancel' => 'Anuluj',
        'or' => 'lub',
        'returnlist' => 'Wróć do listy kanałów',
        'saving' => 'Zapisywanie kanału...',
        'save' => 'Zapisz',
        'savenclose' => 'Zapisz i zamknij',
        'deleting' => 'Usuwanie kanału...',
        'really' => 'Czy na pewno chcesz usunąć ten kanał?',
        'list_name' => 'Lista kanałów',
        'list_desc' => 'Wyświetla listę wszystkich widocznych kanałów.'
    ],
    'slug' => [
        'name' => 'Nazwa parametru slug',
        'desc' => 'Parametr URL używany do wyszukiwania kanału przez jego slug. Można również użyć twardo zakodowanego sluga.'
    ],
    'frontend' => [
        'notopic' => 'Brak tematów w tym kanale.'
    ],

    'plugin' => [
        'name' => 'Forum',
        'description' => 'Proste forum do osadzania'
    ],
    'data' => [
        'title' => 'Tytuł',
        'desc' => 'Opis',
        'slug' => 'Slug',
        'parent' => 'Rodzic',
        'noparent' => '-- Brak rodzica --',
        'moderated' => 'Moderowany',
        'is_mod' => 'Tylko moderatorzy mogą publikować posty na tym kanale.',
        'hidden' => 'Ukryty',
        'is_hidden' => 'Ukryj tę kategorię na głównej liście kategorii.'
    ],
    'settings' => [
        'username' => 'Nazwa użytkownika',
        'username_comment' => 'Nazwa użytkownika na forum.',
        'moderator' => 'Moderator forum',
        'moderator_comment' => 'Zaznacz to pole, jeśli ten użytkownik ma moderować całe forum.',
        'banned' => 'Zbanowany na forum',
        'banned_comment' => 'W tym polu zaznacz pole wyboru, jeśli użytkownik ma zakaz publikowania na forum.',
        'forum_username' => 'Nazwa użytkownika na forum',
        'channels' => 'Kanały forum',
        'channels_desc' => 'Zarządzaj dostępnymi kanałami forum.'
    ],
    'embedch' => [
        'channel_name' => 'Osadź kanał',
        'channel_self_desc' => 'Dołącz kanał do dowolnej strony.',
        'channel_title' => 'Kanał rodzic',
        'channel_desc' => 'Określ kanał, w którym chcesz utworzyć nowy kanał',
        'embed_title' => 'Parametr kodu osadzenia',
        'embed_desc' => 'Unikalny kod dla wygenerowanego kanału. Można również użyć parametru routingu.',
        'topic_name' => 'Parametr kodu tematu',
        'topic_desc' => 'Parametr URL używany do wyszukiwania tematu przez jego slug.'
    ],
    'embedtopic' => [
        'topic_name' => 'Osadź temat',
        'topic_self_desc' => 'Dołącz temat do dowolnej strony.',
        'target_name' => 'Kanał rodzic',
        'target_desc' => 'Określ kanał, w którym chcesz utworzyć nowy temat lub kanał',
        'embed_title' => 'Kod osadzenia',
        'embed_desc' => 'Unikalny kod dla wygenerowanego tematu lub kanału. Można również użyć parametru routingu.'
    ],
    'memberpage' => [
        'name' => 'Użytkownik',
        'self_desc' => 'Wyświetla informacje o użytkowniku forum i jego aktywność.',
        'slug_name' => 'Nazwa parametru slug',
        'slug_desc' => 'Parametr URL używany do wyszukiwania użytkowników forum przez ich slug. Można również użyć twardo zakodowanego sluga.',
        'view_title' => 'Sposób wyświetlania',
        'view_desc' => 'Ustaw ręcznie tryb wyświetlania dla komponentu użytkownika.',
        'ch_title' => 'Strona kanału',
        'ch_desc' => 'Nazwa strony wyświetlającej się po kliknięciu w kanał.',
        'topic_title' => 'Strona tematu',
        'topic_desc' => 'Nazwa strony wyświetlającej się po kliknięciu w temat.'
    ],
    'topicpage' => [
        'name' => 'Temat',
        'self_desc' => 'Wyświetla temat i posty.',
        'slug_name' => 'Nazwa parametru slug',
        'slug_desc' => 'Parametr URL używany do wyszukiwania tematu przez jego slug. Można również użyć twardo zakodowanego sluga.',
        'channel_title' => 'Strona kanału',
        'channel_desc' => 'Nazwa strony wyświetlającej się po kliknięciu w kanał.'
    ]
];

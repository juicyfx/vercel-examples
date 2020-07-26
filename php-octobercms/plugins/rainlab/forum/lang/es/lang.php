<?php

return [
    'topics'     => [
        'component_name'        => 'Listado de temas',
        'component_description' => 'Muestra un listado de todos los temas.',
        'per_page'              => 'Temas por pagina',
        'per_page_validation'   => 'Formato incorrecto de los temas por valor de página'
    ],
    'topic'      => [
        'page_name' => 'Página del Tema',
        'page_help' => 'Nombre de la página que se utilizará al hacer clic en un tema de conversación.'
    ],
    'member'     => [
        'page_name' => 'Página del Miembro',
        'page_help' => 'Nombre de la página que se utilizará al hacer clic en un miembro.'
    ],
    'channel'    => [
        'component_name'        => 'Canal',
        'component_description' => 'Muestra un listado de temas que pertenecen a un canal.',
        'page_name'             => 'Página del Canal',
        'page_help'             => 'Nombre de la página que se utilizará al hacer clic en un canal.'
    ],
    'channels'   => [
        'new_channel'  => 'Nuevo Canal',
        'delete_selected_confirm' => '¿Está seguro?',
        'delete'       => 'Borrar',
        'manage'       => 'Administrar orden del canal',
        'return'       => 'Volver a Canales',
        'name'         => 'Canales',
        'create'       => 'Crear Canales',
        'update'       => 'Editar Canales',
        'preview'      => 'Previsualizar Canales',
        'manage'       => 'Administrar Canales',
        'creating'     => 'Creando Canal...',
        'create'       => 'Crear',
        'createnclose' => 'Crear y Cerrar',
        'cancel'       => 'Cancelar',
        'or'           => 'o',
        'returnlist'   => 'Regresar al listado de canales',
        'saving'       => 'Guardando Canal...',
        'save'         => 'Guardar',
        'savenclose'   => 'Guardar y Cerrar',
        'deleting'     => 'Borrando Canal...',
        'really'       => '¿Realmente desea eliminar este canal?',
        'list_name'    => 'Lista de canales',
        'list_desc'    => 'Muestra un listado de todos los canales visibles.'
    ],
    'slug'       => [
        'name' => 'Slug nombre del parámetro',
        'desc' => 'El parametro de la ruta URL usado para buscar un canal por el slug. Un slug prefijado también puede usarse.'
    ],
    'frontend'   => [
        'notopic' => 'No hay temas en este canal.'
    ],

    'plugin'     => [
        'name'        => 'Foro',
        'description' => 'Un sencillo y poderoso foro embebible.'
    ],
    'data'       => [
        'title'     => 'Título',
        'desc'      => 'Descripción',
        'slug'      => 'Slug',
        'parent'    => 'Padre',
        'noparent'  => '-- Ningún padre --',
        'moderated' => 'Moderado',
        'is_mod'    => 'Solamente los moderadores pueden escribir en este canal.',
        'hidden'    => 'Oculto',
        'is_hidden' => 'Ocultar esta categoría de la lista principal categoría.'
    ],
    'settings'   => [
        'username'          => 'Nombre de usuario',
        'username_comment'  => 'La visualización para representar este usuario en el foro.',
        'moderator'         => 'Moderador del Foro',
        'moderator_comment' => 'Coloque una marca en esta casilla si este usuario puede moderar todo el foro.',
        'banned'            => 'Expulsado de foro',
        'banned_comment'    => 'Coloque una marca en esta casilla si este usuario tiene prohibido publicar en el foro.',
        'forum_username'    => 'Nombre de usuario del foro',
        'channels'          => 'Canales del Foro',
        'channels_desc'     => 'Administrar los canales disponibles en el foro.'
    ],
    'embedch'    => [
        'channel_name'      => 'Incrustar Canal',
        'channel_self_desc' => 'Adjunta un canal a cualquier página.',
        'channel_title'     => 'Canal Padre',
        'channel_desc'      => 'Especifique el canal para crear el nuevo canal en',
        'embed_title'       => 'Parámetro de código de inserción',
        'embed_desc'        => 'Un código único para el canal generado. También se puede utilizar un parámetro de enrutamiento.',
        'topic_name'        => 'Parámetro de código del Tema',
        'topic_desc'        => 'El parametro de la ruta URL usada para buscar un tema por su slug.'
    ],
    'embedtopic' => [
        'topic_name'      => 'Incrustar Tema',
        'topic_self_desc' => 'Adjunta un tema a cualquier página.',
        'target_name'     => 'Canal de destino',
        'target_desc'     => 'Especifique el canal para crear el nuevo tema o canal en',
        'embed_title'     => 'Código De Inserción',
        'embed_desc'      => 'Un código único para el tema o canal generado. También se puede utilizar un parámetro de enrutamiento.'
    ],
    'memberpage' => [
        'name'        => 'Miembro',
        'self_desc'   => 'Muestra información y la actividad de un miembro del foro.',
        'slug_name'   => 'Nombre del parámetro Slug',
        'slug_desc'   => 'El parámetro de la ruta URL usado para buscar un miembro del foro por slug. Un slug prefijado también puede ser usado.',
        'view_title'  => 'Modo de visualización',
        'view_desc'   => 'Establezca manualmente el modo de visualización para el componente del miembro.',
        'ch_title'    => 'Página del Canal',
        'ch_desc'     => 'Nombre de la página que se utilizará al hacer clic en un canal.',
        'topic_title' => 'Página del Tema',
        'topic_desc'  => 'Nombre de la página que se utilizará al hacer clic en un tema de conversación.'
    ],
    'topicpage'  => [
        'name'          => 'Tema',
        'desc'          => 'Muestra la información de un tema del foro.',
        'self'          => 'Muestra un tema y mensajes.',
        'slug_name'     => 'Nombre del parámetro Slug',
        'slug_desc'     => 'El parámetro de la ruta URL usado para buscar un tema por su slug. Un slug prefijado también puede ser usado.',
        'channel_title' => 'Página del Canal',
        'channel_desc'  => 'Nombre de la página que se utilizará al hacer clic en un canal.'
    ]
];
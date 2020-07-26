<?php

return [
    'topics'     => [
        'component_name' => 'Lista de Tópicos',
        'component_description' => 'Mostra um lista de todos os tópicos.',
        'per_page' => 'Tópicos por página',
        'per_page_validation' => 'Formato inválido do valor de tópicos por página'
    ],
    'topic'      => [
        'page_name' => 'Página do Tópico',
        'page_help' => 'Nome da página para usar ao clicar em um tópico de discussão.'
    ],
    'member'     => [
        'page_name' => 'Página do membro',
        'page_help' => 'Nome da página para usar ao clicar em um membro.'
    ],
    'channel'    => [
        'component_name' => 'Tema',
        'component_description' => 'Mostra uma lista de postagens pertecentes à um tema.',
        'page_name' => 'Página do Tema',
        'page_help' => 'Nome da página para usar ao clicar em um tema.'
    ],
    'channels'   => [
        'new_channel' => 'Novo Tema',
        'sure' => 'Você tem certeza?',
        'delete' => 'Apagar',
        'manage' => 'Escolher Ordem dos Temas',
        'return' => 'Voltar para Temas',
        'name' => 'Temas',
        'create' => 'Criar Temas',
        'update' => 'Editar Temas',
        'preview' => 'Visualizar Temas',
        'manage' => 'Administrar Temas',
        'creating' => 'Criando Tema...',
        'create' => 'Criar',
        'createnclose' => 'Criar e Fechar',
        'cancel' => 'Cancelar',
        'or' => 'ou',
        'returnlist' => 'Voltar para Lista de Temas',
        'saving' => 'Salvando Tema...',
        'save' => 'Salvar',
        'savenclose' => 'Salvar e Fechar',
        'deleting' => 'Deletando Tema...',
        'really' => 'Você realmente quer apagar esse tema?',
        'list_name' => 'Lista de Temas',
        'list_desc' => 'Mostra uma lista de todos os temas visíveis.'
    ],
    'slug' => [
        'name' => 'Nome do parâmetro Slug',
        'desc' => 'A rota de parâmetro de URL usado para ver o tema por esse Slug. Um hard coded slug também pode ser usado.'
    ],
    'frontend' => [
        'notopic' => 'não existe tópicos neste tema.'
    ],
    'plugin' => [
        'name' => 'Fórum',
        'description' => 'Um simples fórum incorporável'
    ],
    'data' => [
        'title' => 'Título',
        'desc' => 'Descrição',
        'slug' => 'Slug',
        'parent' => 'Pai',
        'noparent' => '-- Sem pai --',
        'moderated' => 'Moderado',
        'is_mod' => 'Apenas moderadores podem postar neste tema.',
        'hidden' => 'Oculto',
        'is_hidden' => 'Oculte essa categoria da lista principal de categorias.'
    ],
    'settings' => [
        'username' => 'Usuário',
        'username_comment' => 'Um nome que representará o usuário no fórum.',
        'moderator' => 'Moderador do Fórum',
        'moderator_comment' => 'Marque isso se você quer que este usuário seja moderador do fórum.',
        'banned' => 'Banido do fórum',
        'banned_comment' => 'Marque isso se você quer que este usuário não possa mais postar no fórum.',
        'forum_username' => 'Nome do Fórum',
        'channels' => 'Temas do Fórum',
        'channels_desc' => 'Administrar Temas Disponíveis.'
    ],
    'embedch' => [
        'channel_name' => 'Incorporar Tema',
        'channel_self_desc' => 'Anexe um tema a qualquer página.',
        'channel_title' => 'Tema Pai',
        'channel_desc' => 'Especifique um tema para criar um novo tem em',
        'embed_title' => 'Parâmetro de código de inserção',
        'embed_desc' => 'Um código único para o tema criado. Um parâmetro de rota também pode ser usado.',
        'topic_name' => 'Parâmetro de código do Tópico',
        'topic_desc' => 'O parâmetro da rota de URL usado para ver o tópico por esse slug.'
    ],
    'embedtopic' => [
        'topic_name' => 'Incorporar Tópico',
        'topic_self_desc' => 'Anexe um tópico a qualquer página.',
        'target_name' => 'Tema Destino',
        'target_desc' => 'Especifique o tema para criar um novo tópico ou tema em',
        'embed_title' => 'Código de Inserção',
        'embed_desc' => 'Um código único para o tópico ou tema criado. Um parâmetro de rota também pode ser usado.'
    ],
    'memberpage' => [
        'name' => 'Membro',
        'self_desc' => 'Mostra as informações e atividades de um membro do fórum.',
        'slug_name' => 'Nome do paramêtro Slug',
        'slug_desc' => 'A rota de parâmetro de URL usado para ver o usuário por esse Slug. Um hard coded slug também pode ser usado.',
        'view_title' => 'Modo de Visualização',
        'view_desc' => 'Estabeleça manualmente o modo de visualização do membro.',
        'ch_title' => 'Página do Tema',
        'ch_desc' => 'Nome da página para usar quando clicar no tema.',
        'topic_title' => 'Página do Tópico',
        'topic_desc' => 'Nome da página para usar quando clicar no tópico.'
    ],
    'topicpage' => [
        'name' => 'Tópico',
        'self_desc' => 'Mostre um tópico e postagens.',
        'slug_name' => 'Nome do parâmetro Slug',
        'slug_desc' => 'A rota de parâmetro de URL usado para ver o tópico por esse Slug. Um hard coded slug também pode ser usado.',
        'channel_title' => 'Página do Tema',
        'channel_desc' => 'Nome da página para usar quando clicar no tema.'
    ]
];
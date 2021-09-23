# Forum plugin

This plugin adds a simple embeddable forum to [OctoberCMS](http://octobercms.com).

A video demonstration of this plugin can be seen here:
https://vimeo.com/97088926

## Configuration

The forum does not require immediate configuration to operate. However the following options are available.

* Forum categories (Channels) can be managed via the System > Channels menu.
* Forum members can be managed via the User menu.

## Displaying a list of channels

The plugin includes a component forumChannels that should be used as the main page for your forum. Add the component to your page and render it with the component tag:

```php
{% component 'forumChannels' %}
```

You should tell this component about the other forum pages.

* **channelPage** - the page used for viewing an individual channel's topics.
* **topicPage** - the page used for viewing a discussion topic and posts.
* **memberPage** - the page used for viewing a forum user.

## Example page structure

#### forum/home.htm

```
title = "Forum"
url = "/forum"
layout = "default"

[forumChannels]
memberPage = "forum/member"
channelPage = "forum/channel"
topicPage = "forum/topic"
==

<h1>Forum</h1>
{% component 'forumChannels' %}
```

#### forum/channel.htm

```
title = "Forum"
url = "/forum/channel/:slug"
layout = "default"

[forumChannel]
memberPage = "forum/member"
topicPage = "forum/topic"
==

<h1>{{ channel.title }}</h1>
{% component 'forumChannel' %}
```

#### forum/topic.htm

```
title = "Forum"
url = "/forum/topic/:slug"
layout = "default"

[forumTopic]
memberPage = "forum/member"
channelPage = "forum/channel"
==

<h1>{{ topic.subject }}</h1>
{% component 'forumTopic' %}
```

#### forum/member.htm

```
title = "Forum"
url = "/forum/member/:slug"
layout = "default"

[forumMember]
channelPage = "forum/channel"
topicPage = "forum/topic"
==

<h1>{{ member.username }}</h1>
{% component 'forumMember' %}
```

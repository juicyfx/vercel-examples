# Laravel Vercel

This repository inherits from Laravel 10.x. Important files are the following ones:

- [`.vercelignore`](./.vercelignore)
- [`.vercel.json`](./vercel.json)

## Build assets

Add the following snippet in the `composer.json` file.

```json
{
    "scripts": {
        "vercel": [
            "npm install",
            "npm run build"
        ]
    }
}
```

## Enable HTTPS

See [`app/Http/Middleware/TrustProxies.php`](./app/Http/Middleware/TrustProxies.php).

```diff
-   protected $proxies = null;
+   protected $proxies = "*";   
```

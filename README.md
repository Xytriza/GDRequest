# GDRequest
Pretty much a site where you replace the URL for Boomlings, and my server makes the request with a proxy.
Idealy used to bypass CloudFlare.

Website: https://gdrequest.xytriza.com/

Nginx config (used to rewrite requests):
```nginx
server {
    listen 80;
    server_name https://gdrequest.xytriza.com;

    location / {
        include fastcgi_params;
        fastcgi_intercept_errors on;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTPS "on";
        fastcgi_param SERVER_PORT 443;
        fastcgi_pass 127.0.0.1:{{php_fpm_port}};
        fastcgi_param PHP_VALUE "{{php_settings}}";
        rewrite ^/(.*)$ /forwardRequest.php?url=$1 break;
        fastcgi_read_timeout 3600;
        fastcgi_send_timeout 3600;
    }
}
```

To enable Proxy, configure it in forwardRequest.php at line 16 and 17. Also remove double slashes to enable it.

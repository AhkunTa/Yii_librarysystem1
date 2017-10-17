<VirtualHost *:8082>
    ServerName librarysystem1.com
    DocumentRoot "/d:/wamp/www/librarysystem1/frontend/web/"

    <Directory "/d:/wamp/www/librarysystem1/frontend/web/">
    # use mod_rewrite for pretty URL support
    RewriteEngine on
    # If a directory or a file exists, use the request directly
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    # Otherwise forward the request to index.php
    RewriteRule . index.php

    # use index.php as index file
    DirectoryIndex index.php

    # ...other settings...
    </Directory>
</VirtualHost>

<VirtualHost *:8082>
    ServerName admin.librarysystem1.com
    DocumentRoot "/d:/wamp/www/librarysystem1/backend/web/"

    <Directory "/d:/wamp/www/librarysystem1/backend/web/">
    # use mod_rewrite for pretty URL support
    RewriteEngine on
    # If a directory or a file exists, use the request directly
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    # Otherwise forward the request to index.php
    RewriteRule . index.php

    # use index.php as index file
    DirectoryIndex index.php

    # ...other settings...
    </Directory>
</VirtualHost>
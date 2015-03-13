<?php http_response_code(404); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page not found</title>
        <link rel="stylesheet" type="text/css" href="main.css?v=<?= time() ?>">
    </head>
    <body>
        <div class="page">
            <h1>This page does not exists</h1>
        </div>
    </body>
</html>
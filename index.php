<?php

include 'inc.php';

// base URL 
$baseUrl = '/';

// list of all pages
// page url = file name in /pages/ without .php
$pages = array('top', 'howitworks', 'services', 'contacts');

// look for requested page
$uri = trim(str_replace($baseUrl, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/');
if (in_array($uri, $pages)) {
    $currentPage = $pages[array_search($uri, $pages)];
} elseif ($uri == '') {
    $currentPage = 'top';
} else {
    include '404.php'; die();
}

$meta = array();
$content = '';
// render all pages HTML into one document in $content
foreach ($pages as $pageName) {
    ob_start();
    include dirname(__FILE__) . '/pages/' . $pageName . '.php';
    if ($pageName == $currentPage) {
        // get meta info to output
        // variables are defined inside page file
        $meta['title'] = (isset($title)) ? $title : '';
        $meta['keywords'] = (isset($keywords)) ? $keywords : '';
        $meta['description'] = (isset($description)) ? $description : '';
    }
    // add html from page
    $content .= '<!-- Start of section "' . $pageName . '" -->' . "\n";
    $content .= '<div class="section" id="' . $pageName . '">';
    $content .= ob_get_contents();
    $content .= '</div>';
    $content .= '<!-- End of section "' . $pageName . '" -->' . "\n";
    ob_end_clean();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="keywords" content="<?= $meta['keywords'] ?>">
        <meta name="description" content="<?= $meta['description'] ?>">
        <title><?= $meta['title'] ?> - Landing Demo</title>
        <link rel="stylesheet" type="text/css" href="main.css?v=<?= time() ?>">
        <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="main.js?v=<?= time() ?>"></script>
    </head>
    <body data-base-url="<?= $baseUrl ?>">
        <div class="container">
            <!-- draw menu -->
            <ul class="menu top">
                <?php foreach ($pages as $pageName) : ?>
                <li><a href="<?= $baseUrl ?><?= $pageName ?>"><?= $pageName ?></a></li>
                <?php endforeach; ?>
            </ul>
            <!-- page's content -->
            <div class="page">
                <?= $content ?>
            </div>
        </div>
        <div class="footer">
            <h5><a href="<?= $baseUrl ?>top">Back to start &bumpe;</a></h5>
            <h2>Footer</h2>
        </div>
    </body>
</html>
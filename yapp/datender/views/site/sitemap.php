<?php
$host = Yii::$app->request->hostInfo;
?>
<?//xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">


    <url>
        <loc><?= $host ?></loc>
        <changefreq>daily</changefreq>
        <priority>1</priority>
        <lastmod><?= $homeLastMod ?></lastmod>
    </url>
    <?php foreach($data as $url): ?>
        <url>
            <loc><?= $host.$url['url'] ?></loc>
            <lastmod><?= $url['lastmod'] ?></lastmod>
            <changefreq><?= $url['changefreq'] ?></changefreq>
        </url>
    <?php endforeach; ?>
</urlset>
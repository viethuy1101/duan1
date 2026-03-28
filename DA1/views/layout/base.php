<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?? '' ?></title>
</head>
<body>

<?php
if ($type == 'client') {
    require './views/client/layout/header.php';
} else {
    require './views/admin/layout/sidebar.php';
}
?>

<div style="margin-left:220px;padding:20px;">
    <?= $content ?>
</div>

</body>
</html>
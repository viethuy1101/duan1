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

<?php if (!empty($message)): ?>
<div style="margin-left:220px;padding:10px;background:lightgreen;color:green;border:1px solid green;">
    <?= $message ?>
</div>
<?php endif; ?>

<div style="margin-left:220px;padding:20px;">
    <?= $content ?>
</div>

</body>
</html>
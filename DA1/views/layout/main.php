<!DOCTYPE html>
<html>
<head>
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <script src="<?= BASE_URL ?>/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>  
<?php require PATH_VIEW . 'layout/header.php';
 ?>

<div class="container mt-4">
    <?php include $content; ?> 
</div>

<?php require PATH_VIEW . 'layout/footer.php'; ?>

</body>
</html>
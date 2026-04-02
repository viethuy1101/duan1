<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - Book Verse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { display: flex; min-height: 100vh; background-color: #f0f2f5; margin: 0; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 260px; background: #1a1d20; color: white; position: fixed; height: 100vh; padding: 25px 0; z-index: 1000; }
        .sidebar h2 { color: #0d6efd; font-weight: 800; text-align: center; margin-bottom: 35px; }
        .sidebar a { display: block; color: #adb5bd; text-decoration: none; padding: 14px 25px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #2b2f33; color: white; border-left: 5px solid #0d6efd; padding-left: 30px; }
        .main-content { margin-left: 260px; flex: 1; padding: 40px 50px; }
        .card { border: none !important; box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important; border-radius: 15px !important; }
        .badge-custom { padding: 8px 16px; border-radius: 30px; font-weight: 600; font-size: 11px; }
    </style>
</head>
<body>
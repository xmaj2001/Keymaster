<?php
use App\Core\View;
?>
<!DOCTYPE html>
<html lang="<?php echo Page_lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="<?php echo Page_viewport ?>">
    <meta name="author" content="<?php echo Page_author ?>" />
    <meta name="keywords" content="<?php echo Page_keywords ?>" />
    <meta name="description" content="<?php echo Page_description ?>" />
    <title><?php echo Page_titulo ?></title>
    <meta property="og:title" content="<?php echo Page_titulo ?>" />
    <meta property="og:image" content="<?php echo Page_image ?>" />
    <meta property="og:url" content="<?php echo Page_url ?>" />
    <meta property="og:site_name" content="<?php echo Page_site_name ?>" />
    <meta property="og:description" content="<?php echo Page_description ?>" />
    <!-- Twitter -->
    <meta name="twitter:title" content="<?php echo Page_titulo ?>" />
    <meta name="twitter:image" content="<?php echo Page_image ?>" />
    <meta name="twitter:url" content="<?php echo Page_url ?>" />
    <meta name="twitter:card" content="<?php echo Page_card ?>" />
    <!-- ------------- -->
    <link rel="shortcut icon" href="<?php echo Page_logo ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo Assets?>app.css"/>
    <!-- Scripts jquery -->
    <script src="/Assets/plugins/jquery/jquery.min.js"></script>
</head>
<body>
    <header>
        <?php View::Header(); ?>
    </header>
    <main>
        <?php View::Main(); ?>
    </main>
    <footer>
        <?php View::Footer(); ?>
    </footer>
    <!-- Scripts -->
    <script src="/Assets/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <title>Document</title>
</head>
<body>
    <div style="height: 100vh;
    display: flex;
    flex-direction: column;">
    <?php
    //Navbar
        require_once 'includes/utils/_messaging.inc.php';
        require_once 'includes/_login.inc.php';
        require_once 'includes/_registration.inc.php';
        require_once 'includes/_create_edit_article.inc.php';
        require_once 'includes/functions.inc.php';
        include_once 'components/navbar.php';
        

    ?>
<section style="flex-grow: 4;
    overflow-y: auto; margin-top: 40px;">
<?php
        //Content
        if(!empty($_GET) || !empty($_POST)) {
            if(isset($_GET['login']) || (isset($_POST['form_type']) && $_POST['form_type'] == 'login')) {
                include 'components/login.php';
            } else if(isset($_GET['article'])) {
                include 'components/article.php';
            } else if(isset($_GET['new_article']) || (isset($_POST['form_type']) && $_POST['form_type'] == 'article')) {
                include 'components/new-article.php';
            } else if(isset($_GET['create_account']) || (isset($_POST['form_type']) && $_POST['form_type'] == 'register')) {
                include 'components/create-account.php';
            } else if(isset($_GET['logout'])) {
                include 'components/logout.php';
            } else if(isset($_GET['category'])) {
                include 'components/articles.php';
            } else if(isset($_GET['delete'])) {
                include 'components/delete_article.php';
            }
        } else {
            include 'components/articles.php';
        }
       
    ?>
</section>
    

    <?php
        //footer
        include 'components/footer.php';
        
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php $isLogin = !empty($_SESSION) && isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']; ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <?php
                if ($isLogin) {
                    echo ' <li class="nav-item"><a class="nav-link" href="index.php?new_article=true">Add Article</a></li>';
                }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="index.php">All</a></li>
                        <?php
                        $sql = 'SELECT `categ_id`, `categ_name` FROM `tbl_categories`';

                        try {
                            if ($stmt = $pdo->prepare($sql)) {
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    echo '<li><a class="dropdown-item" href="index.php?category=' . $row->categ_id . '">' . $row->categ_name . '</a></li>';
                                }
                            }
                        } catch (PDOException $e) {
                            showMessage($e->getMessage(), 'danger');
                        }
                        ?>
                    </ul>
                    <?php 
                        if (!$isLogin) {
                            echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?create_account=true">Registration</a></li>';
                        }
                    ?>
                </li>
            </ul>
        </div>
        <?php
        if ($isLogin) {
            if (isset($_SESSION['user'])) {
                echo '<a class="me-2"><i class="bi bi-person-circle"></i> ' . $_SESSION['user'] . ' </a>';
            }
            echo '<a href="index.php?logout=true"><button type="button" class="btn btn-outline-secondary">Logout <i class="bi bi-box-arrow-left"></i></button></a>';
        } else {
            echo '<a href="index.php?login=true"><button type="button" class="btn btn-outline-primary">Login <i class="bi bi-box-arrow-in-right"></i></button></a>';
        }
        ?>
    </div>
</nav>
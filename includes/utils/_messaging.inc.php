<?php

// $type: 'success' || 'danger'
function showMessage($message, $type) {
    $styles = "
        z-index: 1070;
        top: 1em;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0.9;
    ";

    $class = "alert-dismissible fade show position-absolute alert alert-" . $type;


    echo '<div class="' . $class . '" style="' . $styles . '" role="alert">' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
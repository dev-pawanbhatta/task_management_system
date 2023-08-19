<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo header('Location:index.php');
}

$url = $_SERVER['REQUEST_URI'];
$url = explode('/', $url);
$href = end($url);

if (str_contains($href, '?')) {
    $href = substr($href, 0, strpos($href, '?'));
}

?>
<script>
    window.addEventListener('load', function() {
        document.querySelectorAll('a[href="<?= $href ?>"]')[0].className += " active";
    })
</script>
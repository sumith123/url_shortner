<?php
require_once 'dbConnection.php';
require_once 'ShortUrlClass.php';
$obj =  new ShortUrlClass($conn);

if (isset($_GET['url']) && $_GET['url'] != "") {
    $url = urldecode($_GET['url']);
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        $slug = $obj->GetShortUrl($url);
        $conn->close();
        ?>
        <div style="text-align: center;">
            <?php
            echo "<b>Short URL:</b> " . $short_url . $slug;
            ?>
            <br />
            <a href="<?=$base_url.'?redirect='.$slug;?>" target="_blank" style="margin-top:14px;display: inline-block;
">Click here to redirect</a>
        </div>
<?php

    } else {
        die("Not a valid URL");
    }
}

if (isset($_GET['redirect']) && $_GET['redirect'] != "") {
    $slug = urldecode($_GET['redirect']);
    $url = $obj->GetRedirectUrl($slug);
    $conn->close();
    header("location:" . $url);
    exit;
}

?>
<center>
    <h1>Enter Your Url Here</h1>
    <form>
        <p><input style="width:500px" type="url" name="url" required /></p>
        <p><input type="submit" /></p>
    </form>
</center>

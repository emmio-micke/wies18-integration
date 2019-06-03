<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Autocomplete</title>
    
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
 
<form autocomplete="off">
    <div class="autocomplete" style="width:300px;">
      <input id="country" type="text" name="country" placeholder="Country">
    </div>
    <input type="submit">
    <div>
      <ul id="suggestions"></ul>
    </div>

    <?php
    if (isset($_POST['country'])) {
        echo 'You searched for: ' . $_POST['country'];
    }
    ?>
</form>
</body>
</html>
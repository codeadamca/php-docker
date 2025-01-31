<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>

    <h1>Home Page</h1>

    <?php echo "<p>Hello Word!</p>"; ?>

    <?php

    $connect = mysqli_connect(
        'db',
        'demo',
        'password',
        'demo'
    );

    $query = 'SELECT *
        FROM colours
        ORDER BY name';
    $result = mysqli_query($connect, $query);

    while($record = mysqli_fetch_assoc($result))
    {

        echo '<h2>'.$record['name'].'</h2>
            <div style="width: 200px; height: 200px; background-color: '.$record['rgb'].';"></div>
            <hr>';

    }

    ?>
    
</body>
</html>
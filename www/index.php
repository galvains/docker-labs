<!-- put in ./www directory -->

<html>
 <head>
  <title>Hello...</title>


  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <h1>Hi! I'm happy</h1>


    <?php
    $conn = mysqli_connect('db', 'user', 'test', 'myDb');

    $host = 'postgres';
    $port = '5432';
    $database = getenv("POSTGRES_DB");
    $user = getenv("POSTGRES_USER");
    $password = getenv("POSTGRES_PASSWORD");
    $connection = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

    if (!$connection) {
      echo "Failed to connect to PostgreSQL: " . pg_last_error();
      exit;
    }

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    $query = "SELECT * From Person";
    $result = mysqli_query($conn, $query);

    echo '<table class="table table-striped">';
    echo '<thead><tr><th></th><th>id</th><th>name</th></tr></thead>';
    while($value = $result->fetch_array())
    {
        echo '<tr>';
        echo '<td><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>';
        foreach($value as $element){
            echo '<td>' . $element . '</td>';
        }

        echo '</tr>';
    }
    echo '</table>';

    $pg_query = "SELECT * FROM person";
    $pg_result = pg_query($connection, $pg_query) or die('Error message: ' . pg_last_error());

    echo '<table class="table table-striped">';
    echo '<thead><tr><th></th><th>id</th><th>name</th></tr></thead>';
    while ($row = pg_fetch_row($pg_result)) {
        echo '<tr>';
        echo '<td><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>';
        foreach($row as $element){
            echo '<td>' . $element . '</td>';
        }

        echo '</tr>';
    }
    echo '</table>';

    pg_free_result($pg_result);
    pg_close($connection);

    $result->close();
    mysqli_close($conn);

    ?>

    </div>
</body>
</html>

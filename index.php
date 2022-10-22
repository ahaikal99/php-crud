<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=anime', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$search = $_GET['search']??'';

if($search){
    $statement = $pdo->prepare('SELECT * FROM characters WHERE name LIKE :name ORDER BY name DESC');
    $statement->bindValue(':name', "%$search%");
} else {
    $statement = $pdo->prepare('SELECT * FROM characters ORDER BY create_date DESC');
}
$statement->execute();
$read_data = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg bg-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">My Anime</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        </div>
    </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <div class="container">
    <h1 style="color: white;">Welcome</h1><br>
    <form class="d-flex" role="search" >
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button type="button" class="btn btn-warning">Search</button>
        </form><br>
    <a href="add.php" type="button" class="btn btn-success">CREATE</a><br><br>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
            <th scope="col">No.</th>
            <th scope="col">Image</th>
            <th scope="col">Character Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Date Added</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($read_data as $i => $data):?>
                <tr>
            <th scope="row"><?php echo $i +1 ?></th>
            <td><img src="<?php echo $data['image']; ?>" class="image"></td>
            <td><?php echo $data['name'] ?></td>
            <td><?php echo $data['gender'] ?></td>
            <td><?php echo $data['create_date'] ?></td>
            <td>
                <a href="update.php?id=<?php echo $data['id'] ?>" type="button" class="btn btn-sm btn-primary">Edit</a>
                <form style="display: inline-block;" action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</body>
</html>

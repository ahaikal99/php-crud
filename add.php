<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=anime', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $name = $_POST['name'] ??'';
    $gender = $_POST['gender']??'';
    $date = date('Y-m-d H:i:s');
    $image = $_POST['image']??'';

    $error = [];
    if(empty($name)){
        $error[] = 'character name is required';
    }

    if(empty($gender)){
        $error[] = 'gender is required';
    }

    if(empty($error)){
    $statement = $pdo->prepare("INSERT INTO characters(name, gender, create_date, image) VALUES(:name, :gender, :date, :image)");
    $statement->bindValue(':name', $name);
    $statement->bindValue(':gender', $gender);
    $statement->bindValue(':date', $date);
    $statement->bindValue(':image', $image);
    $statement->execute();
    }
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
        <a class="navbar-brand" href="#">My Anime</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <div class="container">
    <h1 style="color: white;">Add New Character</h1><br>

    <?php if(!empty($error)): ?>
        <div class="alert alert-danger" role="alert">
        <?php foreach ($error as $errmsg): ?>
            <li><?php echo $errmsg ."<br>"; ?></li>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="" method="post">
    <div class="form-floating">
      <input type="text" class="form-control" placeholder="name" name="name">
      <label for="floatingInputGrid">Character Name</label><br>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" placeholder="gender" name="gender">
      <label for="floatingInputGrid">Gender</label><br>
    </div>
    <div class="form-floating">
      <input type="date" class="form-control" placeholder="date" name="date">
      <label>Date Added</label><br>
    </div>
    <div class="form-floating">
      <input  style="padding-top: 40px; height:70px" type="file" class="form-control" placeholder="image" name="image">
      <label>Image<br></label><br>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
    <button type="reset" class="btn btn-danger">Reset</button>
    <a href="index.php" class="btn btn-primary">Home</a>
    </form>
    </div>
</body>
</html>
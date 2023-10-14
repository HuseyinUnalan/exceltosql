<!DOCTYPE html>
<html lang="en">

<head>
  <title>Excel to SQL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <div class="container mt-3">
    <h2>Excel to SQL</h2>

    <?php

    if (isset($_GET['process'])) {
      if ($_GET['process'] == 'success') { ?>
        <div class="alert alert-success">
          <strong>Success!</strong> Export to SQL Successful
        </div>
      <?php } else { ?>
        <div class="alert alert-danger">
          <strong>Error!</strong> Something Went Wrong
        </div>
    <?php  }
    }

    ?>

    <form action="process.php" method="POST">
      <div class="input-group mb-3">
        <input type="file" class="form-control" accept=".xlsx, .xls" placeholder="Excel File" name="file">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

</body>

</html>
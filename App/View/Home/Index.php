<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Boozt Assignment</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="?route=/">Boozt Assignment</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="?route=/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?route=/chart">Chart</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="mb-3">
            <table class="table table-bordered table-striped mb-0">
                <tr>
                    <th width="20%">Number of customers</th>
                    <td><?php echo ($model['customerCount']) ?></td>
                </tr>
                <tr>
                    <th>Number of orders</th>
                    <td><?php echo ($model['orderCount']) ?></td>
                </tr>
                <tr>
                    <th>Revenue</th>
                    <td><?php echo ($model['revenue']) ?> SEK</td>
                </tr>
            </table>
        </div>
        
        <form class="border p-3 mb-3" action="/" method="GET">
            <p class="text-muted">Statistics based on the interval from <?php echo($model['from']->format('Y-m-d')); ?> to <?php echo($model['to']->format('Y-m-d')); ?>, inclusive.</p>

            <label for="from">From</label>
            <input type="date" id="from" name="from" value="<?php echo($model['from']->format('Y-m-d')); ?>">

            <label for="to">To</label>
            <input type="date" id="to" name="to" value="<?php echo($model['to']->format('Y-m-d')); ?>">

            <button type="submit" class="btn btn-primary">Update statistics</button>
        </form>

        <div>
            <a href="?route=/demo/generate" class="btn btn-primary">Generate order data</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>
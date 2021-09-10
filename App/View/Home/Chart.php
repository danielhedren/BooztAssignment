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
                            <a class="nav-link" href="?route=/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="?route=/chart">Chart</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="mb-3">
            <canvas id="chart" width="400px" height="100px"></canvas>
        </div>

        <form class="border p-3 mb-3" action="/" method="GET">
            <p class="text-muted">Statistics based on the interval from <?php echo($model['from']->format('Y-m-d')); ?> to <?php echo($model['to']->format('Y-m-d')); ?>, inclusive.</p>
            <input type="hidden" name="route" value="/chart">

            <label for="from">From</label>
            <input type="date" id="from" name="from" value="<?php echo($model['from']->format('Y-m-d')); ?>">

            <label for="to">To</label>
            <input type="date" id="to" name="to" value="<?php echo($model['to']->format('Y-m-d')); ?>">

            <button type="submit" class="btn btn-primary">Update statistics</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var ctx = document.getElementById("chart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: <?php echo(json_encode($model["labels"])); ?>,
                datasets: [{
                    label: "# of customers",
                    data: <?php echo(json_encode($model["customers"])); ?>,
                    borderColor: "#ffb1c1",
                    backgroundColor: "rgba(0,0,0,0)"
                },
                {
                    label: "# of orders",
                    data: <?php echo(json_encode($model["orders"])); ?>,
                    borderColor: "#9ad0f5",
                    backgroundColor: "rgba(0,0,0,0)"
                }
            ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
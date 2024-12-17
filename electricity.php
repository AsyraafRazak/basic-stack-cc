<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Electricity Calculator</title>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-primary" href="/tutorial-html/index.html">Back</a><br>
            </div>
            <div class="col-md-6">
                <h1>Electricity Calculator</h1>
                <?php
                // Initialize variables with empty strings for default display
                $voltage = isset($_POST['voltage']) ? $_POST['voltage'] : '';
                $current = isset($_POST['current']) ? $_POST['current'] : '';
                $hours = isset($_POST['hours']) ? $_POST['hours'] : '';
                $rate = isset($_POST['rate']) ? $_POST['rate'] : '';
                ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="voltage">Voltage (V)</label>
                        <input type="number" step="any" class="form-control" id="voltage" name="voltage" value="<?php echo htmlspecialchars($voltage); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="current">Current (A)</label>
                        <input type="number" step="any" class="form-control" id="current" name="current" value="<?php echo htmlspecialchars($current); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="hours">Usage Time (Hours)</label>
                        <input type="number" step="any" class="form-control" id="hours" name="hours" value="<?php echo htmlspecialchars($hours); ?>">
                    </div>
                    <div class="form-group">
                        <label for="rate">Rate (per kWh in cents)</label>
                        <input type="number" step="any" class="form-control" id="rate" name="rate" value="<?php echo htmlspecialchars($rate); ?>" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Calculate</button>
                    </div>
                </form>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $voltage = floatval($_POST['voltage']);
                    $current = floatval($_POST['current']);
                    $hours = floatval($_POST['hours']);
                    $rate = floatval($_POST['rate']);

                    // Calculations
                    $power = $voltage * $current; // Power in watts
                    $energy = ($power * $hours) / 1000; // Energy in kWh
                    $total = $energy * ($rate / 100); // Total cost
                ?>

                    <div class="card mt-4 border-primary mx-auto" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Calculation Results</h5>
                            <p class="card-text"><strong>Power (W):</strong> <?php echo $power; ?> W</p>
                            <p class="card-text"><strong>Energy (kWh):</strong> <?php echo $energy; ?> kWh</p>
                            <p class="card-text"><strong>Total Cost:</strong> RM <?php echo number_format($total, 2); ?></p>
                        </div>
                    </div>
                    <br>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hours</th>
                    <th scope="col">Energy (kWh)</th>
                    <th scope="col">Total (RM)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    for ($hour = 1; $hour <= 24; $hour++) {
                        $energy = ($power * $hour) / 1000; // Energy in kWh
                        $total = $energy * ($rate / 100); // Total cost
                        echo "<tr>
                            <th scope='row'>$hour</th>
                            <td>$hour</td>
                            <td>" . number_format($energy, 5) . "</td>
                            <td>RM " . number_format($total, 2) . "</td>
                          </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>

</html>
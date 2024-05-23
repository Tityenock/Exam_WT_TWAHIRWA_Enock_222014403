<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"> <!-- Proper character encoding -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->
  <title>Fitness Plans</title>
  <link rel="stylesheet" type="text/css" href="style.css"> <!-- External CSS -->
  <style>
   /* CSS styles for consistent styling */
a:link {
    color: #0066cc;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Comments */
/* This is a comment */

    a {
      padding: 7px;
      color: white;
      background-color: turquoise;
      text-decoration: none;
      margin-right: 5px;
    }

    a:visited {
      color: purple;
    }

    a:link {
      color: brown;
    }

    a:hover {
      background-color: white;
    }

    a:active {
      background-color: red;
    }

    button.btn {
      margin-left: 15px; 
      margin-top: 7px;
    }

    input.form-control {
      padding: 10px;
    }

    table {
      width: 75%; /* Set table to full width */
      border-collapse: revert; /* Merge borders */
      /* CSS for Table Design with Special First Column */

/* Table */
table {
    width: 70%;
    border-collapse: collapse;
}

/* Special Styling for First Column */
td:first-child {
    background-color: #333333;
    color: #ffffff;
}

/* Table Cells */
td {
    padding: 8px;
    border-bottom: 1px solid #dddddd;
}

/* Hover Effect */
tr:hover {
    background-color: #e9e9e9;
}

    }

    th, td {
      border: 2px solid black; /* Table borders */
      padding: 10px; /* Padding for readability */
      text-align: left;
    }

    th {
      background-color: orange; /* Header row color */
    }

    section {
      padding: 20px; 
      border-bottom: 3px solid #ddd; /* Bottom border for section */
    }

    footer {
      text-align: center; 
      padding: 10px; 
      background-color: darkgray; /* Footer background color */
    }
  </style>
  <!-- JavaScript function for insert confirmation -->
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</head>

<body style="background-color: lightblue;"> <!-- Corrected placement of body tag -->
  <header>
    <ul style="list-style-type: none; padding: 0;"> <!-- No list-style -->
      <li style="display: inline; margin-right: 10px;">
           <ul style="list-style-type: none; padding: 0;">
    </li>
    <li style="display: inline; margin-right: 8px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./clients.php">clients</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./exercises.php">exercises</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./fitness_plan.php">fitness_plan</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./client_goals.php">client_goals</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./reviews.php"> reviews</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./sessions.php">sessions</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./trainees.php">trainees</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./trainers.php">trainers</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./workout_plans.php">workout_plans</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./client_payments.php">client_payments</a></li>

      <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: greenyellow; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="logout.php">Logout</a>
        </div>
      </a>
    </li>
    </ul>
  </header>
<body style="background-color: yellowgreen;">

  <h1>Fitness Plans Form</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <label for="plan_id">Plan ID:</label>
    <input type="number" id="plan_id" name="plan_id" required><br><br>

    <label for="trainer_id">Trainer_id:</label>
    <input type="text" id="trainer_id" name="trainer_id" required><br><br>

    <label for="plan_name">Plan Name:</label>
    <input type="text" id="plan_name" name="plan_name" required><br><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="duration">Duration (in weeks):</label>
    <input type="number" id="duration" name="duration" required><br><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br>

    <a href="./home.html">Go Back to Home</a> <!-- Corrected the path to start with "./" -->
  </form>

  <?php
  include('database_connection.php'); // Include the database connection

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      // Retrieve input values from POST request
      $plan_id = $_POST['plan_id'];
      $trainer_id = $_POST['trainer_id'];
      $plan_name = $_POST['plan_name'];
      $description = $_POST['description'];
      $duration = $_POST['duration'];
      $price = $_POST['price'];

      // Prepare SQL statement for insertion
      $stmt = $connection->prepare("INSERT INTO fitness_plan (plan_id, trainer_id, plan_name, description, duration, price) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("isssii", $plan_id, $trainer_id, $plan_name, $description, $duration, $price); // Bind parameters

      // Execute the statement and check for success
      if ($stmt->execute()) {
          echo "New record has been added successfully.<br><br><a href='fitnessplan.php'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $stmt->error;
      }

      // Close the statement
      $stmt->close();
  }
  ?>

  <section>
    <h2>Fitness Plans Detail</h2>
    <table>
      <tr>
        <th>Plan ID</th>
        <th>Trainer_id</th>
        <th>Plan Name</th>
        <th>Description</th>
        <th>Duration (weeks)</th>
        <th>Price</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      // Select all fitness plans from the database
      $sql = "SELECT * FROM fitness_plan";
      $result = $connection->query($sql); // Execute the query

      if ($result->num_rows > 0) {
          // Loop through the results and generate table rows
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>{$row['plan_id']}</td>
                      <td>{$row['trainer_id']}</td>
                      <td>{$row['plan_name']}</td>
                      <td>{$row['description']}</td>
                      <td>{$row['duration']}</td>
                      <td>{$row['price']}</td>
                      <td><a style='padding:4px' href='delete_fitness_plan.php?plan_id={$row['plan_id']}'>Delete</a></td> 
                      <td><a style='padding:4px' href='update_fitness_plan.php?plan_id={$row['plan_id']}'>Update</a></td> 
                    </tr>";
          }
      } else {
          // If no data is found, display a message in the table
          echo "<tr><td colspan='8'>No data found</td></tr>";
      }
      ?>
    </table>
  </section>

  <footer>
    <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @ENOCK</h2> <!-- Corrected "Designer" to "Designed" -->
  </footer>
</body>
</html>

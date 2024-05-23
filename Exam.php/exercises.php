<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exercise Information</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* CSS styles for consistent styling */
    /* Your existing CSS styles here */
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


  <h1>Exercise Form</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <!-- Exercise form fields -->
    <label for="exercise_id">Exercise ID:</label>
    <input type="number" id="exercise_id" name="exercise_id" required><br><br>

    <label for="exercise_name">Exercise Name:</label>
    <input type="text" id="exercise_name" name="exercise_name" required><br><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="muscle_group">Muscle Group:</label>
    <input type="text" id="muscle_group" name="muscle_group" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br>
    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
  include('database_connection.php'); // Include the database connection

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Retrieve input values from POST request
    $exercise_id = $_POST['exercise_id'];
    $exercise_name = $_POST['exercise_name'];
    $description = $_POST['description'];
    $muscle_group = $_POST['muscle_group'];

    // Prepare SQL statement for insertion
    $stmt = $connection->prepare("INSERT INTO exercises (exercise_id, exercise_name, description, muscle_group) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $exercise_id, $exercise_name, $description, $muscle_group); // Bind parameters

    // Execute the statement and check for success
    if ($stmt->execute()) {
      echo "New record has been added successfully.<br><br><a href='exercises.php'>Back to Form</a>";
    } else {
      echo "Error inserting data: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
  }
  ?>

  <section>
    <h2>Exercise Details</h2>
    <table>
      <tr>
        <th>Exercise ID</th>
        <th>Exercise Name</th>
        <th>Description</th>
        <th>Muscle Group</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      // Select all exercises from the database
      $sql = "SELECT * FROM exercises";
      $result = $connection->query($sql); // Execute the query

      if ($result->num_rows > 0) {
        // Loop through the results and generate table rows
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['exercise_id']}</td>
                  <td>{$row['exercise_name']}</td>
                  <td>{$row['description']}</td>
                  <td>{$row['muscle_group']}</td>
                  <td><a style='padding:4px' href='delete_exercises.php?exercise_id={$row['exercise_id']}'>Delete</a></td> 
                  <td><a style='padding:4px' href='update_exercises.php?exercise_id={$row['exercise_id']}'>Update</a></td> 
                </tr>";
        }
      } else {
        // If no data is found, display a message in the table
        echo "<tr><td colspan='6'>No data found</td></tr>";
      }
      ?>
    </table>
  </section>

  <footer>
    <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @ENOCK</h2>
  </footer>
</body>
</html>

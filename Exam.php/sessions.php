<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sessions Information</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* CSS styles for consistent styling */
    /* Comments */
    /* This is a comment */
    a:link {
      color: #0066cc;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
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
    }
    /* Table Cells */
    td, th {
      padding: 8px;
      border-bottom: 1px solid #dddddd;
      border: 2px solid black; /* Table borders */
      text-align: left;
    }
    /* Hover Effect */
    tr:hover {
      background-color: #e9e9e9;
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
          <li style="display: inline; margin-right: 8px;"><a href="./home.html">HOME</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./clients.php">Clients</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./exercises.php">Exercises</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./fitness_plan.php">Fitness Plans</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./client_goals.php">client_goals</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./reviews.php">Reviews</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./sessions.php">Sessions</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./trainees.php">Trainees</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./trainers.php">Trainers</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./workout_plans.php">Workout Plans</a></li>
          <li style="display: inline; margin-right: 10px;"><a href="./client_payments.php">client_payments</a></li>
        </ul>
      </li>
      <li class="dropdown" style="display: inline; margin-right: 10px;">
        <a href="#" style="padding: 10px; color: white; background-color: greenyellow; text-decoration: none; margin-right: 15px;">Settings</a>
        <div class="dropdown-contents">
          <!-- Links inside the dropdown menu -->
          <a href="login.php">Login</a>
          <a href="register.php">Register</a>
          <a href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </header>
  <body style="background-color: yellowgreen;">
    <h1>Sessions Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
      <!-- Session form fields -->
      <label for="session_id">Session ID:</label>
      <input type="number" id="session_id" name="session_id" required><br><br>

      <label for="trainer_id">Trainer ID:</label>
      <input type="number" id="trainer_id" name="trainer_id" required><br><br>

      <label for="trainee_id">Trainee ID:</label>
      <input type="number" id="trainee_id" name="trainee_id" required><br><br>

      <label for="session_date">Session Date:</label>
      <input type="date" id="session_date" name="session_date" required><br><br>

      <label for="session_time">Session Time:</label>
      <input type="time" id="session_time" name="session_time" required><br><br>

      <label for="session_status">Session Status:</label>
      <select id="session_status" name="session_status" required>
        <option value="Scheduled">Scheduled</option>
        <option value="Ongoing">Ongoing</option>
        <option value="Completed">Completed</option>
        <option value="Cancelled">Cancelled</option>
      </select><br><br>

      <input type="submit" name="add" value="Insert"><br><br>
      <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
    include('database_connection.php'); // Include the database connection

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      // Retrieve input values from POST request
      $session_id = $_POST['session_id'];
      $trainer_id = $_POST['trainer_id'];
      $trainee_id = $_POST['trainee_id'];
      $session_date = $_POST['session_date'];
      $session_time = $_POST['session_time'];
      $session_status = $_POST['session_status'];

      // Prepare SQL statement for insertion
      $stmt = $connection->prepare("INSERT INTO sessions (session_id, trainer_id, trainee_id, session_date, session_time, session_status) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("iiiiss", $session_id, $trainer_id, $trainee_id, $session_date, $session_time, $session_status); // Bind parameters

      // Execute the statement and check for success
      if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br><a href='sessions.php'>Back to Form</a>";
      } else {
        echo "Error inserting data: " . $stmt->error;
      }

      // Close the statement
      $stmt->close();
    }
    ?>

    <section>
      <h2>Sessions Detail</h2>
      <table>
        <tr>
          <th>Session ID</th>
          <th>Trainer ID</th>
          <th>Trainee ID</th>
          <th>Session Date</th>
          <th>Session Time</th>
          <th>Session Status</th>
          <th>Delete</th>
          <th>Update</th>
        </tr>
        <?php
        // Select all sessions from the database
        $sql = "SELECT * FROM sessions";
        $result = $connection->query($sql); // Execute the query

        if ($result->num_rows > 0) {
          // Loop through the results and generate table rows
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['session_id']}</td>
                    <td>{$row['trainer_id']}</td>
                    <td>{$row['trainee_id']}</td>
                    <td>{$row['session_date']}</td>
                    <td>{$row['session_time']}</td>
                    <td>{$row['session_status']}</td>
                    <td><a style='padding:4px' href='delete_sessions.php?session_id={$row['session_id']}'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_sessions.php?session_id={$row['session_id']}'>Update</a></td> 
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
      <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @ENOCK</h2>
    </footer>
  </body>
</html>

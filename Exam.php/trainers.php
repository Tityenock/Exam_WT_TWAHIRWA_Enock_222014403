<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"> <!-- Proper character encoding -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->
  <title>Trainers Information</title>
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

  <h1>Trainers Form</h1>
  <form method="post"  onsubmit="return confirmInsert();">
    <label for="trainer_id">Trainer ID:</label>
    <input type="number" id="trainer_id" name="trainer_id" required><br><br>

    <label for="expertise">Expertise:</label>
    <input type="text" id="expertise" name="expertise" required><br><br>

    <label for="certification">Certification:</label>
    <input type="text" id="certification" name="certification" required><br><br>

    <label for="hourly_rate">Hourly Rate:</label>
    <input type="number" id="hourly_rate" name="hourly_rate" required><br><br>

    <label for="availability">Availability:</label>
    <input type="text" id="availability" name="availability" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br>

    <a href="./home.html">Go Back to Home</a>
  </form>

  <!-- PHP Code to Handle Trainer Insertion -->
  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      $trainer_id = $_POST['trainer_id'];
      $expertise = $_POST['expertise'];
      $certification = $_POST['certification'];
      $hourly_rate = $_POST['hourly_rate'];
      $availability = $_POST['availability'];

      $stmt = $connection->prepare("INSERT INTO trainers (trainer_id, expertise, certification, hourly_rate, availability) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("issss", $trainer_id, $expertise, $certification, $hourly_rate, $availability);

      if ($stmt->execute()) {
          echo "New record has been added successfully.<br><br><a href='trainers.php'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $stmt->error;
      }

      $stmt->close();
  }
  ?>

  <!-- Trainers Detail Section -->
  <section>
    <h2>Trainers Detail</h2>
    <table>
      <tr>
        <th>Trainer ID</th>
        <th>Expertise</th>
        <th>Certification</th>
        <th>Hourly Rate</th>
        <th>Availability</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      $sql = "SELECT * FROM trainers";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>{$row['trainer_id']}</td>
                      <td>{$row['expertise']}</td>
                      <td>{$row['certification']}</td>
                      <td>{$row['hourly_rate']}</td>
                      <td>{$row['availability']}</td>
                      <td><a style='padding:4px' href='delete_trainers.php?trainer_id={$row['trainer_id']}'>Delete</a></td> 
                      <td><a style='padding:4px' href='update_trainers.php?trainer_id={$row['trainer_id']}'>Update</a></td> 
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='7'>No data found</td></tr>";
      }
      ?>
    </table>
  </section>

  <!-- Footer -->
  <footer>
    <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @ENOCK</h2>
  </footer>
</body>
</html>

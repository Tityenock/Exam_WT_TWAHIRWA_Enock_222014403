<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Connection details
include('database_connection.php');
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'clients' => "SELECT start_date FROM clients WHERE  start_date LIKE '%$searchTerm%'",
        'client_goals' => "SELECT goal_description FROM client_goals WHERE goal_description LIKE '%$searchTerm%'",
        'client_payments' => "SELECT payment_date FROM client_payments WHERE payment_date LIKE '%$searchTerm%'",
        'exercises' => "SELECT exercise_name FROM exercises WHERE exercise_name LIKE '%$searchTerm%'",
        'fitness_plan' => "SELECT plan_name FROM fitness_plan WHERE plan_name LIKE '%$searchTerm%'",
        'reviews' => "SELECT review_content FROM reviews
        WHERE review_content LIKE '%$searchTerm%'",
        'sessions' => "SELECT   session_status FROM sessions WHERE  session_status LIKE '%$searchTerm%'",
        'trainees' => "SELECT   medical_conditions FROM trainees WHERE  medical_conditions LIKE '%$searchTerm%'",
        'trainers' => "SELECT availability FROM trainers WHERE availability LIKE '%$searchTerm%'",
        'workout_plans' => "SELECT description FROM workout_plans WHERE description LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result =$connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 03:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtualpersonaltraining_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `trainer_id`, `start_date`, `end_date`) VALUES
(1, 1, '2024-01-01', '2024-03-08'),
(2, 2, '2024-02-15', '2024-05-15'),
(3, 3, '2024-03-10', '2024-06-10'),
(4, 1, '2024-04-05', '2024-07-05'),
(5, 2, '2024-05-20', '2024-08-20'),
(6, 3, '2024-06-25', '2024-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `client_goals`
--

CREATE TABLE `client_goals` (
  `goal_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `goal_description` text DEFAULT NULL,
  `target_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_goals`
--

INSERT INTO `client_goals` (`goal_id`, `client_id`, `goal_description`, `target_date`) VALUES
(1, 1, 'Lose 1 pounds', '2024-07-01'),
(2, 1, 'Increase muscle mass', '2024-08-15'),
(3, 2, 'Run a 5k race', '2024-09-30'),
(4, 3, 'Improve flexibility', '2024-07-15'),
(5, 4, 'Reduce stress', '2024-08-01'),
(6, 4, 'Improve posture', '2024-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `client_payments`
--

CREATE TABLE `client_payments` (
  `payment_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_payments`
--

INSERT INTO `client_payments` (`payment_id`, `client_id`, `amount`, `payment_date`) VALUES
(1, 5, 50.00, '0000-00-00'),
(2, 2, 100.00, '2024-05-05'),
(3, 3, 75.00, '2024-05-03'),
(4, 4, 120.00, '2024-05-02'),
(5, 1, 60.00, '2024-05-07'),
(6, 2, 90.00, '2024-05-10'),
(7, 4, 150.00, '2024-05-11');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `exercise_id` int(11) NOT NULL,
  `exercise_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `muscle_group` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`exercise_id`, `exercise_name`, `description`, `muscle_group`) VALUES
(1, 'Push', 'Push-ups are a bodyweight exercise that primarily targets the chest, shoulders, and triceps.', 'Upper Body'),
(2, 'Squat', 'Squats are a compound exercise that targets the quadriceps, hamstrings, glutes, and lower back.', 'Lower Body'),
(3, 'Lunges', 'Lunges are a unilateral exercise that targets the quadriceps, hamstrings, glutes, and calves.', 'Lower Body'),
(4, 'Deadlift', 'Deadlifts are a compound exercise that targets the lower back, glutes, hamstrings, and forearms.', 'Lower Body'),
(5, 'Pull-up', 'Pull-ups are a bodyweight exercise that primarily targets the back, biceps, and shoulders.', 'bbbbbb'),
(6, 'Plank', 'Planks are a core-strengthening exercise that targets the abdominals, obliques, and lower back.', 'Core');

-- --------------------------------------------------------

--
-- Table structure for table `fitness_plan`
--

CREATE TABLE `fitness_plan` (
  `plan_id` int(11) NOT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `plan_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fitness_plan`
--

INSERT INTO `fitness_plan` (`plan_id`, `trainer_id`, `plan_name`, `description`, `duration`, `price`) VALUES
(1, 1, 'Twahirwa', 'A beginner-friendly full-body workout plan suitable for those new to fitness.', 120, 300.00),
(4, 1, 'Beginner Full Body Workout', 'A beginner-friendly full-body workout plan suitable for those new to fitness.', 30, 50.00),
(5, 2, 'Advanced Muscle Building Program', 'An advanced muscle-building program designed for experienced lifters aiming to increase muscle mass.', 60, 80.00);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `trainee_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_content` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `trainer_id`, `trainee_id`, `rating`, `review_content`, `timestamp`) VALUES
(1, 1, 1, 1999, 'Excellent trainer, very knowledgeable and supportive.', '2024-05-07 17:39:00'),
(2, 2, 2, 4, 'Great experience overall, trainer provided effective workouts.', '2024-05-07 17:39:04'),
(3, 3, 3, 5, 'Highly recommend this trainer, helped me achieve my fitness goals.', '2024-05-07 17:39:04'),
(4, 1, 4, 4, 'Good sessions, trainer was attentive and motivating.', '2024-05-07 17:39:04'),
(5, 2, 5, 3, 'ooooooo', '2024-06-06 11:39:00'),
(6, 1, 2, 7, 'Excellent trainer, very knowledgeable and supportive.', '2024-05-08 03:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `trainee_id` int(11) DEFAULT NULL,
  `session_date` date DEFAULT NULL,
  `session_time` time DEFAULT NULL,
  `session_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `trainer_id`, `trainee_id`, `session_date`, `session_time`, `session_status`) VALUES
(1, 1, 1, '2024-05-15', '10:00:00', 'Scheduled'),
(2, 2, 2, '2024-05-12', '15:00:00', 'Cancelled'),
(3, 3, 3, '2024-05-15', '09:00:00', 'Pending'),
(4, 1, 4, '2024-05-18', '17:00:00', 'Confirmed'),
(5, 2, 5, '2024-05-20', '14:00:00', 'Cancelledbbbbbbbbbbbb'),
(6, 1, 1, '0000-00-00', '17:35:00', 'sdfghnjm,.vbnmnb');

-- --------------------------------------------------------

--
-- Table structure for table `trainees`
--

CREATE TABLE `trainees` (
  `trainee_id` int(11) NOT NULL,
  `goals` text DEFAULT NULL,
  `fitness_level` int(11) DEFAULT NULL,
  `preferred_workout_time` time DEFAULT NULL,
  `medical_conditions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainees`
--

INSERT INTO `trainees` (`trainee_id`, `goals`, `fitness_level`, `preferred_workout_time`, `medical_conditions`) VALUES
(1, 'Build muscle mass and strength', 6, '24:05:08', 'jhgfds'),
(2, 'Lose weight and improve cardiovascular health', 2, '00:20:24', 'kkkkffftdfffggff'),
(3, 'Increase flexibility and reduce stress', 1, '00:00:00', 'hgjgfhjhgfdfg'),
(4, 'Improve overall fitness and endurance', 2, '00:00:00', 'None'),
(5, 'Enhance athletic performance and agility', 3, '00:00:00', 'None'),
(7, 'jhgfrdes', 6, '18:29:00', 'gfds');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainer_id` int(11) NOT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `certification` varchar(255) DEFAULT NULL,
  `hourly_rate` decimal(10,2) DEFAULT NULL,
  `availability` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainer_id`, `expertise`, `certification`, `hourly_rate`, `availability`) VALUES
(1, 'Strength Training', 'ISSA Certified Personal Trainer', 80.00, 'Monday-Friday, 9am-5pm'),
(2, 'Yoga Instruction', 'RYT 200 Certified Yoga Instructor', 60.00, 'Monday-Saturday, 8am-12pm'),
(3, 'Cardio Fitness', 'NASM Certified Personal Trainer', 55.00, 'Tuesday-Thursday, 6pm-9pm'),
(4, 'Pilates Instruction', 'Certified Pilates Instructor', 70.00, 'Wednesday-Sunday, 10am-2pm'),
(5, 'CrossFit Coaching', 'CrossFit Level 1 Trainer', 65.00, 'Monday-Wednesday-Friday, 5pm-8pm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, '222014403', '$2y$10$dl8V87hWDe7xJErsrLmrhOW1baP6F9b1eTGPh18GZwcj0CwdQI7NW', 'shemaloys10@gmail.com'),
(6, 'niyomuhoza', '$2y$10$13w2hg12Q9vKq6MFAp2pXOL4VhMjsUijQAQR9TwRpxQiVeTprfljG', 'shemaloys0@gmail.com'),
(7, 'sam', '$2y$10$a1fUB73Wl5Gd.q.ZfJXxKOszihAS5sawlDQO0lheP8x6mmP3bWK.K', 'sa3@gmail.com'),
(10, '222006086', '$2y$10$HZRud/KUe3AZ7o2HqN8g8u7WXSiwIPhwbKZK1Bk.V77hBre4M9txO', 'faustin@gmail.com'),
(11, 'enock', '$2y$10$5fvlTVzYd/XEIDLGZYTPyefGpMOfuWy6k1xkHFO.oTLblbePBUv3K', 'enock@gmail.com'),
(16, 'Twahirwa', '$2y$10$EUiDkWRY1CWxd3ylzZHZdeONM24/YHspVAKrPUP890ILUrv2tuEyC', 'twahi@gmail.com'),
(17, 'Aloys', '$2y$10$j/hNuMt5PAbFe.Vt6OXmv.p8tnecEal284sGJ4v0ygMOjaiocQBA.', 'aloys@gmail.com'),
(18, 'Shema', '$2y$10$fnhJM2ZLzXvRv3UeUbEcSOG2aj/95awcj9QNSdHgi2sExwUHUK/.G', 'shema@gmail.com'),
(19, 'Samuel', '$2y$10$s/TOYGICD7cziHWIqTJ1keDodDmPcfRpJy6k9/u82vrLe6N4SfZpW', 'sam@gmail.com'),
(20, 'Paul@gmail.com', '$2y$10$//Ppu.Rj25FAm6eyzX0tKOST5WGG.eRXEDlLCbnSF.LmssXXgJm5y', 'paul@gmail.com'),
(21, 'pratais', '$2y$10$VKTjrRiKx3Ee6rgy3YbK8u39O/UFZyqXhpf4O36jBx6OizPLuLViy', 'protais@gmail.coo');

-- --------------------------------------------------------

--
-- Table structure for table `workout_plans`
--

CREATE TABLE `workout_plans` (
  `plan_id` int(11) NOT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `plan_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_plans`
--

INSERT INTO `workout_plans` (`plan_id`, `trainer_id`, `plan_name`, `description`, `duration`, `price`) VALUES
(1, 5, 'Strength Training Program', 'A comprehensive strength training program focusing on building muscle mass and strength.', 12, 100.00),
(2, 2, 'Yoga for Beginners', 'An introductory yoga program suitable for beginners to improve flexibility and reduce stress.', 8, 80.00),
(3, 3, 'Cardiovascular Conditioning Plan', 'A cardio-focused workout plan aimed at improving cardiovascular health and endurance.', 10, 90.00),
(4, 1, 'Weight Loss Workout Routine', 'A customized workout routine designed to help individuals achieve their weight loss goals.', 16, 120.00),
(5, 2, 'Functional Fitness Program', 'A functional fitness program incorporating exercises to improve everyday movements and prevent injuries.', 12, 100.00),
(6, 3, 'HIIT (High-Intensity Interval Training)', 'An intense workout program combining short bursts of high-intensity exercises with periods of rest.', 8, 80.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_goals`
--
ALTER TABLE `client_goals`
  ADD PRIMARY KEY (`goal_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client_payments`
--
ALTER TABLE `client_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`exercise_id`);

--
-- Indexes for table `fitness_plan`
--
ALTER TABLE `fitness_plan`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `trainer_id` (`trainer_id`),
  ADD KEY `trainee_id` (`trainee_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `trainer_id` (`trainer_id`),
  ADD KEY `trainee_id` (`trainee_id`);

--
-- Indexes for table `trainees`
--
ALTER TABLE `trainees`
  ADD PRIMARY KEY (`trainee_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `client_goals`
--
ALTER TABLE `client_goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `client_payments`
--
ALTER TABLE `client_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11112;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fitness_plan`
--
ALTER TABLE `fitness_plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
  MODIFY `trainee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `workout_plans`
--
ALTER TABLE `workout_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_goals`
--
ALTER TABLE `client_goals`
  ADD CONSTRAINT `client_goals_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `client_payments`
--
ALTER TABLE `client_payments`
  ADD CONSTRAINT `client_payments_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `fitness_plan`
--
ALTER TABLE `fitness_plan`
  ADD CONSTRAINT `fitness_plan_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`trainer_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`trainer_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`trainee_id`) REFERENCES `trainees` (`trainee_id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`trainer_id`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`trainee_id`) REFERENCES `trainees` (`trainee_id`);

--
-- Constraints for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD CONSTRAINT `workout_plans_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`trainer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

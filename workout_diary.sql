-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Час створення: Лис 28 2018 р., 14:19
-- Версія сервера: 5.6.37
-- Версія PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `workout_diary`
--

-- --------------------------------------------------------

--
-- Структура таблиці `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_description`) VALUES
(1, 'Finger strength ', 'Max finger strength is your ability to grab a hold for 5 to 10 seconds, and it is employed in lockoff cruxes or on moves that require latching tiny or slopey holds. Finger-strength gains can come from any climbing that has moves or holds that are taxing on the fingers, like bouldering at your limit, but the extraneous movement won’t translate directly to finger strength. Hangboarding targets this important element of climbing.'),
(2, 'Endurance', 'Local endurance is your ability to stay on the wall for long periods of time at a certain grade. The main benefit is that it raises the difficulty level at which you can rest. If you can climb 5.10 without feeling pumped, then reaching a section of 5.10 climbing after a crux provides an opportunity to shake out and recover. You’ll feel fresh for the next hard section. '),
(3, 'Power endurance', 'Power-endurance training is best done after establishing a solid base of strength and power training, because it will convert some of that maximum strength into endurance. You’ll lose a little strength and power in the process, but it’ll pay off on longer routes where you’re fighting a pump. The common methods for training power-endurance all involve lots of climbing, usually in circuits or laps. Your muscles must be working hard, but not at their max, so you’ll want to focus on 50 to 80 percent of your limit.'),
(4, 'Explosive power', 'Increasing power requires several different muscular changes in your forearms, but they’ll all be trained at the same time through the following approach. Broadly, the adaptations fit under the category of contact strength, which is how much force you can apply the moment you touch a hold. If you lack good contact strength, you might find it easy to slowly grasp a hold from the ground, but can’t grip the same hold during a dynamic movement, in which you must latch it instantly. Training power forces your body to use more muscle fibers at once, as well as alters the types of fibers from slow twitch to fast twitch.');

-- --------------------------------------------------------

--
-- Структура таблиці `category_drill`
--

CREATE TABLE IF NOT EXISTS `category_drill` (
  `fk_category_id` int(11) NOT NULL,
  `fk_drill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `category_drill`
--

INSERT INTO `category_drill` (`fk_category_id`, `fk_drill_id`) VALUES
(1, 3),
(1, 5),
(1, 12),
(2, 1),
(2, 2),
(2, 4),
(3, 1),
(3, 2),
(3, 5),
(3, 6),
(4, 3),
(4, 6),
(4, 12);

-- --------------------------------------------------------

--
-- Структура таблиці `drill`
--

CREATE TABLE IF NOT EXISTS `drill` (
  `id` int(11) NOT NULL,
  `drill_name` varchar(100) NOT NULL,
  `drill_description` text NOT NULL,
  `drill_url` varchar(255) NOT NULL,
  `drill_date_of_adding` date NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `drill`
--

INSERT INTO `drill` (`id`, `drill_name`, `drill_description`, `drill_url`, `drill_date_of_adding`, `fk_user_id`) VALUES
(1, 'Circuits', 'Picking three to five boulder problems, each three grades below your limit, is a good place to start. Instead of climbing the same problem back-to-back, climb each problem once, only coming off the wall to move between them. This will be your circuit. Your circuits can have rests, but don’t remove your pump completely.\r\n\r\nAfter climbing your circuit once, rest for the same duration of time you spent on the wall. If you fall from being pumped, end your circuit and rest. If a foot slip or botched move spits you off, jump right back on. After completing your circuit four times with equal rests, take a longer break of 5 to 10 minutes. Next, start another set of four circuits on the same or new problems.\r\nMimic your project if you have one. For example, if it’s a long section of V1 followed by a V3 at the top, pick three problems in the V1 range, followed by a V3. You’ll progress in your circuits by either shortening your rests or by choosing harder problems. Try starting sets 30 seconds sooner and see how much harder they feel.', 'https://www.youtube.com/watch?v=Lt4udIyQyIM', '2018-11-01', 1),
(2, '4x4s', 'To complete a 4x4, pick four different boulder problems about three grades below your limit. Climb the first problem four times, dropping off and repeating the problem immediately, or downclimbing an easy route back to the start. Rest for two minutes, then climb the next problem the same way. Complete all four problems like this, then rest 5 minutes. That’s one set. Pick new problems, or repeat the same set again. Aim for three sets.\r\n\r\n', 'https://www.youtube.com/watch?v=xyPA0AH8hG0&t=91s', '2018-11-01', 1),
(3, 'Campus Board', 'Starting out on the campus board, use the largest rails. You may need to use foot rungs to take some weight off your hands. The lower the foot rung, the easier the move will be. Eventually, the goal is to not use your feet. If you are using feet, focus on only resting your feet on the hold, not pushing with them. Pull with your arms, and keep in mind that you can change foot position throughout a session, moving to easier rungs as you get more tired.\r\nFor a basic campus move, start with hands matched on the lowest rail, exploding up to the next rail with one hand and grabbing it at the highest point of your movement. Jumping between rungs will feel uncontrolled at first, but keep your core and legs tight, and maintain body tension throughout the move. Expect to latch the next rung, and you probably will.\r\n\r\nFor your first workout, do four rounds of match ladders, followed by four sets of basic ladders (both described below). After each round, rest two minutes then switch the starting hand for the next round. Rest as much as you need to feel fresh for your next set.\r\n\r\nAfter a few weeks, match and basic ladders may feel easy, so it’s time to up the difficulty. Harder variations will train power in the arms and shoulders, while bumps will focus on contact strength. To start, do two sets of both matches and basic ladders, then two sets of harder ladders and bumps.', 'https://www.climbing.com/videos/training-with-adam-ondra-power-endurance/', '2018-11-01', 1),
(4, 'ARC training', 'The aim of ARC training is to create more of the tiny blood vessels (capillaries) in your forearms. By climbing lots of terrain below your limit, you’ll actually develop more small blood vessels, and the existing ones will become wider. Both changes will make it harder for a pump to set in, meaning you can climb longer and recover faster.\r\nARC training is done by climbing easy terrain for 15 to 45 minutes at a time while maintaining a very light pump. Common methods include traversing a bouldering wall, or moving up and down routes on toprope or autobelay without coming off.\r\n\r\nFirst, pick a type of terrain to cover. Vertical to slightly overhanging terrain is best because it keeps some weight on your arms, but not too much. If you can find a route or section of the wall with multiple angles in this range, that’s even better. Training on different angles will allow you to fine-tune your technique, and help break up the monotony of long sets.\r\n\r\nNext, you’ll need to figure out how hard your target route or traverses should be. If you’ve never done ARC-style training before, start at 5.6 or 5.7 and up the grade as necessary. If you’re traversing, or don’t have a graded route to climb on, use holds that create a light pump that you can maintain for a long time. The climbing should be fairly continuous, with no hard moves that could cause a fall. It’s best if you can move without pausing to shake out frequently. The idea is to be climbing and moving, not just on the wall, for as long as possible.\r\n\r\nFor a first-timer, regardless of redpoint ability, moving continuously on the wall for 10 minutes might feel impossible, even on a vertical 5.6 or V0 boulder problem. If this happens to you, try sets of 5 minutes on, 5 minutes off, aiming for a total on-the-wall time of 30 to 45 minutes per session. Next session, try 10 minutes on, 10 minutes off, and so on. Advanced climbers may need to start just as low as beginners if they’ve never done local endurance training, but all climbers should progress quickly.', 'https://www.youtube.com/watch?v=vsvGcjTcQbs&t=91s', '2018-11-01', 3),
(5, 'Hangboard', 'For a basic hangboard workout, do 10 sets of five hangs on a variety of holds. To start, use a large edge, small edge/crimp, 2-finger pocket, 3-finger pocket, and sloper. Each hold will be used twice in a row, and every hold except the small edge will be done with an open-hand grip. Smaller holds can be used with the half-crimp or full-crimp positions, but the full-crimp should be reserved for climbers experienced with training, as it’s the most likely to cause injury.\n\nThe Workout:\nHold 1: 10-second hang, 5-second rest\nRepeat the hang/rest cycle 5 times in a row, totaling 50 seconds on and 25 off, then rest 3 minutes\nHold 1 (same hold again, same grip style): 10-second hang, 5-second rest\nRepeat the hang/rest cycle 5 times, then rest 3 minutes\nHold 2: 10-second hang, 5-second rest\nRepeat the hang/rest cycle 5 times, then rest 3 minutes\nHold 2 (same hold again, same grip style): 10-second hang, 5-second rest\nRepeat the hang/rest cycle 5 times, then rest 3 minutes\nProgressing\nAfter two to four workouts, you should find the last rep of each set to be a little easier, and you might not be failing on any of your last reps. This means it’s time to up the difficulty. The best way to do this is by increasing the weight you’re holding. It’s easy to track, and doesn’t require any additional testing for new holds.\n\nAdd 1.5 to 2.5 pounds (lighter climbers try lighter weight; if that feels too easy, go for 2 or 2.5 pounds) to every set in your next workout. Do this by wearing a harness and strapping weight to the belay loop or tie-in points. Some folks use a weight vest, but that can actually change your hanging posture, which can lead to injury. You’ll notice that early reps in a set will still feel about the same, but the last rep of each set will feel much harder. After another two to four sessions, the increased weight should feel easy again—that’s when you’ll add another 1.5 to 2.5 pounds.', 'https://www.youtube.com/watch?v=9qtSJrDhb-k', '2018-11-01', 2),
(6, 'TRX', 'Do this 2x/week on rest days.\r\nDo each exercise at least once, but you can do up to 3 sets of each exercise.\r\nTransition and rest 30 seconds between each exercise and 2 minutes between each round or circuit.\r\nMid-calf (see below) means stirrups should come to mid-calf. “Long” is slightly longer than that; “short” is shorter.', 'https://www.climbing.com/skills/suspension-trainisuspension-training-for-rock-climbingng-for-rock-climbing/', '2018-11-01', 1),
(12, 'Forearm', 'For more details watch the video', 'https://www.youtube.com/watch?v=ntWUYhZjPaU', '2018-11-25', 3);

-- --------------------------------------------------------

--
-- Структура таблиці `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL,
  `role_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `role`
--

INSERT INTO `role` (`id`, `role_name`, `role_description`) VALUES
(1, 'Admin', 'Admin can assign role to users (user or coach)'),
(2, 'User', 'Signed up user can make his/her own trainings from existing list of drills, that are available for signed up users only.'),
(3, 'Coach', 'Coach is a person who publishes single drills, so as the user can choose from the list of drills and make his/her own trainings. ');

-- --------------------------------------------------------

--
-- Структура таблиці `training`
--

CREATE TABLE IF NOT EXISTS `training` (
  `id` int(11) NOT NULL,
  `training_date` date NOT NULL,
  `training_notes` text,
  `fk_user_id` int(11) NOT NULL,
  `training_aim` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `training`
--

INSERT INTO `training` (`id`, `training_date`, `training_notes`, `fk_user_id`, `training_aim`) VALUES
(1, '2018-11-01', 'Aim: improve power endurance. Complete a hangboard workout (complete 3 sets, 5 reps for each set). ', 2, ''),
(3, '2018-11-05', 'Aim: complete 4x4 boulder prorblems. each boulder prroblem difficulty level is 6B.', 1, ''),
(51, '2018-11-23', 'Hello', 3, 'Improve endurance'),
(52, '2018-11-30', '', 3, 'Improve endurancce'),
(53, '2018-11-28', '', 16, 'Get stronger'),
(54, '2018-12-01', '', 3, 'Impove power endurance');

-- --------------------------------------------------------

--
-- Структура таблиці `training_drill`
--

CREATE TABLE IF NOT EXISTS `training_drill` (
  `training_drill_description` text,
  `fk_training_id` int(11) NOT NULL,
  `fk_drill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `training_drill`
--

INSERT INTO `training_drill` (`training_drill_description`, `fk_training_id`, `fk_drill_id`) VALUES
('Week 1 (x2)\r\nOpen hand: 3 sets of 3-6-9\r\nFull crimp: 3 sets of 3-6-9\r\nHalf crimp: 3 sets of 3-6-9', 1, 5),
('Circuits 5 min on 5 min off', 51, 1),
('Circuits 5 min on 5 min off', 52, 1),
('Circuits bla bla', 53, 1),
('5min on, 5 min off', 54, 1),
('4x4 (v3,v4,v5 )', 54, 2);

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `u_surname` varchar(100) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_username` varchar(100) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_registration_date` timestamp NOT NULL,
  `fk_role_id` int(1) NOT NULL DEFAULT '2',
  `u_delete` tinyint(4) NOT NULL DEFAULT '0',
  `coach_permission` int(1) NOT NULL DEFAULT '0',
  `name_of_pdf` varchar(255) NOT NULL,
  `message_to_admin` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `u_name`, `u_surname`, `u_email`, `u_username`, `u_password`, `u_registration_date`, `fk_role_id`, `u_delete`, `coach_permission`, `name_of_pdf`, `message_to_admin`) VALUES
(1, 'Olesya', 'Dudchuk', 'leskadudchuk@gmail.com', 'olesia', '$2y$10$OxAi5Ua7H1IqH0h4PJKjM.UxdU.04.PwSqGHuz3W/469IwmK8Q.0m', '2018-11-15 21:23:45', 1, 0, 0, '', ''),
(2, 'Laila', 'Fenr', 'laila_fenr@yahoo.com', 'laila', '$2y$10$qB48Gqqre7wSyjD.hDSXDuux9VFiXB8VsbaExkG.oN/VGiF19AIX.', '2018-11-28 11:45:30', 3, 0, 0, 'zadani-sp (1).pdf', ''),
(3, 'Anastasia', 'Swqa', 'natalie@gmail.com', 'natali', '$2y$10$pfYBxk46dyyxiGGtYp53Fez6MWyKFx1HzrxgIEo/Uq/vfRIl44Ygy', '2018-11-28 11:45:48', 3, 0, 0, 'example_GA.pdf', 'Hello Admin'),
(16, 'Darya', 'Zenko', 'darya.zenko.96@mail.ru', 'daryazenko', '$2y$10$Tz5Maogst9zAYxd.3RGg9enYlz/CqonZR0mD5YVH0.LggWrrcEdIW', '2018-11-28 10:23:09', 3, 0, 0, 'example_GA.pdf', 'let me to be a coach'),
(17, 'Helen', 'Warsal', 'helen@gmail.com', 'helen2000', '$2y$10$QXmHtWywyXa72rz/fiHHDO8b2LrHjYChldmVKM6zy5VpBgFHCBIt.', '2018-11-28 10:23:23', 2, 0, 1, 'workout_diary.pdf', 'Whant to be a coach'),
(18, 'Jane', 'Kim', 'jane_kim@yahoo.com', 'jainkim', '$2y$10$2pYiLzgpWvK2BjRG9Bdd8.4Iflb6uSdyKVrHvZ/NJW5QSbrpSQFGO', '2018-11-25 09:12:46', 3, 0, 0, 'manual GA.pdf', 'Whant to be a coach');

-- --------------------------------------------------------

--
-- Структура таблиці `user_session`
--

CREATE TABLE IF NOT EXISTS `user_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `category_drill`
--
ALTER TABLE `category_drill`
  ADD PRIMARY KEY (`fk_category_id`,`fk_drill_id`),
  ADD KEY `fk_category_id` (`fk_category_id`),
  ADD KEY `fk_drill_id` (`fk_drill_id`);

--
-- Індекси таблиці `drill`
--
ALTER TABLE `drill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Індекси таблиці `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Індекси таблиці `training_drill`
--
ALTER TABLE `training_drill`
  ADD PRIMARY KEY (`fk_training_id`,`fk_drill_id`),
  ADD KEY `training_id` (`fk_training_id`),
  ADD KEY `drill_id` (`fk_drill_id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_email` (`u_email`),
  ADD UNIQUE KEY `u_username` (`u_username`),
  ADD KEY `fk_role_id` (`fk_role_id`);

--
-- Індекси таблиці `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблиці `drill`
--
ALTER TABLE `drill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблиці `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблиці `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблиці `user_session`
--
ALTER TABLE `user_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `category_drill`
--
ALTER TABLE `category_drill`
  ADD CONSTRAINT `category_drill_ibfk_1` FOREIGN KEY (`fk_category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_drill_ibfk_2` FOREIGN KEY (`fk_drill_id`) REFERENCES `drill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `drill`
--
ALTER TABLE `drill`
  ADD CONSTRAINT `drill_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `training_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `training_drill`
--
ALTER TABLE `training_drill`
  ADD CONSTRAINT `training_drill_ibfk_1` FOREIGN KEY (`fk_training_id`) REFERENCES `training` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `training_drill_ibfk_2` FOREIGN KEY (`fk_drill_id`) REFERENCES `drill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

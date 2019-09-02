

CREATE TABLE `exams` (
  `exam_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `exam_question` varchar(255) NOT NULL,
  `exam_option` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `duration` varchar(255) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

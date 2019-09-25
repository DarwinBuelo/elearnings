ALTER TABLE exams
ADD title TEXT NOT NULL AFTER date_created,
ADD attempts INT NOT NULL AFTER items,
ADD passing_score INT NOT NULL AFTER attempts,
ADD exam_date DATETIME NOT NULL AFTER passing_score,
ADD exam_due DATETIME NOT NULL AFTER exam_date;
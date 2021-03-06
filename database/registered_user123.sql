CREATE TABLE registered_user (
  registered_user_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  student_id varchar(225) NOT NULL,
  password LONGTEXT,
  date TIMESTAMP NOT NULL,
  student_name varchar(225) NOT NULL,
  school varchar(225) NOT NULL,
  address text NOT NULL,
  contact_no varchar(225) NOT NULL,
  grade_level varchar(225) NOT NULL,
  birthday date NOT NULL,
  age smallint(6) NOT NULL,
  email_address varchar(225) NOT NULL,
  allergies varchar(225) NOT NULL,
  program varchar(225) NOT NULL,
  mothers_name varchar(225) NOT NULL,
  mother_occupation varchar(225) NOT NULL,
  mother_office_address text NOT NULL,
  mother_tel_no varchar(225) NOT NULL,
  fathers_name varchar(225) NOT NULL,
  father_occupation varchar(225) NOT NULL,
  father_office_address text NOT NULL,
  father_tel_no varchar(225) NOT NULL,
  no_of_siblings int(11) NOT NULL,
  sibling_names text NOT NULL,
  sibling_age text NOT NULL,
  sibling_grade_level text NOT NULL,
  sibling_school text NOT NULL,
  other_programs_attended text NOT NULL,
  suggestions text NOT NULL,
  others text NOT NULL,
  status int(11) NOT NULL DEFAULT '0'
);
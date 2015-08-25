<?php

    class Course
    {
        private $id;
        private $name;
        private $number;

        function __construct($id = null, $name, $number)
        {
            $this->id = $id;
            $this->name = $name;
            $this->number = $number;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function getNumber()
        {
            return $this->number;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function setNumber($new_number)
        {
            $this->number = $new_number;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO courses (name, number) VALUES ('{$this->getName()}', '{$this->getNumber()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }


        //No test for this yet
        function getStudents()
        {
            $query = $GLOBALS['DB']->query("SELECT student_id FROM students_courses WHERE course_id = {$this->getId()};");
            $student_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $students = array();
            foreach ($student_ids as $id) {
                $student_id = $id['student_id'];
                $result = $GLOBALS['DB']->query("SELECT * FROM students WHERE id = {$student_id};");
                $returned_student = $result->fetchAll(PDO::FETCH_ASSOC);

                $id = $returned_student[0]['id'];
                $name = $returned_student[0]['name'];
                $enrollment_date = $returned_student[0]['enrollment_date'];
                $new_student = new Student($id, $name, $enrollment_date);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses");
            $courses = array();
            foreach ($returned_courses as $course) {
                $id = $course['id'];
                $name = $course['name'];
                $number = $course['number'];
                $new_course = new Course($id, $name, $number);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses;");
        }
    }

    //Still need: update, delete, addStudent, getStudents

?>

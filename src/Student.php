<?php

    class Student
    {
        private $id;
        private $name;
        private $enrollment_date;

        function __construct($id = null, $name, $enrollment_date)
        {
            $this->id = $id;
            $this->name = $name;
            $this->enrollment_date = $enrollment_date;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function getEnrollmentDate()
        {
            return $this->enrollment_date;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function setEnrollmentDate($new_enrollment_date)
        {
            $this->enrollment_date = $new_enrollment_date;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO students (name, enrollment_date) VALUES ('{$this->getName()}', '{$this->getEnrollmentDate()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students ORDER BY name");
            $students = array();
            foreach ($returned_students as $student) {
                $id = $student['id'];
                $name = $student['name'];
                $enrollment_date = $student['enrollment_date'];
                $new_student = new Student($id, $name, $enrollment_date);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }

        static function find($search_id)
        {
            $found_student = null;
            $students = Student::getAll();
            foreach ($students as $student) {
                $student_id = $student->getId();
                if ($student_id == $search_id) {
                    $found_student = $student;
                }
            }
            return $found_student;
        }


        //Still need: update, delete, addCourse, getCourses
    }

?>

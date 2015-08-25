<?php

    class Student
    {
        private $id;
        private $name;
        private $enrollment_date;

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
    }

?>

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
    }



?>

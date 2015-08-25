<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once "src/Course.php";
    require_once "src/Student.php";

    $server = 'mysql:host=localhost;dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
            Student::deleteAll();
        }
        function testGetName()
        {
            //Arrange
            $id = null;
            $name = "Intro to Math";
            $number = "Math100";
            $test_course = new Course($id, $name, $number);

            //Act
            $result = $test_course->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $id = null;
            $name = "Intro to Math";
            $number = "MATH100";
            $test_course = new Course($id, $name, $number);

            //Act
            $test_course->setName("Intro to Soc");
            $result = $test_course->getName();

            //Assert
            $this->assertEquals("Intro to Soc", $result);
        }

        function testSetNumber()
        {
            //Arrange
            $id = null;
            $name = "Intro to Math";
            $number = "Math100";
            $test_course = new Course($id, $name, $number);

            //Act
            $test_course->setNumber("Math101");
            $result = $test_course->getNumber();

            //Assert
            $this->assertEquals("Math101", $result);
        }

        function testGetId()
        {
            //Arrange
            $id = 1;
            $name = "Intro to Math";
            $number = "MATH100";
            $test_course = new Course($id, $name, $number);

            //Act
            $result = $test_course->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function testSave()
        {
            //Arrange
            $id = null;
            $name = "Intro to math";
            $number = "MATH100";
            $test_course = new Course($id, $name, $number);

            //Act
            $test_course->save();

            //Assert
            $result = Course::getAll();
            $this->assertEquals([$test_course], $result);
        }

        function testGetAll()
        {
            //Arrange
            $id = null;
            $name = "Intro to Math";
            $number = "MATH100";
            $test_course = new Course($id, $name, $number);
            $test_course->save();

            $name2 = "Intro to History";
            $number2 = "HIST100";
            $test_course2 = new Course($id, $name2, $number2);
            $test_course2->save();

            //Act
            $result = Course::getAll();

            //Assert
            $this->assertEquals([$test_course, $test_course2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $id = null;
            $name = "Intro to Math";
            $number = "MATH100";
            $test_course = new Course($id, $name, $number);
            $test_course->save();

            $name2 = "Intro to History";
            $number2 = "HIST101";
            $test_course2 = new Course($id, $name2, $number2);
            $test_course2->save();

            //Act
            Course::deleteAll();

            //Assert
            $result = Course::getAll();
            $this->assertEquals([], $result);

        }



    }

?>

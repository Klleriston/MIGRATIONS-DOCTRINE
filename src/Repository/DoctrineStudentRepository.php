<?php

namespace Alura\Doctrine\Repository;

use Alura\Doctrine\Entity\Student;
use Doctrine\ORM\EntityRepository;


class DoctrineStudentRepository extends EntityRepository
{
    /*
     * @return Student[]
     */
    public function studentAndCourses(): array
    {
        $studentClass = Student::class;

        $dql = "
        SELECT student, phone, course
            FROM $studentClass student 
        LEFT JOIN student.phones phone
        LEFT JOIN student.courses course
        ";

        return $this->getEntityManager()->createQuery($dql)->getResult();
    }
}
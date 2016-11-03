<?php
namespace model;

class Contact extends Model
{
    /*
    * Select student detail by student_id
    */
    public function getStudentById($id)
    {
        $sql = "SELECT * FROM contact WHERE student_id='" . $id."'";
        $stmt = $this->query($sql);
        return $this->returnData($stmt);
    }

    /**
     * Select all information of student
     */
    public function getAllStudent()
    {
        $sql = "SELECT * FROM contact";
        $stmt = $this->query($sql);
        return $this->returnData($stmt);
    }
}

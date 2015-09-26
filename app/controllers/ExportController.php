<?php

class ExportController extends BaseController {

    public function __construct()
    {

    }

    public function welcome()
    {
        return View::make('hello');
    }

    /**
     * View all students found in the database
     */
    public function viewStudents()
    {
        $students =  Students::with('course')->get();

        return View::make('view_students', compact( ['students'] ) );
    }

    /**
     * Exports all student data to a CSV file
     */
    public function exportStudentsToCSV()
    {
        $table = Students::with('address')->get();
        var_dump($table);
        die;
        $file = fopen('student_details.csv', 'w');
        foreach ($table as $row) {
            fputcsv($file, $row->toArray());
        }
        fclose($file);

    }

    /**
     * Exports the total amount of students that are taking each course to a CSV file
     */
    public function exporttCourseAttendenceToCSV()
    {

    }


}

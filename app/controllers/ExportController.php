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
        $all_student_data = Students::with('address', 'course')->get();
        $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());
        $column_flag = false;
        $student = [];

        foreach ($all_student_data as $student_data):
            //Personal data
            $student['firstname'] = $student_data['firstname'];
            $student['surname'] = $student_data['surname'];
            $student['email'] = $student_data['email'];
            $student['nationality'] = $student_data['nationality'];
            //Address data
            $student['houseNo'] = $student_data->address['houseNo'];
            $student['line_1'] = $student_data->address['line_1'];
            $student['line_2'] = $student_data->address['line_2'];
            $student['postcode'] = $student_data->address['postcode'];
            $student['city'] = $student_data->address['city'];
            //Course data
            $student['course_name'] = $student_data->course['course_name'];
            $student['university'] = $student_data->course['university'];

            //Check whether column headers have been set
            if ($column_flag === false):
                $csv->insertOne(\Schema::getColumnListing('student'));
                $column_flag = true;
            endif;

            $csv->insertOne($student);
        endforeach;

        $csv->output('all_student_records.csv');
    }

    /**
     * Exports the total amount of students that are taking each course to a CSV file
     */
    public function exporttCourseAttendenceToCSV()
    {

    }


}

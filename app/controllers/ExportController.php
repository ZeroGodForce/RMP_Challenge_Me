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

            //Check whether column headers have been set (not ideal for large datasets)
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
        $course_data =  Course::with('students')->get();
        $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());
        $column_flag = false;
        $course_listing = [];

        foreach ($course_data as $course):
            $course_listing['course_name'] = $course->course_name;
            $course_listing['num_students'] = count($course->students);

                //Check whether column headers have been set (not ideal for large datasets)
                if ($column_flag === false):
                    $csv->insertOne(\Schema::getColumnListing('course_listing'));
                    $column_flag = true;
                endif;
            $csv->insertOne($course_listing);
            endforeach;

        $csv->output('course_attendance_records.csv');
    }

    //Export selected students to a CSV file
    public function exportSelected()
    {
        $selected_students = Input::get('studentId');
        if(is_array($selected_students)) {
            //Setup CSV
            $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());
            $column_flag = false;
            $student = [];

            foreach ($selected_students as $student_id):
                $student_data = Students::with('course')->find($student_id);
                //Personal data
                $student['firstname'] = $student_data['firstname'];
                $student['surname'] = $student_data['surname'];
                $student['email'] = $student_data['email'];
                //Course data
                $student['university'] = $student_data->course['university'];
                $student['course_name'] = $student_data->course['course_name'];

                //Check whether column headers have been set (not ideal for large datasets)
                if ($column_flag === false) {
                    $csv->insertOne(\Schema::getColumnListing('student'));
                    $column_flag = true;
                }
                //Add student record to file
                $csv->insertOne($student);
            endforeach;
        }
        else {
            return "NO STUDENTS SELECTED";
        } //is_array($selected_students)

        $csv->output("selected_student_records.csv");
    }

}

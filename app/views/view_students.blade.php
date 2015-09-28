<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome to RMP</title>
        <style>
            @import url(//fonts.googleapis.com/css?family=Lato:700);

            body {
                margin:0;
                font-family:'Lato', sans-serif;
                text-align:center;
                color: #999;
            }

            .header {
                width: 100%;
                left: 0px;
                top: 5%;
                text-align: left;
                border-bottom: 1px  #999 solid;
            }

            .student-table{
                width:100%;
            }

            table.student-table th{
                background-color: #C6C6C6;
                text-align: left;
                color: white;
                padding:7px 3px;
                font-weight: 700;
                font-size: 18px;
            }

            table.student-table tr.odd {
                text-align: left;
                padding:5px;
                background-color: #F9F9F9;
            }

            table.student-table td{
                text-align: left;
                padding:5px;
            }

            a, a:visited {
                text-decoration:none;
                color: #999;
            }

            h1 {
                font-size: 32px;
                margin: 16px 0 0 0;
            }
        </style>
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
    </head>
    <body>
    {{ Form::open(array('url' => '/exportSelected')) }}
        <div class="header">
            <div>{{ HTML::image('/images/RMP_logo_sm.jpg') }}</div>
            <div  style='margin: 10px; text-align: left'>
                <input id="selectAll" type="button" value="Select All"/>
                <input id="selectNone" type="button" value="Select None" style="display: none;"/>
                <input type="submit" value="Export Selection"/>
                | <a href="/export" class="button">Export all student data</a> |
                <a href="/attendance" class="button">Export course attendance data</a> |
            </div>
        </div>

        <div style='margin: 10px; text-align: center;'>
            <table class="student-table">
                <thead>
                <tr>
                    <th></th>
                    <th>Forename</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>University</th>
                    <th>Course</th>
                </tr>
                </thead>

                <tbody>
                @if(  count($students) > 0 )
                @foreach($students as $student)
                <tr>
                    <td>{{Form::checkbox('studentId[]', $student['id'], false, ['class' => 'selectStudent']) }}</td>
                    <td style=' text-align: left;'>{{$student['firstname']}}</td>
                    <td style=' text-align: left;'>{{$student['surname']}}</td>
                    <td style=' text-align: left;'>{{$student['email']}}</td>
                    <td style=' text-align: left;'>{{$student['course']['university']}}</td>
                    <td style=' text-align: left;'>{{$student['course']['course_name']}}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6" style="text-align: center">Oh dear, no data found.</td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
        {{ Form::close() }}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- DataTables -->
    {{--<script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>--}}
        <script>
            // would normally put this in an external file
            $(document).ready(function() {
//                Decided to leave DataTables out in the end as no time to complete styling
//                $('.student-table').DataTable({
//                    scrollY:        '50vh',
//                    scrollCollapse: true,
//                    paging:         false
//                });
                $('#selectAll').click(
                    function() {
                        $(".student-table .selectStudent").prop('checked', true);
                        $('#selectAll').hide();
                        $('#selectNone').show();
                    }
                );
                $('#selectNone').click(
                    function() {
                        $(".student-table .selectStudent").prop('checked', false);
                        $('#selectAll').show();
                        $('#selectNone').hide();
                    }
                );
            });
        </script>

    </body>

</html>

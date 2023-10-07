<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    {{-- <link href='{{ asset('css/app.css') }}' rel='stylesheet'> --}}

    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            border-collapse: collapse;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            width: 50%;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
        
        #appform td, #appform th {
            border: 1px solid #ffffff;
            padding: 8px;
            width: 50%;
        }

    </style>

</head>
  <body style="align-items: center;">

    <table id="customers">
        
        <tr >
            <td style="text-align: center;">
                <img src="images/ysda-retina.jpg" width="200" height="56" style="padding-top: 8px;">
                <br>
                <span style="padding: 20px;">

                    <p style="font-weight: 800;font-size: 16pt;">
                        Reliant Pay
                    </p>

                    <p>
                      
                    </p>

                </span>
            </td>
        </tr>
        
        <tr>
            
            {{-- <td style="color:crimson;text-align:left;font-size: 14pt ;"> --}}
                <td style="text-align:left;font-size: 14pt ;">
                {{-- {{ $student_title }} {{ $student_name }} --}}
                <table id="appform">
                    <tr>
               <td> Name : </td><td> {{ $student_title }} {{ $student_name }}</td>
            </tr>
            <tr>
                <td>Course : </td><td> {{ $course }}</td>
            </tr>
            <tr>
                <td>Center : </td><td> {{ $center }}</td>
            </tr>
            <tr>
                <td>Email : </td><td> {{ $student_email }}</td>
            </tr>
            <tr>
                <td>Phone : </td><td> {{ $student_phone }}</td>
            </tr>
            <tr>
                <td>Guardian Name : </td><td> {{ $guardian_title }} {{ $guardian_name }}</td>
            </tr>
            <tr>
                <td>Guardian Occupation : </td><td> {{ $guardian_occupation }}</td>
            </tr>
            <tr>
                <td>Guardian Email : </td><td> {{ $guardian_email }}</td>
            </tr>
            <tr>
                <td>Guardian Phone : </td><td> {{ $guardian_phone }}</td>
            </tr>
            <tr>
                <td>Student Qualification : </td><td> {{ $student_qualification }}</td>
            </tr>
            <tr>
                <td>Present address : </td><td> {{ $present_street_address }} {{$present_state}} {{$present_city}} {{$present_pin}}</td>
            </tr>
            <tr>
                <td>Permanent address : </td><td> {{ $permanent_street_address }} {{$permanent_state}} {{$permanent_city}} {{$permanent_pin}}</td>
            </tr>
            <tr>
                <td>Purpose : </td><td> {{ $purpose }}</td>
            </tr>
            <tr>
                <td>Prior knowledge : </td><td> {{ $prior_knowledge }}</td>
            </tr>
            <tr>
                <td>Info about ysda : </td><td> {{ $info_about_ysda }}</td>
            </tr>
            </table>
                <p style="color:gray;text-align:center;font-size: 9pt" ;>

                    For deftly defying the laws of gravity<br />
                    {{-- and flying high in {{ $course }}<br> --}}

                    Thanks,<br>
                    {{ env('app.name') }} <br>
                    T: 1800-258-5474

                </p>
            </td>

            
        </tr>

    </table>

        
    </body>
</html>






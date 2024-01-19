<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>STATE TECHNICAL SCHOLARSHIP 2023</title>
    <!-- <link rel="stylesheet" href="dashboardAssets/vendor/bootstrap/css/bootstrap.css" /> -->
    @include('pdf.partials.css')
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <img src="{{ $logo }}" alt="" width="210">
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($app->transaction_id, 'C39') }}" alt="barcode"
                    style="float:right;" />
                <hr>
                <div>
                    <p>Dear {{ $app->user->profile->full_name }}, </p>
                    <p>You have applied for the <b>State Technical Scholarship {{ $app->year }} under
                            {{ $app->category }} category</b> with Application No.: <b>{{ $app->transaction_id }}</b>.
                        The Department of Technical Education, Government of Nagaland, will review your application after
                        the announced deadline.</p>
                    <p>In the event of acceptance of your application, we will notify you accordingly.</p>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td colspan="4"><b class="text-primary">General Information</b></td>
                        </tr>

                        <tr>
                            <td><b>Name: </b>{{ $app->user->profile->full_name }} </td>
                            <td><b>Fathers Name:</b> {{ $app->user->profile->fathers_name }} </td>
                            <td><b>Mothers Name:</b> {{ $app->user->profile->mothers_name }}</td>
                            <td><b>Guardians Name:</b> {{ $app->user->profile->guardians_name }}</td>
                        </tr>
                        <tr>
                            <td><b>Fathers Occupation: </b>{{ $app->user->profile->fathers_occupation }} </td>
                            <td><b>Mothers Occupation:</b> {{ $app->user->profile->mothers_occupation }}</td>
                            <td><b>Guardians Relationship:</b> {{ $app->user->profile->guardians_relationship }}</td>
                            <td><b>Registered Mobile:</b> {{ $app->user->profile->mobile_no }}</td>
                        </tr>
                        <tr>
                            <td><b>Registered Email:</b> {{ $app->user->profile->email }}</td>
                            <td><b>Date of Birth:</b> {{ $app->user->profile->dob }}</td>
                            <td><b>Aadhaar No:</b> {{ $app->user->profile->aadhaar_no }}</td>
                            <td><b>Gender:</b> {{ $app->user->profile->gender }}</td>
                        </tr>
                        <tr>
                            <td><b>Is Indigenous Inhabitant:</b> {{ $app->user->profile->is_iic }}</b></td>
                            <td><b>Is ST:</b> {{ $app->user->profile->is_st }}</b></td>
                            <td><b>Tribe:</b> {{ $app->user->profile->tribe }}</b></td>
                            <td><b>Is PwD:</b> {{ $app->user->profile->is_pwd }}</b></td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Parents Total Income:</b> {{ $data->parents_total_income }}</td>
                        </tr>

                        <tr>
                            <td colspan="4"><b class="text-primary">Banking Details</b></td>
                        </tr>
                        <tr>
                            <td><b>Account Holders Name :</b> {{ $app->user->profile->account_holders_name }}</td>
                            <td><b>Bank :</b> {{ $app->user->profile->bank }}</td>
                            <td><b>Branch :</b> {{ $app->user->profile->branch }}</td>
                            <td><b>Account No :</b> {{ $app->user->profile->account_no }}</td>
                        </tr>
                        <tr>
                            <td><b>Is Account Aadhaar Seeded :</b> {{ $app->user->profile->aadhaar_seeded }}</td>
                            <td colspan="3"><b>IFSC Code :</b> {{ $app->user->profile->ifsc_code }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"><b class="text-primary">Institution & Course Details</b></td>
                        </tr>
                        <tr>
                            <td><b>Institution Name :</b> {{ $app->institution->name }}</td>
                            <td><b>Institution Address :</b> {{ $app->institution->address }},
                                {{ $app->institution->state->name }}</td>
                            <td><b>Institution Contact & Email :</b> {{ $app->institution->contact_no }},
                                {{ $app->institution->email }} </td>
                            <td><b>UDISE/AISHE Code :</b> {{ $app->institution->udise_aishe_code }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Course:</b> {{ $app->course->name }}</td>
                            <td><b>Course Code:</b> {{ $app->course->course_code }}</td>
                            <td><b>Stream:</b> {{ $app->course->stream }}</td>
                        </tr>
                        <tr>
                            <td><b>Present Course:</b> {{ $data->present_course }}</td>
                            <td><b>Present Year:</b> {{ $data->present_course_year }}</td>
                            <td><b>Last Exam Passed:</b> {{ $data->last_exam_passed }}</td>
                            <td><b>Percentage Obtained:</b> {{ $data->exam_percentage }}%</td>
                        </tr>
                        <tr>
                            <td><b>Year of Passing(last exam):</b> {{ $data->year_of_passing }}</td>
                            <td><b>Board:</b> {{ $data->board }}</td>
                            <td><b>Admission Fees:</b> Rs. {{ $data->admission_fee }}</td>
                            <td><b>Academic Fees:</b> Rs. {{ $data->academic_fee }}</td>
                        </tr>
                        <tr>
                            <td><b>Miscellaneous Fees:</b> Rs. {{ $data->misc_fee }}</td>
                            <td><b>Admission Date:</b> {{ Carbon\Carbon::parse($data->admission_date)->format('d-m-Y') }}</td>
                            <td><b>Session Commencement Date:</b> {{ Carbon\Carbon::parse($data->session_commence_date)->format('d-m-Y') }} </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <img src="{{ $photo }}" width="90" height="110">
                            </td>
                            <td colspan="1">
                                <img src="data:image/png;base64, {!! base64_encode(
                                    QrCode::format('svg')->size(110)->generate(
                                            'STATE TECHNICAL SCHOLARSHIP 2023 - @https://scholarship.nagaland.gov.in - Applicant Name: ' .
                                                $app->user->profile->full_name .
                                                ' Transaction ID: ' .
                                                $app->transaction_id,
                                        ),
                                ) !!} ">
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>

</html>

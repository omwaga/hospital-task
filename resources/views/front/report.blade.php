<title>Patient Report</title>

<h1 class="text-center">MEDICAL REPORT</h1>

<div class="container">
    <table cellspacing="40">
        <tr>
            <td>
                <table class="table-border" cellpadding="5">
                    <tr>
                        <td>
                            <strong>
                                Name
                            </strong>
                        </td>
                        <td>
                            {{ $patient->name }}
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table-border" cellpadding="5">
                    <tr>
                        <td>
                            <strong>
                                Ticket No:
                            </strong>
                        </td>
                        <td>
                            {{$patient->ticket->ticket_number}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Date:
                            </strong>
                        </td>
                        <td>
                            {{ date('F j Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                Patient ID:
                            </strong>
                        </td>
                        <td>
                            ...
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

<div class="container">
    <table class="table-border" cellpadding="5">

        <tr>
            <th>Lab Test</th>
            <th>Result</th>
            <th>Diagnosis</th>
        </tr>

        @foreach($patient->medicalReports as $medicalReports)
        <tr>
            <td>
                {{$medicalReports->labTest->name}}
            </td>

            <td>
                {{$medicalReports->result}}
            </td>

            <td>
                {{$medicalReports->diagnosis}}
            </td>
        </tr>
        @endforeach

    </table>
</div>

<h3>Prescriptions</h3>
<ul>
    @foreach($patient->medicalReports as $medicalReport)
        <li>{{$medicalReport->prescription}}</li>
    @endforeach
</ul>

<style type="text/css">

    .text-center {
        text-align: center;
    }
    .container {
        margin-bottom: 40px;
    }
    table {
        width: 100%
    }
    th, td {
        font-size: 14px;
    }
    td {
        vertical-align: top;
    }
    .table-border, .table-border th, .table-border td {
        border: 1px solid #aaa;
        border-collapse: collapse;
    }
</style>

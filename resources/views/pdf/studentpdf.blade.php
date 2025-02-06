<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: 'SolaimanLipi', sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .student-info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>বেফাকুল মাদারিসিল আরাবিয়া বাংলাদেশ</h1>
        <h3>বাংলাদেশ কওমী মাদরাসা শিক্ষাবোর্ড</h3>
    </div>

    <div class="student-info">
        <p><strong>নাম:</strong> {{ $details->Name }}</p>
        <p><strong>পিতার নাম:</strong> {{ $details->Father }}</p>
        <p><strong>রোল:</strong> {{ $details->Roll }}</p>
        <p><strong>রেজিস্ট্রেশন নং:</strong> {{ $details->reg_id }}</p>
        <p><strong>মাদরাসা:</strong> {{ $details->Madrasha }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>বিষয়</th>
                <th>পূর্ণমান</th>
                <th>প্রাপ্ত নম্বর</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 1; $i <= 8; $i++)
                @if($details["SubLabel_$i"])
                <tr>
                    <td>{{ $details["SubLabel_$i"] }}</td>
                    <td>100</td>
                    <td>{{ $details["SubValue_$i"] }}</td>
                </tr>
                @endif
            @endfor
        </tbody>
    </table>

<<<<<<< HEAD

            .custom-font{

                font:normal 12px /20px SolaimanLipi;
            }
          </style>
    </head>
    <body>
        <div class=  "custom-font">
            {{ $student->Name }}
        </div>
        <div class="custom-font">
            {{ $student->Roll }}
        </div>
        <div class="custom-font">
            {{ $student
            ->reg_id }}
        </div>
    </body>
=======
    <div class="result-summary">
        <p><strong>মোট প্রাপ্ত নম্বর:</strong> {{ $details->Total }}</p>
        <p><strong>বিভাগ:</strong> {{ $details->Division }}</p>
        <p><strong>মেধা স্থান:</strong> {{ $details->Positions }}</p>
    </div>
</body>
>>>>>>> 8fc959335e6e404e3cf8c06b693bafa0447afef0
</html>

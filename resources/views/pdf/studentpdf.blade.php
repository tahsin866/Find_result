<!DOCTYPE html>
<html dir="rtl" lang="ar">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="UTF-8">
        <title>Student Certificate</title>
        <style type="text/css">
            @font-face{

                font-family: "SolaimanLipi";
                src: url("SolaimanLipi.ttf")
            }



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
            {{ $student->reg_id }}
        </div>
    </body>
</html>

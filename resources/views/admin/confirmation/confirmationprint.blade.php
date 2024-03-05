<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Baptism Certificate - {{ $confirmation_detail->name }}</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        h2 {
            color: black;
            font-family: "Malgun Gothic", sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 14pt;
        }

        .s1 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 11pt;
        }

        h1 {
            color: black;
            font-family: "Sitka Text";
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 16pt;
        }

        h3 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: italic;
            font-weight: bold;
            text-decoration: none;
            font-size: 11pt;
        }

        p {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 11pt;
            margin: 0pt;
        }

        .s3 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: underline;
            font-size: 11pt;
        }

        .s4 {
            color: #C00000;
            font-family: "Times New Roman", serif;
            font-style: italic;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }
    </style>
</head>

<body style="display: block;max-width: 816px;height: 950px;margin: 0px auto;">
    <div style="border: 6px solid black;padding: 3px;">
        <div style="border: 3px solid black; padding: 15px 50px 50px; height: 878px;">
            <img src="/img/saint_gregory_letter_head.png" style="max-width: 400px; width:100%; display: block; margin: 0px auto; padding-right: 20px;" alt="">
            <br>
            <h1 style="text-indent: 0pt;text-align: center;">Certificate of Confirmation</h1>
            <br>
            <h3 style="text-indent: 0pt;text-align: center;">This certifies</h3>
            <br>
            <p style="text-indent: 0pt;text-align: left;margin-bottom: 15px;">that <span style="display: inline-block;width: 95%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{!! $confirmation_detail->name !!}</span></p>
            <p style="text-indent: 0pt;text-align: left;margin-bottom: 15px;">child of &nbsp; <span style="display: inline-block;width: 90%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{!! $confirmation_detail->father !!}</span></p>
            <p style="text-indent: 0pt;text-align: left;margin-bottom: 15px;">and <span style="display: inline-block;width: 95%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{!! $confirmation_detail->mother !!}</span></p>
            <p style="text-indent: 0pt;text-align: left;margin-bottom: 15px;">Baptized on the 
                <span style="display: inline-block;width: 25%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{{ \Carbon\Carbon::parse($confirmation_detail->birth_date)->format('jS') }}</span>
                day of <span style="display: inline-block;width: 25%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{{ \Carbon\Carbon::parse($confirmation_detail->birth_date)->format('F') }}</span>
                , <span style="display: inline-block;width: 25%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{{ \Carbon\Carbon::parse($confirmation_detail->birth_date)->format('Y') }}</span>
            </p>
            <p style="text-indent: 0pt;text-align: left;margin-bottom: 15px;">in the church of <u><strong>St. Gregory the Greate Parish</strong></u></p>
            
            <p style="text-indent: 0pt;text-align: center;margin-bottom: 30px;">Recieved</p>

            <h3 style="text-indent: 0pt;text-align: center; margin-bottom: 15px;">The Holy Sacrament of Confirmation</h3>
            <p style="text-indent: 0pt;text-align: left;margin-bottom: 15px;">on the 
                <span style="display: inline-block;width: 30%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{{ \Carbon\Carbon::parse($confirmation_detail->confirmation->date)->format('jS') }}</span>
                day of <span style="display: inline-block;width: 27%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{{ \Carbon\Carbon::parse($confirmation_detail->confirmation->date)->format('F') }}</span>
                , <span style="display: inline-block;width: 27%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{{ \Carbon\Carbon::parse($confirmation_detail->confirmation->date)->format('Y') }}</span></p>
            {{-- <h3 style="text-indent: 0pt;text-align: center; margin-bottom: 15px;">according to the Rites of the <br> Roman Catholic Church</h3> --}}
            <p style="text-align: left;margin-bottom: 15px; ">by the Most Rev. <u><strong>FR. MARTY A. DIMARANAN</strong></u></p>
            <p style="text-indent: 0pt;text-align: left;margin-bottom: 15px;">the Sponsors being <span style="display: inline-block;width: 80%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{{ $confirmation_detail->sponsor_1 }}</span></p>
            <p style="text-indent: 0pt;text-align: left;margin-bottom: 15px;">and <span style="display: inline-block;width: 95%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{{ $confirmation_detail->sponsor_2 }}</span></p>
            <p class="s4" style="padding-top: 8pt;padding-left: 5pt;text-indent: 0pt;text-align: left;margin-bottom: 15px;">Not valid <br> without <br> Parish Seal</p>
            <p style="text-indent: 0pt;text-align: left;margin-bottom: 15px;">Date of issuance <span style="display: inline-block;width: 82%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">{{ \Carbon\Carbon::now()->format('F j, Y') }}</span></p>
            <p style="text-indent: 0pt;text-align: left;margin-bottom: 15px;">Purpose <span id="purpose" style="display: inline-block;width: 90%;border-bottom: 1px solid black; text-align: center; font-size: 18px; font-weight: bold;">N/A</span></p>
            
            
            <br>
            <p class="s3" style="padding-top: 4pt;text-indent: 0pt;text-align: left;">REV. FR. MARTY A.
                DIMARANAN</p>
            <p style="padding-top: 9pt;text-indent: 0pt;text-align: left;">Parish Priest</p>
        </div>
    </div>
    
    
</body>

<script>
    //show alert box asking what is the purpose of the certificate
    let purpose = prompt('What is the purpose of the certificate?');
    document.getElementById('purpose').innerHTML = purpose ?? 'N/A';
    window.print();
</script>
</html>

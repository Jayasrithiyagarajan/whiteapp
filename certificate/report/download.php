<?php
require_once('../../vendor/autoload.php');

use Mpdf\Mpdf;

// Load Bootstrap CSS
$bootstrapCSS = file_get_contents('../../assets/css/bootstrap.css');

// Your HTML content
$html = <<<HTML
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CIMS Report</title>

    <!-- Embedding Bootstrap CSS for mPDF compatibility -->
    <style>
        $bootstrapCSS

        /* Custom Styles */
        td {
            border: 2px solid #eee;
            padding-left: 10px;
        }

        /* Additional custom styles to ensure proper alignment */
        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-6 {
            padding: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Additional adjustments for radio button alignment */
        input[type="radio"] {
            margin-left: 5px;
            margin-right: 3px;
        }

        /* Ensure text is not cut off in cells */
        td {
            word-wrap: break-word;
        }

        /* Optional: Force print color adjustments */
        * {
            -webkit-print-color-adjust: exact;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-4" style="page-break-before:always">
        <div class="report">
            <form method="POST" action="./view_report_fetch.php?viewid=">
                <div class="panel_s mtop20">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-1">
                                <img src="../logo.png" alt="CIMS" width="90" height="120">
                            </div>
                            <div class="col-md-6">
                                <h3>Crane Inspection & Maintenance Service</h3>
                                <p>
                                    P.O.BOX 74007, AL- Khobar31952, Kingdom of Saudi Arabia<br>
                                    <b>TEL:</b> (013) 814 6861, (013) 814 6861, (013) 847 8822<br>
                                    <b>Email:</b> coordinator@cims.com.sa, info@cims.com.sa
                                </p>
                            </div>
                            <div class="col-md-3">
                                <h3 class="bold estimate-html-number">Report No : <span class="alert-success"></span></h3>
                                <h3>JRN :- <span class="bold"></span></h3>
                                <h3>RPO:- <span class="bold"></span></h3>
                            </div>
                            <div class="col-md-2">
                                <img src="../code.png" alt="CIMS" width="120" height="120">
                            </div>
                        </div>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Lifting Equipment Inspection Report</td>
                                    <td>Area : <b></b></td>
                                    <td>Org.Code : <b></b></td>
                                    <td>Inspection Date: <b></b></td>
                                    <td>Inspection Time: <b></b></td>
                                    <td>Previous Sticker No.: <b></b></td>
                                    <td>Issued By : <b></b></td>
                                </tr>
                                <tr>
                                    <td>Department/Contractor: <b></b></td>
                                    <td>Equipment Number : <b></b></td>
                                    <td>Equipment Location : <b></b></td>
                                    <td colspan="2">Inspection Result 
                                        <input type="radio" id="pass" name="ins_result" value="" checked>
                                        <label for="pass">PASS</label>
                                        <input type="radio" id="fail" name="ins_result" value="">
                                        <label for="fail">FAIL</label>
                                    </td>
                                    <td colspan="2">New Sticker Number : <b></b></td>
                                </tr>
                                <tr>
                                    <td>Manufacture: <b></b></td>
                                    <td>Model: <b></b></td>
                                    <td>Capacity: <b></b></td>
                                    <td>Type : <b></b></td>
                                    <td>Equipment Serial No. <b></b></td>
                                    <td colspan="2">Sticker Expiration Date: <b></b></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        Above Equipment was inspected by CIMS in accordance with applicable Saudi Aramco GI's, ASME, and API standards. Deficiencies that require corrective actions are listed below. Specific repairs to correct each deficiency should be noted in the action taken column.
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table items items-preview estimate-items-preview">
                                        <thead>
                                            <tr>
                                                <th align="center">#</th>
                                                <th class="description" align="left">DEFICIENCIES</th>
                                                <th>CORRECTIVE ACTION TAKEN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td align="center">1</td>
                                                <td class="description">
                                                    <textarea class="notes" name="corrective" cols="65" rows="10"></textarea>
                                                </td>
                                                <td>
                                                    <textarea class="notes" name="action" cols="32" rows="10"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12 estimate-html-note">
                                <p>When re-inspected, a complete copy of this report should be ready for review by the inspector.</p>
                                <div class="col-md-12" style="border:2px solid #d0cece;padding:10px;">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="terms" id="terms" onchange="activateButton(this)" checked style="zoom:2;">
                                            <label class="form-check-label" for="gridCheck">
                                                <h3>I agree to take full responsibility for this inspection
                                                    <span style="margin-left:30px;float:right;">اواوافق الى تحمل المسؤليه الكامله عن هذا الفحص</span>
                                                </h3>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        Receiver Name : <b></b><br>
                                        Badge : <b></b>
                                    </div>
                                    <div class="col-md-4">
                                        Inspection Date : <b></b><br>
                                        Signature : <b></b>
                                    </div>
                                    <div class="col-md-4">
                                        Issued By : <b></b><br>
                                        Signature : <b></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <center>
                            <p>This is a digital printout and does not require a signature.</p>
                        </center>
                        <br>
                        <div id="non-printable">
                            <button type="submit" class="btn btn-primary">Save as PDF</button>
                            <button type="button" class="btn btn-danger" onclick="window.print()">Print</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

HTML;

$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']); // 'L' for landscape
$mpdf->WriteHTML($html);
$mpdf->Output('report.pdf', 'D'); // 'D' to force download, use 'I' to inline view
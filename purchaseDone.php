<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div id="element">
        <div class="logo">
            <img src="./Webthought.png" width="100px" style="border-radius: 100%;" alt="">
            <b>TravelThought</b>
        </div>
        <div style="font-size: 1.2rem;margin-left: 300px;"><b>Tickets</b></div>
        <br><br>
        <div style="position: relative;">
    <div style="margin-left: 100px;">
        <p>Code Client: 1</p>
        <p>Nᵒ de Ticket: 1</p>
        <p>Date: 15/02/2022</p>
        <p>Mode de reglement: cheque</p>
        <p>Rubrique: additif et rectificatif</p>
    </div>
    <div style="margin-left: 500px;position: absolute;top: 10px;"">
        <p>Ismontic</p>
        <p>Karim</p>
        <p>Marjan Rue 10 Lots 5</p>
        <p>90100 Tanger</p>
    </div>
</div>
        <!-- <div class="html2pdf__page-break"></div> -->
        <br><br>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
            <br><br>
            <div>
                <table class="table table-striped" style="width: 40%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>
            </div>
            <div style="background-color: #eee;width: 40%;padding: 5px; margin-left: 500px;position: absolute;top: 650px;">
                <p>Total net HT: 84.63$</p>
                <p>Total TVA: 9.16$</p>
                <p>Total TTC: 93.79$</p>
            </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>
    <script>
        var element = document.querySelector('#element');


        html2pdf(element, {
            margin: 10,
            filename: 'AhsanPdf.pdf',
            image: {type: 'jpeg', quality: 0.98 },
            html2pdf: { scale: 2, logging: true, dpi: 192, letterRendering: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        });
    </script>
</body>
</html>
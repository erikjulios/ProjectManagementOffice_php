<!doctype html>

<html>

    <head>

        <title>Cara Membuat Multiple Select Di Satu Tag Select</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    </head>

    <body style="background: lightblue">

        <div style="width: 500px; padding: 15px; margin:200px auto;">

            <div class="form-group">

               <h1>Cara Membuat Multiple Select Di Satu Tag Select</h1>

                <label>Paket Kursus Dumet School</label>

                <select id="paket" name="paket[]" class="form-control" multiple="multiple">

                    <option value=""></option>

                    <option value="Web Master">Web Master</option>

                    <option value="Web Programming">Web Programming</option>

                    <option value="Web Design">Web Design</option>

                    <option value="Digital Marketing">Digital Marketing</option>

                    <option value="Coding For Kids">Coding For Kids</option>

                    <option value="Grafic Desain">Grafic Desain</option>

                    <option value="Motion Grafic">Motion Grafic</option>

                </select>

            </div>

        </div>

</body>

</html>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <script>

            $(document).ready(function () {

                $("#paket").select2({

                    placeholder: "Silahkan Pilih"

                });

            });

        </script>
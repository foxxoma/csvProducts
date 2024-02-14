<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
        <div class="container">
            <h2>CSV PARSE</h2>
            <p>Вставьте csv file</p>
            <form onsubmit="return storeProductsByCsv(this, event)">
                <input required id="fileSelect" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                <br>
                <button>Старт</button>
            </form>
        </div>
    </body>
    <script type="text/javascript">
        function storeProductsByCsv(form, e)
        {
            e.preventDefault();
            var myHeaders = new Headers();
            myHeaders.append("Accept", "application/json");

            var formdata = new FormData();
            formdata.append("productsCsv", document.querySelector('#fileSelect').files[0]);

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: formdata,
                redirect: 'follow'
            };

            fetch("http://127.0.0.1:8000/api/v1/products", requestOptions)
                .then(response => response.text())
                .then(result => {
                    alert('Загружено ' + result + ' продуктов');
                    location.href = '/products';
                })
                .catch(error => console.log('error', error));
        }
    </script>
    <style type="text/css">
        /* fonts  */
        @import url('https://fonts.googleapis.com/css?family=Abel|Aguafina+Script|Artifika|Athiti|Condiment|Dosis|Droid+Serif|Farsan|Gurajada|Josefin+Sans|Lato|Lora|Merriweather|Noto+Serif|Open+Sans+Condensed:300|Playfair+Display|Rasa|Sahitya|Share+Tech|Text+Me+One|Titillium+Web');

        .container{
            box-shadow: 0 15px 30px 1px rgba(128, 128, 128, 0.31);
            text-align: center;
            border-radius: 5px;
            margin: 3em auto;
            background: rgba(255, 255, 255, 0.95);
            height: 300px;
            width: 480px;
            padding: 1em;
            
            position: fixed;
            bottom: 0;
            right: 0;
            left: 0;
            top: 0; 
        }

        .container h2 {
            font-family: 'Playfair Display', serif;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size:cover;
            letter-spacing: 2px;
            font-size: 3.5em;
            margin: 0;
            color: #7d7d7d;
        }
        .container p {
            font-family: 'Farsan', cursive;
            margin: 3px 0 1.5em 0;
            font-size: 1.3em;
            color: #7d7d7d;
        }

        .container input {
            width: 210px;
            display: inline-block;
            text-align: center;
            border-radius: 7px;
            background: #eee;
            padding: 1em 2em;
            outline: none;
            border: none;
            color: #222;
            transition: 0.3s linear;
        }
        ::placeholder{color: #999;}
        .container input:focus {background: rgba(0, 0, 333, 0.10);}

        .container button {
            background-image: linear-gradient(to left, rgba(255, 146, 202, 0.75) 0%, rgba(145, 149, 251, 0.86) 100%);
            box-shadow: 0 9px 25px -5px #df91fb;
            font-family: 'Abel', sans-serif;
            padding: 0.5em 1.9em;
            margin: 2.3em 0 0 0;
            border-radius: 7px;
            font-size: 1.4em;
            cursor: pointer;
            color: #FFFFFF;
            font-size: 1em;
            outline: none;
            border: none;
            transition: 0.3s linear;

        }
        .container button:hover{transform: translatey(2px);}
        .container button:active{transform: translatey(5px);}
    </style>
</html>

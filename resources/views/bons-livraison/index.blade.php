<!DOCTYPE html>
    <head>
        <title>Bon de livraison</title>
    </head>
    <style type="text/css">
        #entete {
            margin: 0 0 80px 12px;
        }

        #image {
            width: 200px;
            height: 100px;
        }

        #client {
            border: 2px solid black; 
            border-radius: 10px; 
            width: 30%; 
            padding: 3px 0 50px 50px;
            margin: 0 0 100px 400px; 
        }

        #infos {
            margin: 0 0 20px 12px;
            padding-bottom: 10px;
        }

        table {
            border-collapse: collapse;
            width:95%; 
            margin-left: 12px;
        }

        table, th, td {
            border: 2px solid black;
        }
    </style>
    <body>
        <div id="entete">
            <img src="{{ public_path('images/logo.png') }}" alt="MetroMed Service" id="image">
        </div>
        <div id="client">
            <strong>Client :</strong>
        </div>
        <div id="infos">
            <strong>Bon de livraison N° :</strong>
            <br>
            <strong>Date :</strong>
        </div>
        <table>
            <tr>
                <th>Référence</th>
                <th>Désignation</th>
                <th>QTE</th>
            </tr>
            <tr>
                <td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
                <td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
                <td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
            </tr>
        </table>
    </body>
</html>
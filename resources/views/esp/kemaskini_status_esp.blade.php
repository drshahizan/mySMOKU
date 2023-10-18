<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Received JSON Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .json-container {
            white-space: pre-line;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h1>Received JSON Data</h1>
    <div class="json-container" id="json-container">

        @foreach($data as $person)
            <p>IC Number: {{ $person['nokp'] }}</p>
            <p>ID Permohonan: {{ $person['id_permohonan'] }}</p>
            <p>Tarikh Transaksi: {{ $person['tarikh_transaksi'] }}</p>
            <p>Amaun: {{ $person['amount'] }}</p>
            <hr>
        @endforeach
    </div>

    <script>
        // Assuming you have a variable named 'jsonData' containing your JSON data
        // For example:
        // var jsonData = {"name": "John Doe", "age": 30, "city": "New York"};

        // Display JSON data in the 'json-container' div
        //document.getElementById('json-container').textContent = JSON.stringify(jsonData, null, 2);
    </script>
</body>

</html>

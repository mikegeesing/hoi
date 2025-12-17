<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borg Restore Portal - Welkom</title>
    <style>
        body { font-family: sans-serif; margin: 50px; text-align: center; }
        .error { color: #cc0000; font-weight: bold; }
        .success { color: #008000; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Borg Restore Portal</h1>
    @if (isset($error))
        <p class="error">Fout: {{ $error }}</p>
        <p>Neem contact op met de administratie voor een nieuwe herstel-link.</p>
    @else
        <p class="success">Uw installatie is operationeel.</p>
        <p>Om te herstellen, heeft u een geldige herstel-URL nodig die u van onze administratie heeft ontvangen.</p>
    @endif
</body>
</html>

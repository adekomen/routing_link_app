<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter les Routeurs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Ajouter les Routeurs</h2>
        <form action="{{ route('routeurs.store.final') }}" method="POST">
            @csrf
            @for ($i = 1; $i <= $nombreRouteurs; $i++)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Routeur {{ $i }}</h5>
                        <div class="mb-3">
                            <label for="nom_{{ $i }}" class="form-label">Nom du Routeur</label>
                            <input type="text" name="routeurs[{{ $i }}][nom]" id="nom_{{ $i }}" class="form-control" placeholder="Exemple : R1" required>
                        </div>
                        <div class="mb-3">
                            <label for="reseau_{{ $i }}" class="form-label">Réseau</label>
                            <input type="text" name="routeurs[{{ $i }}][reseau]" id="reseau_{{ $i }}" class="form-control" placeholder="Exemple : 192.168.43.0/24">
                        </div>
                    </div>
                </div>
            @endfor
            <button type="submit" class="btn btn-success">Enregistrer les Routeurs</button>
        </form>
    </div>
</body>
</html>

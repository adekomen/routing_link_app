<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Lien</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Modifier le Lien</h2>
        <form action="{{ route('liens.update', $lien->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col">
                    <label for="routeur1_id" class="form-label">Routeur Source</label>
                    <select name="routeur1_id" id="routeur1_id" class="form-control" required>
                        <option value="" disabled>Choisir un routeur source</option>
                        @foreach($routeurs as $routeur)
                            <option value="{{ $routeur->id }}" {{ $lien->routeur1_id == $routeur->id ? 'selected' : '' }}>{{ $routeur->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="routeur2_id" class="form-label">Routeur Destination</label>
                    <select name="routeur2_id" id="routeur2_id" class="form-control" required>
                        <option value="" disabled>Choisir un routeur destination</option>
                        @foreach($routeurs as $routeur)
                            <option value="{{ $routeur->id }}" {{ $lien->routeur2_id == $routeur->id ? 'selected' : '' }}>{{ $routeur->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="cout" class="form-label">Coût du Lien</label>
                <input type="number" name="cout" id="cout" class="form-control" value="{{ $lien->cout }}" required min="1">
            </div>
            <div class="mb-3">
                <label for="reseau" class="form-label">Réseau</label>
                <input type="text" name="reseau" id="reseau" class="form-control" value="{{ $lien->reseau }}">
            </div>
            <button type="submit" class="btn btn-primary">Mettre à Jour</button>
        </form>
    </div>
</body>
</html>

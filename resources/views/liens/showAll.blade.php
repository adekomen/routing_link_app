<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher les Liens entre Routeurs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Liste des Liens entre Routeurs</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Routeur Source</th>
                    <th>Routeur Destination</th>
                    <th>Coût</th>
                    <th>Réseau</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($liens as $lien)
                    <tr>
                        <td>{{ $lien->routeur1->nom }}</td>
                        <td>{{ $lien->routeur2->nom }}</td>
                        <td>{{ $lien->cout }}</td>
                        <td>{{ $lien->reseau ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('liens.edit', $lien->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('liens.destroy', $lien->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce lien ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('home') }}" class="btn btn-outline-primary mb-4">Retour à l'Accueil</a>

        <a href="{{ route('reseau.visualiser') }}" class="btn btn-outline-primary mb-4">Graphe</a>
    </div>
</body>
</html>

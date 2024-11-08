@extends('layout')

@section('title', 'Ajouter un Lien entre Routeurs')

@section('content')
    <div class="container mt-5">
        <!-- En-tête avec le titre et le lien vers la page d'accueil -->
        <div class="text-center mb-4">
            <h2>Ajouter un Lien entre Routeurs</h2>
            <p class="lead">Configurez les connexions entre vos routeurs en définissant le coût et le réseau.</p>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">Retour à l'Accueil</a>
        </div>

        <!-- Formulaire d'ajout de lien -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Informations sur le Lien</h4>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('liens.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="routeur1_id" class="form-label">Routeur Source</label>
                            <select name="routeur1_id" id="routeur1_id" class="form-control" required>
                                <option value="" disabled selected>Choisir un routeur source</option>
                                @foreach($routeurs as $routeur)
                                    <option value="{{ $routeur->id }}">{{ $routeur->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="routeur2_id" class="form-label">Routeur Destination</label>
                            <select name="routeur2_id" id="routeur2_id" class="form-control" required>
                                <option value="" disabled selected>Choisir un routeur destination</option>
                                @foreach($routeurs as $routeur)
                                    <option value="{{ $routeur->id }}">{{ $routeur->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="cout" class="form-label">Coût du Lien</label>
                        <input type="number" name="cout" id="cout" class="form-control" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="reseau" class="form-label">Réseau</label>
                        <input type="text" name="reseau" id="reseau" class="form-control" placeholder="Réseau (optionnel)">
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100">Ajouter le Lien</button>
                </form>

                <!-- Lien pour voir tous les liens -->
                <div class="text-center mt-4">
                    <a href="{{ route('liens.showAll') }}" class="btn btn-info">Voir tous les Liens</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer : Ajouter des informations supplémentaires -->
    <footer class="bg-light text-center py-3 mt-5">
        <p class="mb-0">&copy; {{ date('Y') }} Réseau de Routeurs. Tous droits réservés.</p>
    </footer>
@endsection

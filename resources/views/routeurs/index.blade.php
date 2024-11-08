@extends('layout')

@section('title', 'Ajouter des Routeurs')

@section('content')
    <div class="container mt-5">
        <!-- En-tête avec le titre et le lien vers la page d'accueil -->
        <div class="text-center mb-4">
            <h2>Ajouter des Routeurs</h2>
            <p class="lead">Configurez le nombre de routeurs et générez dynamiquement les formulaires.</p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <a href="{{ route('home') }}" class="btn btn-outline-primary">Retour à l'Accueil</a>
        </div>

        <!-- Formulaire d'ajout de routeurs -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Entrez le Nombre de Routeurs</h4>
                <form action="{{ route('routeurs.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre_routeurs" class="form-label">Nombre de Routeurs</label>
                        <input type="number" name="nombre_routeurs" id="nombre_routeurs" class="form-control" required min="1" placeholder="Exemple : 3" />
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100">Générer les formulaires</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-5">
        <p class="mb-0">&copy; {{ date('Y') }} Réseau de Routeurs. Tous droits réservés.</p>
    </footer>
@endsection
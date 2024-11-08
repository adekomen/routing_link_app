@extends('layout')

@section('title', 'Accueil')

@section('content')
    <div class="text-center mb-5">
        <h1>Bienvenue sur l'application de gestion de réseau de routeurs</h1>
        <p class="lead mt-4">Accédez aux sections ci-dessus pour gérer les routeurs, configurer les liens, visualiser l'arborescence SPF, et explorer le réseau de manière graphique.</p>
    </div>

    <!-- Section d'Introduction avec Images -->
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <img src="https://img.freepik.com/photos-gratuite/homme-branchant-cable-ethernet-routeur-sans-fil_53876-139544.jpg" alt="Routeur" class="img-fluid mb-3">
            <h4>Gestion des Routeurs</h4>
            <p>Ajoutez, modifiez et configurez vos routeurs pour établir un réseau robuste.</p>
        </div>
        <div class="col-md-4">
            <img src="https://www.dlink.com/fr/fr/-/media/faqs/uk/dir/dir878/dir_878_faq_image097.png?h=258&w=500" alt="Lien" class="img-fluid mb-3">
            <h4>Configuration des Liens</h4>
            <p>Créez des liens entre routeurs pour définir les connexions et le coût de chaque chemin.</p>
        </div>
        <div class="col-md-4">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8fUaDR5EVodthme3hY6vj6sbB0Bw1_ucdYA&s" alt="Visualisation" class="img-fluid mb-3">
            <h4>Visualisation Graphique</h4>
            <p>Explorez la topologie du réseau de manière interactive grâce à une visualisation graphique.</p>
        </div>
    </div>

    <!-- Section d'Explication sur le Routage à État de Lien -->
    <div class="bg-light p-4 rounded mb-5">
        <h3 class="text-center">Qu'est-ce que le routage à état de lien ?</h3>
        <p class="mt-3">Le routage à état de lien est une méthode où chaque routeur analyse les connexions directes avec ses voisins et partage cette information sous forme de paquets d'état de lien. Cette approche permet à chaque routeur de :
        </p>
        <ul>
            <li>Évaluer les liens directs et calculer leur coût.</li>
            <li>Partager les informations de voisinage avec les autres routeurs du réseau.</li>
            <li>Construire une base de données complète de la topologie réseau.</li>
            <li>Utiliser l'algorithme de Dijkstra pour calculer les chemins les plus courts vers chaque routeur.</li>
        </ul>
        <p>En utilisant cette application, vous pouvez visualiser ces étapes et analyser les chemins les plus efficaces dans votre réseau.</p>
    </div>
@endsection

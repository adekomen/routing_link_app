<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisation du Réseau de Routeurs</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        #graph {
            width: 100%;
            height: 600px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            margin-top: 20px;
        }
        .node circle {
            fill: #4e73df;
            stroke: #fff;
            stroke-width: 2px;
            cursor: pointer;
        }
        .node text {
            font-size: 12px;
            text-anchor: middle;
            fill: #fff;
        }
        .link {
            stroke: #000;
            stroke-width: 2px;
            fill: none;
        }
        .arrowhead {
            fill: #000;
        }
        .link text {
            font-size: 12px;
            fill: #000;
            text-anchor: middle;
            font-weight: bold;
        }
        #spf-result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f1f1f1;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Visualisation du Réseau de Routeurs</h2>
        <h4 class="text-center mb-4">Graphique des connexions entre les routeurs</h4>
        <p class="text-center mb-4">Cliquez sur un routeur pour voir son arborescence SPF en bas du graphe.</p>
        <a href="{{ route('home') }}" class="btn btn-outline-primary mb-4">Retour à l'Accueil</a>

        <div id="graph"></div>

        <!-- Conteneur pour afficher l'arborescence SPF -->
        <div id="spf-result">
            <h4 id="spf-title">Arborescence SPF resultant du routeur selectionné</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Adresse Réseau du Routeur de Destination</th>
                        <th>Chemin le Plus Court</th>
                        <th>Coût</th>
                    </tr>
                </thead>
                <tbody id="spf-content">
                    <!-- Les données seront ajoutées ici dynamiquement -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Récupérer les données PHP sous forme de JSON
        const nodes = @json($nodes);
        const edges = @json($edges);

        const width = document.getElementById("graph").offsetWidth;
        const height = 600;

        const svg = d3.select("#graph")
            .append("svg")
            .attr("width", width)
            .attr("height", height);

        svg.append("defs").append("marker")
            .attr("id", "arrowhead")
            .attr("viewBox", "-0 -5 10 10")
            .attr("refX", 15)
            .attr("refY", 0)
            .attr("orient", "auto")
            .attr("markerWidth", 6)
            .attr("markerHeight", 6)
            .append("svg:path")
            .attr("d", "M 0,-5 L 10 ,0 L 0,5")
            .attr("fill", "#000")
            .style("stroke", "none");

        const simulation = d3.forceSimulation(nodes)
            .force("link", d3.forceLink(edges).id(d => d.id).distance(200))
            .force("charge", d3.forceManyBody().strength(-500))
            .force("center", d3.forceCenter(width / 2, height / 2))
            .force("collision", d3.forceCollide().radius(75));

        const link = svg.selectAll(".link")
            .data(edges)
            .enter()
            .append("g")
            .attr("class", "link");

        link.append("line")
            .attr("class", "arrow")
            .attr("marker-end", "url(#arrowhead)");

        link.append("text")
            .attr("dy", -2)
            .attr("class", "link-cost")
            .text(d => `${d.cout}`);
        
        link.append("text")
            .attr("dy", 3)
            .attr("class", "link-network")
            .text(d => `${d.reseau}`);

        const node = svg.selectAll(".node")
            .data(nodes)
            .enter()
            .append("g")
            .attr("class", "node")
            .on("click", function(event, d) {
                afficherSPF(d.id, d.nom);
            });

        node.append("circle")
            .attr("r", 35);

        node.append("text")
            .attr("dy", 4)
            .text(d => d.nom);

        simulation.on("tick", () => {
            link.select("line")
                .attr("x1", d => d.source.x)
                .attr("y1", d => d.source.y)
                .attr("x2", d => d.target.x)
                .attr("y2", d => d.target.y);

            link.select(".link-cost")
                .attr("x", d => (d.source.x + d.target.x) / 2)
                .attr("y", d => (d.source.y + d.target.y) / 2 - 10);

            link.select(".link-network")
                .attr("x", d => (d.source.x + d.target.x) / 2)
                .attr("y", d => (d.source.y + d.target.y) / 2 + 15);

            node.attr("transform", d => `translate(${d.x},${d.y})`);
        });

        // Fonction pour afficher l'arborescence SPF d'un routeur sélectionné
        function afficherSPF(routeurId, routeurNom) {
            document.getElementById("spf-title").innerHTML = `Arborescence SPF resultant de ${routeurNom}`;
            
            fetch(`{{ url('/spf') }}/${routeurId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur lors de la récupération des données SPF');
                    }
                    return response.json();
                })
                .then(data => {
                    let spfContent = data.map(row => `
                        <tr>
                            <td>${row.destination_reseau}</td>
                            <td>${row.chemin}</td>
                            <td>${row.cout}</td>
                        </tr>
                    `).join('');
                    
                    document.getElementById("spf-content").innerHTML = spfContent;
                    document.getElementById("spf-result").style.display = "block";
                })
                .catch(error => console.error('Erreur:', error));
        }

    </script>

</body>
</html>

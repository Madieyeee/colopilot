<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Journalier</title>
    <style>
        @page {
            margin: 2.5cm 1.5cm 2.5cm 1.5cm;
        }
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            font-size: 12px;
            line-height: 1.6;
        }
        .header {
            position: fixed;
            top: -2cm;
            left: 0;
            right: 0;
            height: 1.5cm;
            display: table;
            width: 100%;
            border-bottom: 1px solid #ddd;
        }
        .header .logo-left, .header .logo-right {
            display: table-cell;
            width: 150px;
            vertical-align: middle;
        }
        .header .logo-left img, .header .logo-right img {
            max-width: 140px;
            max-height: 50px;
        }
        .header .logo-right {
            text-align: right;
        }
        .header .title-section {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #2d3748;
        }
        .header .subtitle {
            font-size: 14px;
            color: #555;
            margin: 4px 0 0;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .footer {
            position: fixed;
            bottom: -2cm;
            left: 0;
            right: 0;
            height: 1.5cm;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .footer .page-number:after {
            content: counter(page);
        }
        main {
            margin-top: 0.5cm;
        }
        .report-section {
            margin-bottom: 50px; /* Espace vertical entre les sections */
            page-break-inside: avoid;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) td {
            background-color: #fafafa;
        }
        .section-title {
            font-size: 16px;
            color: #2d3748;
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .summary-table {
            width: 60%;
            margin: 0 auto;
        }
        .summary-table td { 
            border: none; 
            background-color: transparent !important;
            padding: 5px 0;
        }
        .signature-section {
            margin-top: 80px;
            page-break-inside: avoid;
            text-align: center;
        }
        .signature-section p {
            margin-top: 50px;
        }
        .no-data {
            text-align: center;
            padding: 15px 0;
            font-style: italic;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo-left">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo Gauche">
        </div>
        <div class="title-section">
            <h1>Rapport Journalier d'Activité</h1>
            <p class="subtitle">Colonie de Vacances – Hôtel Les Hibiscus</p>
            <p>Pour la journée du {{ $date->format('d/m/Y') }}</p>
        </div>
        <div class="logo-right">
            <img src="{{ public_path('images/colopilot.png') }}" alt="Logo Droite">
        </div>
    </div>

    <div class="footer">
        Généré le {{ now()->format('d/m/Y à H:i') }} par Colopilote | Document confidentiel | Page <span class="page-number"></span>
    </div>

    <main>
        <div class="report-section">
            <h2 class="section-title">Résumé de la journée</h2>
            <table class="summary-table">
            <tr>
                <td style="width: 150px;"><strong>Enfants inscrits :</strong></td>
                <td>{{ $totalChildren }}</td>
            </tr>
            <tr>
                <td><strong>Enfants présents :</strong></td>
                <td>{{ $presentChildren }}</td>
            </tr>
            <tr>
                <td><strong>Enfants absents :</strong></td>
                <td>{{ $absentCount }}</td>
            </tr>
            <tr>
                <td><strong>Incidents signalés :</strong></td>
                <td>{{ $incidents->count() }}</td>
            </tr>
        </table>
        </div>

        <div class="report-section">
            <h2 class="section-title">Incidents Signalés</h2>
        @if($incidents->isEmpty())
            <p class="no-data">Aucun incident signalé aujourd'hui.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Heure</th>
                        <th>Enfant</th>
                        <th>Signalé par</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incidents as $incident)
                        <tr>
                            <td style="width: 15%;">{{ $incident->created_at->format('H:i') }}</td>
                            <td style="width: 20%;">{{ $incident->child->full_name }}</td>
                            <td style="width: 20%;">{{ $incident->user->name }}</td>
                            <td>{{ $incident->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        </div>

        <div class="report-section">
            <h2 class="section-title">Absences Enregistrées</h2>
        @if($attendances->isEmpty())
            <p class="no-data">Aucune absence enregistrée aujourd'hui.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Enfant</th>
                        <th>Motif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                        <tr>
                            <td style="width: 40%;">{{ $attendance->child->full_name }}</td>
                            <td>{{ $attendance->reason }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        </div>

        <div class="report-section">
            <h2 class="section-title">Programme du Jour</h2>
        @if($activity)
            <table>
                <tbody>
                    <tr>
                        <td style="width: 25%;"><strong>Activité du Matin :</strong></td>
                        <td>{{ $activity->morning_activity }}</td>
                    </tr>
                    <tr>
                        <td><strong>Activité de l'Après-midi :</strong></td>
                        <td>{{ $activity->afternoon_activity }}</td>
                    </tr>
                    <tr>
                        <td><strong>Veillée :</strong></td>
                        <td>{{ $activity->evening_activity }}</td>
                    </tr>
                    <tr>
                        <td><strong>Responsable(s) :</strong></td>
                        <td>{{ $activity->responsible }}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <p class="no-data">Aucun programme trouvé pour aujourd'hui.</p>
        @endif
        </div>
        
        <div class="signature-section">
            <p>Nom et Prénom du Responsable : ______________________________</p>
            <p>Signature :</p>
        </div>

    </main>

</body>
</html>

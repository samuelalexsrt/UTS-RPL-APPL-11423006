<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTrack | Architecture Dashboard</title>
    <link rel="stylesheet" href="resources/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <div class="title-group">
                <h1>MediTrack Transformation</h1>
                <p>Architecture Evolution: Monolith to Microservices</p>
            </div>
            <div class="controls">
                <button class="btn btn-primary" onclick="toggleView('monolith')">
                    <i class="fas fa-cube"></i> Monolith
                </button>
                <button class="btn btn-primary" onclick="toggleView('microservices')">
                    <i class="fas fa-cubes"></i> Microservices
                </button>
                <button class="btn btn-primary" id="runBtn" onclick="runSimulation()">
                    <i class="fas fa-play"></i> Run Simulation
                </button>
            </div>
        </header>

        <main>
            <div class="view-card">
                <div class="architecture-header">
                    <h2 id="viewTitle">Monolithic Architecture</h2>
                    <span id="statusBadge" style="color: var(--success); font-weight: 600;">ACTIVE</span>
                </div>
                
                <div class="visualizer">
                    <!-- Monolith SVG -->
                    <div id="monolithView" class="monolith-view active">
                        <svg width="800" height="400" viewBox="0 0 800 400">
                            <!-- Shared Database -->
                            <rect x="350" y="300" width="100" height="60" rx="10" fill="var(--card-bg)" stroke="var(--primary)" stroke-width="2"/>
                            <text x="400" y="335" fill="var(--text)" text-anchor="middle" font-size="12">Shared DB</text>
                            
                            <!-- Application Block -->
                            <rect x="200" y="50" width="400" height="200" rx="20" fill="rgba(34, 211, 238, 0.1)" stroke="var(--primary)" stroke-width="2" stroke-dasharray="5,5"/>
                            <text x="400" y="30" fill="var(--primary)" text-anchor="middle" font-weight="bold">Single Codebase (PHP)</text>

                            <!-- Modules -->
                            <g id="mono-auth" transform="translate(220, 70)">
                                <rect width="110" height="40" rx="8" fill="var(--card-bg)" stroke="var(--secondary)"/>
                                <text x="55" y="25" fill="var(--text)" text-anchor="middle" font-size="12">Auth</text>
                            </g>
                            <g id="mono-appt" transform="translate(345, 70)">
                                <rect width="110" height="40" rx="8" fill="var(--card-bg)" stroke="var(--secondary)"/>
                                <text x="55" y="25" fill="var(--text)" text-anchor="middle" font-size="12">Appointment</text>
                            </g>
                            <g id="mono-ehr" transform="translate(470, 70)">
                                <rect width="110" height="40" rx="8" fill="var(--card-bg)" stroke="var(--secondary)"/>
                                <text x="55" y="25" fill="var(--text)" text-anchor="middle" font-size="12">EHR</text>
                            </g>
                            <g id="mono-pharm" transform="translate(220, 150)">
                                <rect width="110" height="40" rx="8" fill="var(--card-bg)" stroke="var(--secondary)"/>
                                <text x="55" y="25" fill="var(--text)" text-anchor="middle" font-size="12">Pharmacy</text>
                            </g>
                            <g id="mono-anal" transform="translate(345, 150)">
                                <rect width="110" height="40" rx="8" fill="var(--card-bg)" stroke="var(--secondary)"/>
                                <text x="55" y="25" fill="var(--text)" text-anchor="middle" font-size="12">Analytics</text>
                            </g>
                            <g id="mono-pay" transform="translate(470, 150)">
                                <rect width="110" height="40" rx="8" fill="var(--card-bg)" stroke="var(--secondary)"/>
                                <text x="55" y="25" fill="var(--text)" text-anchor="middle" font-size="12">Payment</text>
                            </g>

                            <!-- TIGHT COUPLING LINES -->
                            <path d="M 525 110 L 275 150" stroke="var(--accent)" stroke-width="1" stroke-dasharray="4" fill="none"/>
                            <text x="400" y="130" fill="var(--accent)" font-size="10" text-anchor="middle">Direct Call</text>
                        </svg>
                    </div>

                    <!-- Microservices SVG -->
                    <div id="microservicesView" class="microservices-view">
                        <svg width="800" height="400" viewBox="0 0 800 400">
                            <!-- API Gateway -->
                            <path d="M 50 200 L 150 200" stroke="var(--primary)" stroke-width="2" class="data-flow"/>
                            <rect x="150" y="100" width="40" height="200" rx="10" fill="var(--primary)" opacity="0.2" stroke="var(--primary)"/>
                            <text x="170" y="50" fill="var(--primary)" text-anchor="middle" transform="rotate(-90 170,100)" font-weight="bold">API Gateway</text>

                            <!-- Services -->
                            <g id="svc-auth" transform="translate(350, 20)">
                                <circle r="35" cx="35" cy="35" fill="var(--card-bg)" stroke="var(--primary)" class="node"/>
                                <text x="35" y="40" fill="var(--text)" text-anchor="middle" font-size="10">Auth</text>
                                <rect x="25" y="75" width="20" height="15" fill="var(--secondary)" opacity="0.5"/>
                            </g>
                            <g id="svc-appt" transform="translate(550, 20)">
                                <circle r="35" cx="35" cy="35" fill="var(--card-bg)" stroke="var(--primary)" class="node"/>
                                <text x="35" y="40" fill="var(--text)" text-anchor="middle" font-size="10">Appt</text>
                                <rect x="25" y="75" width="20" height="15" fill="var(--secondary)" opacity="0.5"/>
                            </g>
                            <g id="svc-ehr" transform="translate(350, 150)">
                                <circle r="35" cx="35" cy="35" fill="var(--card-bg)" stroke="var(--primary)" class="node"/>
                                <text x="35" y="40" fill="var(--text)" text-anchor="middle" font-size="10">EHR</text>
                                <rect x="25" y="75" width="20" height="15" fill="var(--secondary)" opacity="0.5"/>
                            </g>
                            <g id="svc-pharm" transform="translate(550, 150)">
                                <circle r="35" cx="35" cy="35" fill="var(--card-bg)" stroke="var(--primary)" class="node"/>
                                <text x="35" y="40" fill="var(--text)" text-anchor="middle" font-size="10">Pharm</text>
                                <rect x="25" y="75" width="20" height="15" fill="var(--secondary)" opacity="0.5"/>
                            </g>
                            <g id="svc-anal" transform="translate(350, 280)">
                                <circle r="35" cx="35" cy="35" fill="var(--card-bg)" stroke="var(--primary)" class="node"/>
                                <text x="35" y="40" fill="var(--text)" text-anchor="middle" font-size="10">Analytics</text>
                                <rect x="25" y="75" width="20" height="15" fill="var(--secondary)" opacity="0.5"/>
                            </g>
                            <g id="svc-pay" transform="translate(550, 280)">
                                <circle r="35" cx="35" cy="35" fill="var(--card-bg)" stroke="var(--primary)" class="node"/>
                                <text x="35" y="40" fill="var(--text)" text-anchor="middle" font-size="10">Pay</text>
                                <rect x="25" y="75" width="20" height="15" fill="var(--secondary)" opacity="0.5"/>
                            </g>

                            <!-- MESSAGE BUS -->
                            <rect x="700" y="50" width="30" height="300" rx="15" fill="var(--accent)" opacity="0.1" stroke="var(--accent)"/>
                            <text x="715" y="50" fill="var(--accent)" text-anchor="middle" transform="rotate(-90 715,50)" font-size="10">Message Bus</text>

                            <!-- CONNECTIONS -->
                            <path d="M 190 200 L 350 55" stroke="var(--primary)" stroke-width="1" opacity="0.3" fill="none"/>
                            <path d="M 190 200 L 350 185" stroke="var(--primary)" stroke-width="1" opacity="0.3" fill="none"/>
                            <path d="M 385 185 Q 500 200 700 200" stroke="var(--accent)" stroke-width="1" stroke-dasharray="5,5" fill="none" class="data-flow"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="console-card">
                <div class="console-header">
                    <div class="dot dot-red"></div>
                    <div class="dot dot-yellow"></div>
                    <div class="dot dot-green"></div>
                    <span style="margin-left: 10px; color: var(--text-dim); font-size: 0.8rem;">Architecture Console Output</span>
                </div>
                <div id="consoleLog">
                    > System ready. Choose an architecture to simulate...
                </div>
            </div>
        </main>
    </div>

    <script src="resources/js/dashboard.js"></script>
</body>
</html>

let currentView = 'monolith';

function toggleView(view) {
    currentView = view;
    // Update active classes
    document.getElementById('monolithView').classList.toggle('active', view === 'monolith');
    document.getElementById('microservicesView').classList.toggle('active', view === 'microservices');
    
    // Update Title
    document.getElementById('viewTitle').innerText = view === 'monolith' ? 'Monolithic Architecture' : 'Microservices Architecture';
    
    // Clear Console
    logToConsole(`> Switched to ${view.toUpperCase()} view.`);
}

function logToConsole(message) {
    const consoleLog = document.getElementById('consoleLog');
    const line = document.createElement('div');
    line.style.marginBottom = '5px';
    line.innerHTML = `<span style="color: var(--primary)">[${new Date().toLocaleTimeString()}]</span> ${message}`;
    consoleLog.prepend(line);
}

async function runSimulation() {
    const btn = document.getElementById('runBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Running...';
    
    logToConsole(`> Starting simulation for ${currentView.toUpperCase()}...`);

    if (currentView === 'monolith') {
        await simulateMonolith();
    } else {
        await simulateMicroservices();
    }

    logToConsole(`> Simulation ${currentView.toUpperCase()} completed successfully.`);
    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-play"></i> Run Simulation';
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function simulateMonolith() {
    const modules = ['mono-auth', 'mono-appt', 'mono-ehr', 'mono-pharm', 'mono-pay', 'mono-anal'];
    for (const id of modules) {
        const el = document.getElementById(id);
        el.querySelector('rect').style.strokeWidth = '4px';
        el.querySelector('rect').style.stroke = 'var(--accent)';
        logToConsole(`Processing ${id.split('-')[1]} module...`);
        await sleep(600);
        el.querySelector('rect').style.strokeWidth = '1px';
        el.querySelector('rect').style.stroke = 'var(--secondary)';
    }
}

async function simulateMicroservices() {
    const services = ['svc-auth', 'svc-appt', 'svc-ehr', 'svc-pharm', 'svc-pay', 'svc-anal'];
    for (const id of services) {
        const el = document.getElementById(id);
        el.querySelector('circle').style.fill = 'rgba(34, 211, 238, 0.4)';
        el.querySelector('circle').style.strokeWidth = '4px';
        
        logToConsole(`Requesting ${id.split('-')[1]} service via API Gateway...`);
        await sleep(800);
        
        if (id === 'svc-ehr') {
            logToConsole(`EHR Service publishing event to Message Bus...`);
            await sleep(500);
        }

        el.querySelector('circle').style.fill = 'var(--card-bg)';
        el.querySelector('circle').style.strokeWidth = '1px';
    }
}

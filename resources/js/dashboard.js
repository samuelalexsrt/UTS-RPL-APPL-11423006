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
    const modules = [
        { id: 'mono-auth', msg: 'Mendaftarkan pasien baru & Login...' },
        { id: 'mono-appt', msg: 'Mengecek ketersediaan & Membuat janji temu...' },
        { id: 'mono-ehr', msg: 'Menambahkan rekam medis (Tightly Coupled with Pharmacy)...' },
        { id: 'mono-pay', msg: 'Memproses pembayaran & Menghasilkan Invoice...' },
        { id: 'mono-anal', msg: 'Menghasilkan laporan tren kunjungan harian...' }
    ];

    for (const mod of modules) {
        const el = document.getElementById(mod.id);
        if (!el) continue;
        el.querySelector('rect').style.strokeWidth = '4px';
        el.querySelector('rect').style.stroke = 'var(--accent)';
        logToConsole(mod.msg);
        await sleep(800);
        el.querySelector('rect').style.strokeWidth = '1px';
        el.querySelector('rect').style.stroke = 'var(--secondary)';
    }
}

async function simulateMicroservices() {
    const services = [
        { id: 'svc-auth', msg: 'Auth Service: Mengenali peran Pasien...' },
        { id: 'svc-appt', msg: 'Appt Service: Validasi jadwal via API Gateway...' },
        { id: 'svc-ehr', msg: 'EHR Service: Record disimpan & Publish Event...' },
        { id: 'svc-pharm', msg: 'Pharm Service: Consuming Medication Event...' },
        { id: 'svc-pay', msg: 'Pay Service: Invoice digital di-generate...' },
        { id: 'svc-anal', msg: 'Analytics: Analisis data dari Event Stream...' }
    ];

    for (const svc of services) {
        const el = document.getElementById(svc.id);
        if (!el) continue;
        el.querySelector('circle').style.fill = 'rgba(34, 211, 238, 0.4)';
        el.querySelector('circle').style.strokeWidth = '4px';
        
        logToConsole(svc.msg);
        await sleep(800);
        
        if (svc.id === 'svc-ehr') {
            logToConsole(`<span style="color: var(--accent)">[Event]</span> medication.prescribed terkirim ke Message Bus`);
            await sleep(500);
        }

        el.querySelector('circle').style.fill = 'var(--card-bg)';
        el.querySelector('circle').style.strokeWidth = '1px';
    }
}

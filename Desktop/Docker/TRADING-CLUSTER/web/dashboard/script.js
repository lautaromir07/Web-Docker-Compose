// Configuración de Gráficos de TradingView
function initCharts() {
    new TradingView.widget({
        "autosize": true,
        "symbol": "BINANCE:BTCUSDT",
        "interval": "15",
        "timezone": "Etc/UTC",
        "theme": "dark",
        "style": "1",
        "locale": "es",
        "toolbar_bg": "#f1f3f6",
        "enable_publishing": false,
        "hide_top_toolbar": true,
        "save_image": false,
        "container_id": "tradingview_btc"
    });

    new TradingView.widget({
        "autosize": true,
        "symbol": "BINANCE:ETHUSDT",
        "interval": "15",
        "timezone": "Etc/UTC",
        "theme": "dark",
        "style": "1",
        "locale": "es",
        "toolbar_bg": "#f1f3f6",
        "enable_publishing": false,
        "hide_top_toolbar": true,
        "save_image": false,
        "container_id": "tradingview_eth"
    });

    new TradingView.widget({
        "autosize": true,
        "symbol": "OANDA:XAUUSD",
        "interval": "15",
        "timezone": "Etc/UTC",
        "theme": "dark",
        "style": "1",
        "locale": "es",
        "toolbar_bg": "#f1f3f6",
        "enable_publishing": false,
        "hide_top_toolbar": true,
        "save_image": false,
        "container_id": "tradingview_gold"
    });
}

// Estado Global del Dashboard
let currentBalance = 500.00;
let tradesCount = 0;

// Simulación de Consola en Vivo (con soporte para datos reales)
async function fetchBotData() {
    try {
        const btcResponse = await fetch('http://localhost:8000/live_data.json');
        const goldResponse = await fetch('http://localhost:8000/live_data_gold.json');

        if (btcResponse.ok) {
            const data = await btcResponse.json();
            document.querySelector('.btc-price').innerText = `$${data.current_price.toLocaleString()}`;
            addBotLog(`[BTC] ${data.status} - Precio: ${data.current_price} | Signal: ${data.signal}`, 'normal');
        } else {
            simulateStep('BTC');
        }

        if (goldResponse.ok) {
            const data = await goldResponse.json();
            document.querySelector('.gold-price').innerText = `$${data.current_price.toLocaleString()}`;
            addBotLog(`[GOLD] ${data.status} - Precio: ${data.current_price} | Signal: ${data.signal}`, 'info');
        } else {
            simulateStep('GOLD');
        }
    } catch (e) {
        // Fallback total a simulación educativa
        simulateStep('BTC');
        simulateStep('GOLD');
    }
}

// Lógica de Simulación Educativa para cuando no hay bots activos
function simulateStep(asset) {
    const chance = Math.random();
    const btcPrice = document.querySelector('.btc-price');
    const goldPrice = document.querySelector('.gold-price');

    if (asset === 'BTC') {
        const price = (65000 + Math.random() * 200).toFixed(2);
        btcPrice.innerText = `$${parseFloat(price).toLocaleString()}`;
        if (chance > 0.95) {
            addBotLog(`[SIMULACIÓN BTC] SuperTrend Alcista detectado. Simulando entrada en larga...`, 'normal');
            recordTrade('BTC', 'LONG', (Math.random() * 20 - 5).toFixed(2));
        }
    } else if (asset === 'GOLD') {
        const price = (2350 + Math.random() * 5).toFixed(2);
        goldPrice.innerText = `$${parseFloat(price).toLocaleString()}`;
        if (chance > 0.95) {
            addBotLog(`[SIMULACIÓN ORO] Cruce EMA 20/50 Detectado. Simulando Scalping...`, 'info');
            recordTrade('XAUUSD', 'SHORT', (Math.random() * 15 - 3).toFixed(2));
        }
    }
}

function recordTrade(asset, type, pnl) {
    const opsBody = document.getElementById('ops-body');
    const isWin = pnl > 0;

    // Actualizar Balance Real (Simulado)
    currentBalance += parseFloat(pnl);
    document.querySelector('.balance-value').innerHTML = `$${currentBalance.toFixed(2)} <span class="trend-up">${isWin ? '↑' : '↓'}</span>`;

    const row = `
        <tr>
            <td>${asset}</td>
            <td><span class="badge ${type.toLowerCase()}">${type}</span></td>
            <td><span class="status ${isWin ? 'color-gain' : 'color-loss'}">${isWin ? 'Win' : 'Loss'}</span></td>
            <td class="${isWin ? 'color-gain' : 'color-loss'}">${isWin ? '+' : '-'}$${Math.abs(pnl).toFixed(2)}</td>
        </tr>
    `;
    opsBody.insertAdjacentHTML('afterbegin', row);
    if (opsBody.children.length > 10) opsBody.lastElementChild.remove();
}

function addBotLog(message, type = 'normal') {
    const consoleLogs = document.getElementById('console-logs');
    const logEntry = document.createElement('div');
    const time = new Date().toLocaleTimeString();
    logEntry.className = `log-entry ${type}`;
    logEntry.textContent = `[${time}] ${message}`;
    consoleLogs.appendChild(logEntry);
    consoleLogs.scrollTop = consoleLogs.scrollHeight;
}

// Noticias Reales (via TradingView Widget o API pública)
function initNews() {
    const container = document.getElementById('news-container');
    container.innerHTML = '<li>Cargando noticias reales...</li>';

    // Inyectar widget de noticias de TradingView para mayor realismo
    const newsWidget = document.createElement('div');
    newsWidget.id = "tv-news-widget";
    container.parentNode.replaceChild(newsWidget, container);

    new TradingView.EventsWidget({
        "colorTheme": "dark",
        "isTransparent": true,
        "width": "100%",
        "height": "100%",
        "locale": "es",
        "importanceFilter": "-1,0,1",
        "currencyFilter": "USD,BTC,EUR",
        "container_id": "tv-news-widget"
    });
}

// Inicialización
window.onload = () => {
    initCharts();
    initNews();
    setInterval(fetchBotData, 4000);

    addBotLog("Dashboard iniciado en MODO HÍBRIDO (Real/Simulado).", "info");
    addBotLog(`Balance inicial de prueba establecido en $500.00.`, "normal");
};

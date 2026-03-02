<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trading Master Dashboard - Live</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="background-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <main class="dashboard-container">
        <!-- Sidebar / Stats Header -->
        <header class="dashboard-header">
            <div class="logo">
                <span class="pulse"></span>
                <h1>TRADING<span>HUB</span></h1>
            </div>
            <div class="market-status">
                <div class="stat-item">
                    <small>MERCADO</small>
                    <span class="status-online">ABIERTO</span>
                </div>
                <div class="stat-item">
                    <small>SESIÓN</small>
                    <span id="session-time">LONDRES</span>
                </div>
            </div>
            <div class="balance-card">
                <small>BALANCE TOTAL (DEMO)</small>
                <div class="balance-value">$500.00 <span class="trend-up">+0.0%</span></div>
            </div>
        </header>

        <!-- Charts Grid -->
        <section class="charts-section">
            <div class="chart-container glass">
                <div class="chart-header">
                    <h3>BITCOIN / USDT</h3>
                    <span class="price-tag btc-price">--</span>
                </div>
                <div id="tradingview_btc" class="tv-widget"></div>
            </div>
            <div class="chart-container glass">
                <div class="chart-header">
                    <h3>ETHEREUM / USDT</h3>
                    <span class="price-tag eth-price">--</span>
                </div>
                <div id="tradingview_eth" class="tv-widget"></div>
            </div>
            <div class="chart-container glass">
                <div class="chart-header">
                    <h3>ORO (XAUUSD)</h3>
                    <span class="price-tag gold-price">--</span>
                </div>
                <div id="tradingview_gold" class="tv-widget"></div>
            </div>
        </section>

        <!-- Dynamic Logs & Operations -->
        <section class="bottom-section">
            <!-- Order Console -->
            <div class="console-box glass">
                <div class="box-header">
                    <div class="dot-red"></div>
                    <span>BOT CONSOLE (BTC MOON HUNTER)</span>
                </div>
                <div id="console-logs" class="logs-content">
                    <div class="log-entry">[09:30:12] Bot iniciado correctamente...</div>
                    <div class="log-entry">[09:35:00] Analizando tendencia SuperTrend en BTC/USDT...</div>
                    <div class="log-entry info">[09:45:22] Señal detectada en Gold Momentum Scalper.</div>
                </div>
            </div>

            <!-- Operations Breakdown -->
            <div class="operations-box glass">
                <div class="box-header">
                    <span>DESGLOSE OPERACIONES DEL DÍA</span>
                </div>
                <table class="ops-table">
                    <thead>
                        <tr>
                            <th>ACTIVO</th>
                            <th>TIPO</th>
                            <th>ESTADO</th>
                            <th>P&L</th>
                        </tr>
                    </thead>
                    <tbody id="ops-body">
                        <!-- Creado dinámicamente -->
                        <tr>
                            <td>XAUUSD</td>
                            <td><span class="badge long">LONG</span></td>
                            <td><span class="status color-gain">Win</span></td>
                            <td class="color-gain">+$245.00</td>
                        </tr>
                        <tr>
                            <td>BTCUSD</td>
                            <td><span class="badge long">LONG</span></td>
                            <td><span class="status color-loss">Loss</span></td>
                            <td class="color-loss">-$120.50</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Economic Calendar -->
            <div class="info-box glass">
                <div class="box-header"><span>CALENDARIO ECONÓMICO (TRADINGVIEW)</span></div>
                <div class="calendar-wrapper">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <script type="text/javascript"
                            src="https://s3.tradingview.com/external-embedding/embed-widget-events.js" async>
                                {
                                    "colorTheme": "dark",
                                        "isTransparent": true,
                                            "width": "100%",
                                                "height": "450",
                                                    "locale": "es",
                                                        "importanceFilter": "-1,0,1",
                                                            "currencyFilter": "USD,EUR,GBP,JPY,CAD,AUD,CHF"
                                }
                            </script>
                    </div>
                    <!-- TradingView Widget END -->
                </div>
            </div>
        </section>
    </main>

    <!-- TradingView Widget Script -->
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    <script src="script.js"></script>
</body>

</html>
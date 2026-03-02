@echo off
echo ==========================================
echo   TRADING CLUSTER - SISTEMA DE RESTAURACION
echo ==========================================
echo.
echo Verificando estado de los nodos...
docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"
echo.
echo Re-levantando servicios caidos (Auto-healing)...
docker-compose up -d
echo.
echo Limpiando recursos huerfanos...
docker network prune -f
echo.
echo Sistema restaurado y balanceado.
pause


# 🐳 Trading Cluster Dashboard
Infraestructura web de alta disponibilidad diseñada con **Docker Compose**. Este sistema garantiza que el Dashboard de Trading permanezca operativo mediante balanceo de carga y persistencia de datos.
---
## 🚀 Arquitectura del Sistema
* **Load Balancer (Nginx):** Distribuye el tráfico entre los nodos activos.
* **Nodos Web (Alpha & Beta):** Servidores PHP independientes para el dashboard.
* **Base de Datos (MariaDB):** Almacenamiento relacional de usuarios.
* **Persistencia:** Uso de **Docker Volumes** para evitar pérdida de datos.
---
## 🛠️ Guía de Despliegue Paso a Paso
Siga estos comandos individualmente en su terminal:
### 1. Clonar el repositorio
Obtenga el código fuente desde el repositorio oficial:
```bash
git clone https://github.com/lautaromir07/Web-Docker-Compose.git
```
### 2. Acceder al directorio del proyecto
Sitúese en la carpeta raíz del clúster:
```bash
cd Web-Docker-Compose/Desktop/Docker/TRADING-CLUSTER
```
### 3. Levantar la infraestructura
Construya las imágenes e inicie los servicios en segundo plano:
```bash
docker-compose up -d
```
### 4. Verificación de estado
Confirme que los 4 contenedores están corriendo:
```bash
docker ps
```
---
## 🌐 Acceso al Clúster
Una vez desplegado, acceda con las siguientes credenciales:
- **URL:** [http://localhost:8081](http://localhost:8081)
- **Usuario:** `admin`
- **Contraseña:** `admin123`
> [!IMPORTANT]
> El tráfico externo entra por el puerto 8081 (Nginx), que luego lo redirige internamente a los nodos web.
---
## 🛑 Gestión del Ciclo de Vida
Detener los servicios:
```bash
docker-compose stop
```
Eliminar contenedores (mantiene datos):
```bash
docker-compose down
```
Reiniciar clúster:
```bash
docker-compose restart
```

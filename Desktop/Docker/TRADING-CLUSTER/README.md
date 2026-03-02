# 🐳 Trading Cluster Dashboard

Infraestructura web de alta disponibilidad diseñada con **Docker Compose**. Este sistema implementa redundancia y persistencia de datos para garantizar que el Dashboard de Trading permanezca operativo incluso ante fallos de contenedores individuales.

---

## 🚀 Arquitectura del Sistema

* **Load Balancer (Nginx):** Actúa como punto de entrada único, distribuyendo el tráfico entre los nodos activos.
* **Nodos Web (Alpha & Beta):** Servidores PHP independientes que ejecutan la lógica del dashboard.
* **Base de Datos (MariaDB):** Motor de base de datos relacional para la gestión de usuarios.
* **Persistencia de Datos:** Implementación de **Docker Volumes** para asegurar que la información no se pierda al reiniciar o borrar contenedores.

---

## 🛠️ Guía de Despliegue Paso a Paso

Siga estos comandos en su terminal para poner en marcha el entorno de forma profesional:

### 1. Clonar el repositorio
Obtenga el código fuente desde el repositorio oficial:

```bash
git clone https://github.com/lautaromir07/Web-Docker-Compose.git
2. Acceder al directorio del proyecto

Es indispensable situarse en la carpeta raíz del clúster antes de ejecutar Docker:

cd Web-Docker-Compose/Desktop/Docker/TRADING-CLUSTER
3. Levantar la infraestructura

Inicie la construcción de imágenes y el despliegue de servicios en segundo plano (detached mode):

docker-compose up -d
4. Verificación de estado

Confirme que los 4 servicios están en estado Up y funcionando correctamente:

docker ps
🌐 Acceso al Clúster

Una vez completado el despliegue, el dashboard estará disponible con las siguientes credenciales:

URL: http://localhost:8081

Usuario: admin

Contraseña: admin123

Importante: El acceso se realiza exclusivamente a través del puerto 8081. Nginx se encarga de balancear internamente las peticiones hacia los nodos web_node_alpha y web_node_beta.

📦 Componentes Técnicos
Servicio	Tecnología	Función
Trading Web	PHP + Curl	Lógica de negocio y consumo de APIs externas.
Nginx	Reverse Proxy	Balanceo de carga y gestión de tráfico HTTP.
MariaDB	SQL Database	Almacenamiento persistente de credenciales.
Restore	Batch Script	Utilidad restore.bat para recuperación de base de datos.
🛑 Gestión del Ciclo de Vida

Comandos útiles para la administración del clúster:

Detener los servicios (mantiene los contenedores creados):

docker-compose stop

Eliminar la infraestructura (los datos de la DB persistirán en el volumen):

docker-compose down

Reiniciar todo el clúster:

docker-compose restart

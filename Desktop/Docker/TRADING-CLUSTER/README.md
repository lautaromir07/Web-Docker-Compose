# 🐳 Trading Cluster Dashboard

Este proyecto implementa una infraestructura web redundante y persistente para el Dashboard de Trading, diseñada para sobrevivir a fallos de contenedores mediante un balanceo de carga y alta disponibilidad.

## 🚀 Arquitectura

* **Load Balancer (Nginx):** Reparte el tráfico entre dos nodos web. Si uno se apaga, el otro sigue funcionando.
* **Nodos Web (web_node_alpha y web_node_beta):** Servidores PHP con el dashboard. Incluyen un sistema de Login obligatorio.
* **Base de Datos (MariaDB):** Almacena los usuarios y credenciales.
* **Persistencia Fuerte:** Los datos de la base de datos están vinculados a un **Volumen Docker**, garantizando que la información no se pierda aunque se detengan o borren los contenedores.

---

## 🛠️ Guía de Despliegue (Paso a Paso)

Sigue estos comandos en tu terminal para poner en marcha el clúster:

### 1. Clonar el repositorio
Primero, clona el proyecto y accede a la carpeta específica del clúster:

```bash
git clone [https://github.com/lautaromir07/Web-Docker-Compose.git](https://github.com/lautaromir07/Web-Docker-Compose.git)
cd Web-Docker-Compose/Desktop/Docker/TRADING-CLUSTER
2. Levantar la infraestructura
Ejecuta Docker Compose para construir las imágenes y levantar los servicios en segundo plano:

Bash
docker-compose up -d
3. Verificar los contenedores
Asegúrate de que los 4 contenedores (nginx, mariaDB y los 2 nodos web) estén corriendo:

Bash
docker ps
🚀 Acceso al Clúster
Una vez desplegado, puedes acceder desde tu navegador:

URL: http://localhost:8081

Usuario: admin

Contraseña: admin123

[!NOTE]
El clúster escucha en el puerto 8081, el cual es gestionado por el balanceador Nginx para distribuir las peticiones entre los nodos.

📦 Componentes del Clúster
Este proyecto es un clúster multi-contenedor. No es una sola imagen, sino un conjunto de servicios trabajando en armonía:

Trading Web: Imagen personalizada basada en PHP con soporte para Curl.

Nginx: Configurado como Reverse Proxy y Load Balancer.

MariaDB: Base de datos relacional con volumen persistente.

Restore Script: El archivo restore.bat se incluye para facilitar tareas de recuperación de base de datos si fuera necesario.

🛑 Detener el proyecto
Para apagar el clúster sin borrar los datos:

Bash
docker-compose stop
Para eliminar los contenedores (los datos de la DB persistirán en el volumen):

Bash
docker-compose down

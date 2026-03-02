# 🐳 Trading Cluster Dashboard

Este proyecto implementa una infraestructura web redundante y persistente para el Dashboard de Trading, diseñada para sobrevivir a fallos de contenedores.

## 🚀 Arquitectura
- **Load Balancer (Nginx)**: Reparte el tráfico entre dos nodos web. Si uno se apaga, el otro sigue funcionando.
- **Nodos Web (web_node_alpha y web_node_beta)**: Servidores PHP con el dashboard. Incluyen un sistema de Login obligatorio.
- **Base de Datos (MariaDB)**: Almacena los usuarios. 
- **Persistencia Fuerte**: Los datos de la base de datos están en un **Volumen Docker**, lo que garantiza que no se pierdan aunque se borren los contenedores.

## 🚀 Acceso al Clúster
- **URL**: [http://localhost:8081](http://localhost:8081)
- **Usuario**: `admin`
- **Contraseña**: `admin123`

> [!NOTE]
> El clúster escucha en el puerto **8081** (mapeado desde el balanceador Nginx).

## 📦 Entrega y Docker Hub
Este proyecto es un **clúster multi-contenedor**. No es una sola imagen, sino un conjunto de servicios trabajando en armonía:
1. **Trading Web**: Imagen personalizada (PHP + Curl).
2. **Nginx**: Balanceador de carga.
3. **MariaDB**: Base de datos persistente.



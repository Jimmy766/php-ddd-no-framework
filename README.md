# Proyecto PHP con DDD, Doctrine y Docker

Este proyecto demuestra un ejemplo mínimo de arquitectura DDD en PHP 7.x, usando Doctrine para la persistencia de datos y PHPUnit para pruebas.

## Requisitos
- Docker y docker-compose instalados

## Pasos para ejecutar el entorno

1. Clonar el repositorio:
   git clone https://github.com/Jimmy766/php-ddd-no-framework.git

2. Entrar al directorio y levantar contenedores:
   - cd prueba-php-ddd
   - make up

3. Instalar dependencias dentro del contenedor PHP:
   docker-compose exec php composer install

4. Crear/actualizar la base de datos:
   make db-create

5. (Opcional) Ejecutar pruebas:
   - cp phpunit.xml.dist phpunit.xml
   - make tests

6. Acceder a la aplicación:
   - La app estará disponible en http://localhost:8080 (según tu docker-compose)
   - Puedes hacer un POST a http://localhost:8080 con los campos necesarios.

## Estructura
- src/Domain: Lógica del dominio (Entidades, Value Objects, Repositorios, Eventos)
- src/Application: Casos de uso
- src/Infrastructure: Implementaciones concretas (Doctrine, controladores HTTP, etc.)
- tests: Pruebas unitarias e integración

## Notas
- Este proyecto es una guía mínima; se debe ajustar a casos de uso reales.
- Requiere PHP >= 7.4

# Proyecto PHP con DDD, Doctrine y Docker

Este proyecto demuestra un ejemplo mínimo de arquitectura DDD en PHP 7.x, usando Doctrine para la persistencia de datos y PHPUnit para pruebas.

## Requisitos
- Docker y docker-compose instalados

## Pasos para ejecutar el entorno

1. Clonar el repositorio:
   ``` bash
      git clone https://github.com/Jimmy766/php-ddd-no-framework.git
   ```
   
3. Entrar al directorio y levantar contenedores:
   ``` bash
      cd php-ddd-no-framework
   ``` 
   ``` bash
      make up
   ``` 

4. Instalar dependencias dentro del contenedor PHP:
   ``` bash
      docker-compose exec php composer install
   ```
   
5. Crear/actualizar la base de datos:
   ``` bash
   make db-create
   ```

6. (Opcional) Ejecutar pruebas:
   ``` bash
      cp phpunit.xml.dist phpunit.xml
   ``` 
   ``` bash
      make test
   ```

7. Acceder a la aplicación:
   - La app estará disponible en http://localhost:8080 (según tu docker-compose)
   - Puedes hacer un POST a http://localhost:8080 con los campos necesarios.
   - Ejemplo:
     ``` curl
      curl --location 'localhost:8080' \
      --form 'id="4"' \
      --form 'name="pepito"' \
      --form 'email="p3pito@mail.com4"' \
      --form 'password="Password123@"' 
      ```

## Estructura
- src/Domain: Lógica del dominio (Entidades, Value Objects, Repositorios, Eventos)
- src/Application: Casos de uso
- src/Infrastructure: Implementaciones concretas (Doctrine, controladores HTTP, etc.)
- tests: Pruebas unitarias e integración

## Notas

- Requiere PHP >= 7.4

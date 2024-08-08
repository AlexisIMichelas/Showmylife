# Utiliser l'image PHP officielle
FROM php:8.2-apache

# Copier les fichiers de l'application dans le conteneur
COPY . /var/www/html/

# Exposer le port 80 pour l'application
EXPOSE 80

# Commande pour démarrer Apache
CMD ["apache2-foreground"]

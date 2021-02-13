pipeline {
    agent any

    tools {nodejs "nodejs"}

    stages {
        stage('Build') {
            steps {
                sh "composer install"
                sh "npm install"
                sh "npm run production"
            }
        }
        stage('Test') {
            steps {
                sh './vendor/bin/phpunit'
            }
        }
        stage('Deploy') {
            steps {
                sh 'ssh joel@ip-172-31-43-172 "cd /var/www/konti_tracker; \
                php artisan down; \
                php artisan config:clear; \
                php artisan cache:clear; \
                php artisan view:clear; \
                git pull origin master; \
                composer install --optimize-autoloader --no-dev; \
                php artisan migrate --force; \
                php artisan config:cache; \
                php artisan view:cache; \
                php artisan up;"'
            }
        }
    }
}

pipeline {
    agent any

    environment {
        IMAGE_NAME = "isi-burger"
        CONTAINER_NAME = "isi-burger-container"
    }

    stages {
        stage('Checkout Code') {
            steps {
                git branch: 'Seynabou_Gueye_burger', url: 'https://github.com/Zeyna175/ISI-_burger.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                script {
                    sh 'composer install --no-dev --prefer-dist'
                }
            }
        }

        stage('Setup Laravel') {
            steps {
                script {
                    sh '''
                    cp .env.example .env || true
                    php artisan key:generate
                    php artisan config:cache
                    php artisan migrate --force
                    '''
                }
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    sh 'docker build -t ${IMAGE_NAME}:latest .'
                }
            }
        }

        stage('Run Tests') {
            steps {
                script {
                    sh 'php artisan test'
                }
            }
        }
    }

    post {
        success {
            echo '✅ Pipeline exécuté avec succès !'
        }
        failure {
            echo '❌ Échec du pipeline, vérifie les logs.'
        }
    }
}
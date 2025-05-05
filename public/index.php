<?php include 'header.php'; ?>

<div class="container-fluid p-0">
    <!-- Hero Section -->
    <div class="bg-light section-padding">
        <div class="container text-center">
            <h1 class="display-3 animate-fade-in mb-4">
                <i class="fas fa-dumbbell text-primary me-2"></i>FitConnect
            </h1>
            <p class="lead animate-fade-in-delay mb-5">
                La plataforma que conecta entrenadores personales y clientes para alcanzar tus metas de fitness.
            </p>
            <div class="animate-fade-in-delay">
                <a href="register.php" class="btn btn-primary btn-lg me-3">
                    <i class="fas fa-user-plus me-2"></i>Regístrate Ahora
                </a>
                <a href="login.php" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container section-padding">
        <h2 class="text-center mb-5">Características Principales</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-user-friends feature-icon"></i>
                    <h4>Comunicación Directa</h4>
                    <p>Mensajería instantánea entre entrenadores y clientes para una comunicación efectiva.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-calendar-alt feature-icon"></i>
                    <h4>Calendario Compartido</h4>
                    <p>Programa y gestiona tus sesiones de entrenamiento de manera sencilla.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-dumbbell feature-icon"></i>
                    <h4>Planes Personalizados</h4>
                    <p>Recibe planes de ejercicio y nutrición adaptados a tus objetivos.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="bg-light section-padding">
        <div class="container">
            <h2 class="text-center mb-5">¿Cómo Funciona?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-user-plus fa-2x"></i>
                        </div>
                        <h4>1. Regístrate</h4>
                        <p>Crea tu cuenta como entrenador o cliente para comenzar tu viaje fitness.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-comments fa-2x"></i>
                        </div>
                        <h4>2. Conéctate</h4>
                        <p>Establece conexión con tu entrenador o encuentra clientes potenciales.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                        <h4>3. Alcanza tus Metas</h4>
                        <p>Sigue tu plan personalizado y alcanza tus objetivos de forma efectiva.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="container section-padding text-center">
        <h2 class="mb-4">¿Listo para comenzar?</h2>
        <p class="lead mb-4">Únete a nuestra comunidad y transforma tu vida con FitConnect</p>
        <a href="register.php" class="btn btn-primary btn-lg">
            <i class="fas fa-rocket me-2"></i>Comienza Hoy
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>

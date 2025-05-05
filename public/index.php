<?php include 'header.php'; ?>

<div class="container py-5" style="min-height: 80vh;">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="display-3" style="font-family: 'Montserrat', sans-serif; color: #1A73E8;">FitConnect</h1>
        <p class="lead" style="font-family: 'Open Sans', sans-serif; color: #212529;">
            Conectando entrenadores personales y clientes para alcanzar tus metas de fitness de manera efectiva y sencilla.
        </p>
        <a href="register.php" class="btn btn-lg" style="background-color: #1A73E8; color: #FFFFFF; transition: background-color 0.3s ease;">
            Regístrate Ahora
        </a>
        <a href="login.php" class="btn btn-lg ms-3" style="background-color: #FF6B35; color: #FFFFFF; transition: background-color 0.3s ease;">
            Iniciar Sesión
        </a>
    </div>

    <!-- Features Section -->
    <div class="row text-center mb-5">
        <div class="col-md-4 mb-4">
            <i class="fas fa-user-friends fa-3x mb-3" style="color: #FF6B35;"></i>
            <h4 style="font-family: 'Montserrat', sans-serif; color: #212529;">Comunicación Directa</h4>
            <p style="font-family: 'Open Sans', sans-serif; color: #212529;">
                Mensajería instantánea entre entrenadores y clientes para una comunicación fluida.
            </p>
        </div>
        <div class="col-md-4 mb-4">
            <i class="fas fa-calendar-alt fa-3x mb-3" style="color: #1A73E8;"></i>
            <h4 style="font-family: 'Montserrat', sans-serif; color: #212529;">Calendario Compartido</h4>
            <p style="font-family: 'Open Sans', sans-serif; color: #212529;">
                Programa y gestiona tus sesiones de entrenamiento fácilmente.
            </p>
        </div>
        <div class="col-md-4 mb-4">
            <i class="fas fa-dumbbell fa-3x mb-3" style="color: #FF6B35;"></i>
            <h4 style="font-family: 'Montserrat', sans-serif; color: #212529;">Planes Personalizados</h4>
            <p style="font-family: 'Open Sans', sans-serif; color: #212529;">
                Entrenadores pueden subir planes de ejercicio y nutrición adaptados a ti.
            </p>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="mb-5">
        <h2 class="text-center mb-4" style="font-family: 'Montserrat', sans-serif; color: #1A73E8;">¿Cómo Funciona?</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4 border rounded shadow-sm h-100">
                    <i class="fas fa-user-plus fa-2x mb-3" style="color: #FF6B35;"></i>
                    <h5 style="font-family: 'Montserrat', sans-serif;">Regístrate</h5>
                    <p style="font-family: 'Open Sans', sans-serif;">
                        Crea tu cuenta como entrenador o cliente para comenzar.
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 border rounded shadow-sm h-100">
                    <i class="fas fa-comments fa-2x mb-3" style="color: #1A73E8;"></i>
                    <h5 style="font-family: 'Montserrat', sans-serif;">Conéctate</h5>
                    <p style="font-family: 'Open Sans', sans-serif;">
                        Comunícate directamente con tu entrenador o cliente.
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 border rounded shadow-sm h-100">
                    <i class="fas fa-chart-line fa-2x mb-3" style="color: #FF6B35;"></i>
                    <h5 style="font-family: 'Montserrat', sans-serif;">Alcanza tus Metas</h5>
                    <p style="font-family: 'Open Sans', sans-serif;">
                        Sigue tus planes y sesiones para mejorar tu salud y forma física.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="text-center">
        <a href="register.php" class="btn btn-lg" style="background-color: #1A73E8; color: #FFFFFF; transition: background-color 0.3s ease;">
            Comienza Hoy
        </a>
    </div>
</div>

<style>
    a.btn:hover {
        color: #FFFFFF !important;
        background-color: #FF6B35 !important;
    }
</style>

<?php include 'footer.php'; ?>

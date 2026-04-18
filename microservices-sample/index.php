<?php

// Autoloader for microservices
spl_autoload_register(function ($class) {
    $prefix = 'Microservices\\Sample\\';
    $base_dir = __DIR__ . '/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Example usage
$appointmentService = new Microservices\Sample\Appointments\AppointmentService();
echo json_encode($appointmentService->createAppointment(['date' => '2023-10-01']));

?>
<?php

namespace Microservices\Sample\Appointments;

class AppointmentService
{
    public function createAppointment($data)
    {
        // Logic to create an appointment
        return ['status' => 'success', 'message' => 'Appointment created'];
    }

    public function getAppointments()
    {
        // Logic to retrieve appointments
        return ['appointments' => []];
    }
}

?>